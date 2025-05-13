<?php

namespace App\Exports;

use App\Models\BillingsReport;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Http\Request;

class RelatorioCobrancasExport implements FromArray, WithEvents, ShouldAutoSize, WithStyles
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function array(): array
    {

        $request = $this->request;

        $billingsReport = BillingsReport::where('billings_reports.user_id', user_princ()->id)
            ->join('contas_receber', function ($join) use ($request) {
                $join->on('billings_reports.idCobrancaBling', '=', 'contas_receber.idBling');

                /* Filtros */

                /* nome */
                if ($request->has('nome') && $request->nome != '') :
                    $join->where('billings_reports.nome_cliente', $request->nome);
                endif;
                /* pedido */
                if ($request->has('pedido') && $request->pedido != '') :
                    $join->where('billings_reports.idPedido', $request->pedido);
                endif;
                /* nf */
                if ($request->has('nf') && $request->nf != '') :
                    $join->where('billings_reports.idNotaFiscal', $request->nf);
                endif;
                /* contrato */
                if ($request->has('contrato') && $request->contrato != '') :
                    $join->where('billings_reports.idContrato', $request->contrato);
                endif;
                /* situcao */
                if ($request->has('sit') && $request->sit != '' && $request->sit != 'todos') :
                    $join->where('billings_reports.situacao', $request->sit);
                endif;

                /* dt vencimento */
                if ($request->has('dt_venc_min') && $request->dt_venc_min != '') :
                    $join->whereDate('contas_receber.vencimento', '>=', $request->dt_venc_min);
                endif;
                if ($request->has('dt_venc_max') && $request->dt_venc_max != '') :
                    $join->whereDate('contas_receber.vencimento', '<=', $request->dt_venc_max);
                endif;

                /* dt envio */
                if ($request->has('dt_envio_min') && $request->dt_envio_min != '') :
                    $join->whereDate('billings_reports.data_envio', '>=', $request->dt_envio_min);
                endif;
                if ($request->has('dt_envio_max') && $request->dt_envio_max != '') :
                    $join->whereDate('billings_reports.data_envio', '<=', $request->dt_envio_max);
                endif;
                /* dt visualização */
                if ($request->has('dt_visu_min') && $request->dt_visu_min != '') :
                    $join->whereDate('billings_reports.data_visualizado', '>=', $request->dt_visu_min);
                endif;
                if ($request->has('dt_visu_max') && $request->dt_visu_max != '') :
                    $join->whereDate('billings_reports.data_visualizado', '<=', $request->dt_visu_max);
                endif;
            });

        /* tipo */
        if ($request->has('t') && $request->t != '') :
        else :

            $types = [];
            if ($request->has('t1') && $request->t1 != '')
                $types[] = 'COBRANÇA GERADA';
            if ($request->has('t2') && $request->t2 != '')
                $types[] = 'COBRANÇA VENCENDO';
            if ($request->has('t3') && $request->t3 != '')
                $types[] = 'COBRANÇA VENCIMENTO';
            if ($request->has('t4') && $request->t4 != '')
                $types[] = 'COBRANÇA VENCIDA';

            if (count($types) > 0) :
                $billingsReport->whereHas('message', function ($q) use ($types) {
                    return $q->whereIn('type', $types);
                });
            endif;

        endif;

        $billingsReport = $billingsReport->orderBy('data_envio', 'desc')->get();

        $data = [];
        $data[] = [
            "Nome",
            "Tipo",
            "Vencimento",
            "Envio",
            "Situação",
            "Visualizado",
        ];

        foreach ($billingsReport as $item) :

            // obter tipo
            $tipo = null;
            switch ($item->message->type) {
                case 'COBRANÇA GERADA':
                    $tipo = 'Gerada';
                    break;
                case 'COBRANÇA VENCENDO':
                    $tipo = 'Vencendo';
                    break;
                case 'COBRANÇA VENCIMENTO':
                    $tipo = 'Vencimento';
                    break;
                case 'COBRANÇA VENCIDA':
                    $tipo = 'Vencido';
                    break;

                default:
                    # code...
                    break;
            }

            // obter status
            $situacao = null;
            switch ($item->situacao) {
                case ('entregue');
                    $situacao = 'Entregue';
                    break;

                case ('nao_entregue');
                    $situacao = 'Não entregue';
                    break;

                case ('visualizado');
                    $situacao = 'Visualizado';
                    break;
            }


            $data[] = [
                $item->nome_cliente,
                $tipo,
                date('d/m/Y', strtotime($item->vencimento)),
                date('d/m/Y H:i:s', strtotime($item->data_envio)),
                $situacao,
                is_null($item->data_visualizado) ? '-' : date('d/m/Y H:i:s', strtotime($item->data_visualizado)),
            ];
        endforeach;

        return $data;
    }

    public function styles(Worksheet $sheet)
    {

        return [
            // Style the first row as bold text.
            1    => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'DDDDDDDD'], // Cor de fundo vermelha
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();
            },
        ];
    }
}
