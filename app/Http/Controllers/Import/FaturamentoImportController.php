<?php

namespace App\Http\Controllers\Import;

use App\Exports\TesteExport;
use App\Imports\OrderImport;
use Illuminate\Http\Request;
use App\Models\ImportedOrder;
use App\Exports\TesteCbExport;
use App\Exports\TesteFtExport;
use App\Models\ImportedInvoicing;
use App\Models\ImportedOrderGroup;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderImportFaturamento;
use Illuminate\Support\Facades\Session;

class FaturamentoImportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index()
    {
        authorizePermissions(['criar-import-faturamento']);
        return view('pages.config.import.faturamento.imported_data.import');
    }

    public function importedData(Request $request)
    {
        authorizePermissions(['ver-import-faturamento']);

        /* TODO: acho q aq vai ser os dados para  cada usuário, colocar o user_id para identificar */
        $data = ImportedOrderGroup::where('user_id', user_princ()->id)->where('module_id', 2);

        if ($request->has('g') && $request->g != '') :
            $data->where('id', $request->g);
        endif;

        if ($request->has('dt_min') && $request->dt_min != '') :
            $data->whereDate('created_at', '>=', $request->dt_min);
        endif;

        if ($request->has('dt_max') && $request->dt_max != '') :
            $data->whereDate('created_at', '<=', $request->dt_max);
        endif;

        $data = $data->latest()->paginate(10);
        return view('pages.config.import.faturamento.groups', compact('data'));
    }

    public function import(Request $request)
    {
        authorizePermissions(['criar-import-faturamento']);

        $request->validate([
            'arquivo' => 'required|file|mimes:xlsx,csv',
            // 'name' => 'required|max:255|unique:imported_order_groups,name',
            'name' => 'required|max:255'
        ]);


        $valid = ImportedOrderGroup::where('name', $request->name)->where('user_id', user_princ()->id);

        if ($valid->exists()) {
            return redirect()->back()->withErrors(['name' => 'O campo nome já está sendo utilizado.'])->withInput();
        }

        $formato = $request->file('arquivo')->getClientOriginalExtension();

        try {
            if ($this->hasWhatsAppRepeatedDifferentNames($request, $formato)):
                return redirect()->back()->withErrors([
                    'arquivo' => 'No arquivo ou nos dados já importados, o mesmo número de WhatsApp (' . session('n_whatsapp') . ') que consta na tabela que você está enviando aparece associado a diferentes nomes.'
                ])->withInput();
            elseif ($this->validarColunaSituacao($request)['error']):
                return $this->validarColunaSituacao($request)['redirect'];
            else:
                Excel::import(new OrderImportFaturamento($request->name), $request->file('arquivo'), null, ucfirst($formato));
            endif;
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                'arquivo' => 'Erro ao importar arquivo.'
            ]);
        }

        return redirect()->route('config.import.ft.imported-data')->withSuccess('Arquivo importado com sucesso!');
    }

    public function validarColunaSituacao($request)
    {
        $formato = $request->file('arquivo')->getClientOriginalExtension();


        try {

            $data = Excel::toArray(new OrderImportFaturamento($request->name), $request->file('arquivo'), null, ucfirst($formato));

            foreach ($data[0] as $key => $item):
                if ($key == 0)
                    continue;
                $permitidos = ['Em aberto', 'Em andamento', 'Atendido', 'Em separação', 'Verificado'];

                if (in_array($item[11], $permitidos, true) == false):
                    $linha = $key + 1;
                    $valor = $item[11];
                    return [
                        'error' => true,
                        'redirect' => redirect()->back()
                            ->withErrors(['arquivo' => "Erro ao importar arquivo."])
                            ->withWarning("Na linha $linha o valor \"$valor\" da coluna \"Situação\" não é aceitável. Verifique os tipos de situação aceitáveis, incluindo letras maiúsculas e minúsculas.")
                            ->withInput()
                    ];
                endif;
            endforeach;
        } catch (\Throwable $th) {
            return [
                'error' => true,
                'redirect' => redirect()->back()->withErrors(['arquivo' => 'Erro ao importar arquivo.'])->withInput()
            ];
        }

        return ['error' => false, 'redirect' => null];
    }

    /* verificar se existe o mesmo whatsapp em nomes diferentes */
    public function hasWhatsAppRepeatedDifferentNames($request, $formato): bool
    {

        try {

            $data = Excel::toArray(new OrderImportFaturamento($request->name), $request->file('arquivo'), null, ucfirst($formato));

            $collect1 = [];
            foreach (ImportedInvoicing::where('user_id', user_princ()->id)->get() as $item) {
                unset($item->id);
                $collect1[] = array_values($item->toArray());
            }
            $collect2 = collect($data[0]);
            $collect = array_merge(array_merge($collect1, $collect2->toArray()));
            $collect = collect($collect)->groupBy(5)->toArray();

            $zaps = [];

            foreach ($collect as $key => $item):
                if (count($item) > 1)
                    $zaps[] = $item;
            endforeach;

            foreach ($zaps as $itens):
                $collectItens = collect($itens)->groupBy(0);
                // se existe mais de um nome usando o mesmo whatsapp
                if ($collectItens->count() > 1):
                    Session::flash('n_whatsapp', $itens[0][5]);
                    return true;
                endif;
            endforeach;

            return false;
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . "\ncode: " . $th->getCode() . "\n" . $th->getFile() . "\nLine: " . $th->getLine() . "\n");
            return false;
        }
    }

    /**
     * Volar para a edição de configurações de msg
     *
     * @return void
     */
    public function backEditSendignSettings()
    {
        /* Se estiver editarndo config envio msg */
        if (session('edit_sending_message_id')) :
            $messageId = session('edit_sending_message_id');
            session()->forget('edit_sending_message_id');

            return redirect()
                ->route('messages.sending-settings.config', $messageId)
                ->with('show_modal_imported_data', true)
                ->withInput(session('edit_sending_message_inputs'));
        endif;
    }

    public function show(Request $request, $group)
    {
        authorizePermissions(['ver-import-faturamento']);

        $dataGroup = ImportedOrderGroup::where('user_id', user_princ()->id)->where('id', $group)->first();
        $data = $this->filterDataImported($request, $dataGroup->imported_invoicing());
        return view('pages.config.import.faturamento.imported_data.show', compact('data', 'dataGroup'));
    }

    public function filterDataImported($request, $import)
    {

        // nome / id
        if ($request->has('n') && $request->n != '') :
            $import->where('id', $request->n);
        endif;
        // pedido
        if ($request->has('n_pedido') && $request->n_pedido != '') :
            $import->where('order_number', $request->n_pedido);
        endif;
        // nf
        if ($request->has('n_nf') && $request->n_nf != '') :
            $import->where('nf_number', $request->n_nf);
        endif;
        // whatsapp
        if ($request->has('whatsapp') && $request->whatsapp != '') :
            $import->where('whatsapp', $request->whatsapp);
        endif;
        // tipo
        if ($request->has('t1') && $request->t1 != '') :
            $import->where('type', 'PF');
        endif;
        if ($request->has('t2') && $request->t2 != '') :
            $import->where('type', 'PJ');
        endif;

        // dt nascimento
        if ($request->has('dt_nasc_min') && $request->dt_nasc_min != '') :
            $import->whereDate('birth_date', '>=', $request->dt_nasc_min);
        endif;
        if ($request->has('dt_nasc_max') && $request->dt_nasc_max != '') :
            $import->whereDate('birth_date', '<=', $request->dt_nasc_max);
        endif;

        // contrato
        if ($request->has('contrato') && $request->contrato != '') :
            $import->where('contract', $request->contrato);
        endif;

        // dt nascimento
        if ($request->has('dt_nasc_min') && $request->dt_nasc_min != '') :
            $import->whereDate('birth_date', '>=', $request->dt_nasc_min);
        endif;
        if ($request->has('dt_nasc_max') && $request->dt_nasc_max != '') :
            $import->whereDate('birth_date', '<=', $request->dt_nasc_max);
        endif;

        // dt nascimento
        if ($request->has('dt_venc_min') && $request->dt_venc_min != '') :
        // $import->whereDate(
        //     DB::raw("STR_TO_DATE(expiration_date, '%d/%m/%Y')"),
        //     '>=',
        //     '01/01/2026'
        // );
        endif;

        // uf
        if ($request->has('uf') && $request->uf != '') :
            $import->where('uf', $request->uf);
        endif;
        // uf
        if ($request->has('uf') && $request->uf != '') :
            $import->where('uf', $request->uf);
        endif;

        // gênero
        if ($request->has('g1') && $request->g1 != '') :
            $import->where('gender', 'M');
        endif;
        if ($request->has('g2') && $request->g2 != '') :
            $import->where('gender', 'F');
        endif;


        return $import->paginate(10);
    }

    public function getDataGroupJson($group)
    {
        $data = ImportedOrderGroup::where('user_id', user_princ()->id)->where('id', $group)->first();
        return $data = $data->imported;
    }

    public function exportTest()
    {
        return Excel::download(new TesteFtExport, 'modelo-faturamento-csv.csv', 'Csv');
        // return Excel::download(new TesteFtExport, 'modelo-faturamento-xlsx.xlsx');
    }

    public function deleteAll()
    {
        return;
    }

    /**
     * Deletar grupo
     *
     * @param  mixed $data
     * @return void
     */
    public function destroy(ImportedOrderGroup $data)
    {
        authorizePermissions(['deletar-import-faturamento']);

        if ($data->user_id != user_princ()->id)
            abort(403);

        ImportedInvoicing::where('group_id', $data->id)->delete();
        $data->delete();
        return redirect()->back()->withSuccess('Grupo deletado com sucesso!');
    }

    /**
     * Deletar registra importado
     *
     * @param  mixed $data
     * @return void
     */
    public function destroyItem(Request $request)
    {
        authorizePermissions(['deletar-import-faturamento']);
        
        /* TODO: talves corrigir para pegar dados para user sec */
        $data = ImportedInvoicing::where('user_id', user_princ()->id)->where('id', $request->id)->first();
        $data->delete();
        return redirect()->back()->withSuccess('Registro deletado com sucesso!');
    }

    public function report() {}
}
