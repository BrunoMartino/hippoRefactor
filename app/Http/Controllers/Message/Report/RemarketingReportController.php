<?php

namespace App\Http\Controllers\Message\Report;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\MessageReport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RelatorioRemarketingExport;
use App\Models\RespostasPesquisaSatisfacao;

class RemarketingReportController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    /* TODO: acho q falta adicionar permissões as telas e métodos aqui */

    public function index(Request $request)
    {
        authorizePermissions(['ver-relat-notif']);

        $user = User::find(user_princ()->id);

        // as mensagens são relaciadas ou usuário princ, se for sec vai pegar o id do princ
        if ($user->hasRole('usuario_princ')) :
            $userId = $user->id;
        elseif ($user->hasRole('usuario_sec')) :
            $userId = $user->cadastrado_por;
        else :
            $userId = 1;
        endif;

        $reports = $this->filter($request, $userId);

        $totalMessagesSent = $this->totalMessagesSent();
        $totalMessagesRemaining = $this->totalMessagesRemaining();

        return view('pages.messages.reports.remarketing.index', compact('reports', 'totalMessagesSent', 'totalMessagesRemaining'));
    }

    public function filter($request, $userId)
    {
        $reports = MessageReport::where('user_id', $userId)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 3);
            });

        // nome
        if ($request->has('nome') && $request->nome != '') :
            $reports->where('nome_cliente', 'like', "%{$request->nome}%");
        endif;

        // tipos
        if ($request->has('t1') || $request->has('t2') || $request->has('t3')) :
            // vou fazer whereIn
            $types = [];
            if ($request->t1 != '')
                $types[] = 'AGRADECIMENTO';
            if ($request->t2 != '')
                $types[] = 'ANIVERSÁRIO';
            if ($request->t3 != '')
                $types[] = 'PESQUISA SATISFAÇÃO';
            if (count($types) > 0) :
                $reports->whereHas('message', function ($q) use ($types) {
                    return $q->whereIn('type', $types);
                });
            endif;

        endif;

        // pedido
        if ($request->has('pedido') && $request->pedido != '') :
            $reports->where('pedido', $request->pedido);
        endif;
        // nf
        if ($request->has('nf') && $request->nf != '') :
            $reports->where('nota_fiscal', $request->nf);
        endif;

        // situacao
        if ($request->has('sit') && $request->sit != '' && $request->sit != 'todos') :
            $reports->where('situacao', $request->sit);
        endif;

        if ($request->has('dt_envio_min') && $request->dt_envio_min != '') :
            $reports->whereBetween('data_envio', [$request->dt_envio_min . ' 00:00', '2099-01-01']);
        endif;
        if ($request->has('dt_envio_max') && $request->dt_envio_max != '') :
            $reports->whereBetween('data_envio', ['1970-01-01', $request->dt_envio_max . ' 23:59:59']);
        endif;

        $reports = $reports->orderBy('data_envio', 'desc')->paginate(10);
        return $reports;
    }

    public function totalMessagesSent(): int
    {
        $t1 = MessageReport::where('user_id', user_princ()->id)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 3);
            })->count();
        $t2 = RespostasPesquisaSatisfacao::where('user_id', user_princ()->id)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 3);
            })->count();

        return $t2 + $t1;
    }

    public function totalMessagesRemaining(): int
    {
        $userPrinc = User::find(user_princ()->id);
        if ($userPrinc) :
            $sub = Subscription::where('user_id', user_princ()->id)
                ->where('status', 'ativo')
                ->whereHas('plan', function ($q) {
                    return $q->where('modulo_id', 3);
                })
                ->first();

            $totalRemaining = ($sub->plan->limite_mensagens - $this->totalMessagesSent());
        else :
            $totalRemaining = 0;
        endif;

        return $totalRemaining;
    }

    /* TODO: talvez remvoer o método 'store' e 'destroy' não utilizados */
    public function store(Request $request)
    {
        // $report = (new MessageReport)->fill($request->all());
        // $report->save();
    }

    public function show(MessageReport $report)
    {
        return view('pages.messages.reports.remarketing.show', compact('report'));
    }

    public function destroy(MessageReport $report)
    {
        // $report->delete();
        // return redirect()->back()->withSuccess('Relatório de mensagem deletado!');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new RelatorioRemarketingExport($request), 'Relatório Remarketing ' . date('Y-m-d H.i.s') . '.xlsx');
    }

    public function exportPdf()
    {


        $reports =  MessageReport::where('user_id', user_princ()->id)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 3);
            })->latest()->get();


        // return view('pages.messages.reports.pdf.remarketing');
        $pdf = Pdf::loadView('pages.messages.reports.pdf.remarketing', compact('reports'));
        return $pdf->download('Relatório Remarketing ' . date('Y-m-d H.i.s') . '.pdf');
        // return $pdf->stream('Relatório Remarketing ' . date('Y-m-d H.i.s') . '.pdf');
    }
}
