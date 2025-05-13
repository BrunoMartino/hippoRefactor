<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Models\BillingsReport;
use App\Models\InvoicingReport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RelatorioFaturamentoExport implements FromArray, WithEvents, ShouldAutoSize, WithStyles
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function array(): array
    {
        $request = $this->request;

        $invoicingReport = InvoicingReport::where('user_id', user_princ()->id)
            ->whereHas('message', function ($q) {
                return $q->where('module_id', 2);
            });

        /* Filtros */

        /* nome */
        if ($request->has('nome') && $request->nome != '') :
            $invoicingReport->where('nome_cliente', $request->nome);
        endif;
        /* pedido */
        if ($request->has('pedido') && $request->pedido != '') :
            $invoicingReport->where('idPedido', $request->pedido);
        endif;
        /* nf */
        if ($request->has('nf') && $request->nf != '') :
            $invoicingReport->where('idNotaFiscal', $request->nf);
        endif;
        /* contrato */
        if ($request->has('contrato') && $request->contrato != '') :
            $invoicingReport->where('idContrato', $request->contrato);
        endif;
        /* situcao */
        if ($request->has('sit') && $request->sit != '' && $request->sit != 'todos') :
            $invoicingReport->where('situacao', $request->sit);
        endif;

        /* dt vencimento */
        if ($request->has('dt_venc_min') && $request->dt_venc_min != '') :
            $invoicingReport->whereDate('vencimento', '>=', $request->dt_venc_min);
        endif;
        if ($request->has('dt_venc_max') && $request->dt_venc_max != '') :
            $invoicingReport->whereDate('vencimento', '<=', $request->dt_venc_max);
        endif;

        /* dt envio */
        if ($request->has('dt_envio_min') && $request->dt_envio_min != '') :
            $invoicingReport->whereDate('data_envio', '>=', $request->dt_envio_min);
        endif;
        if ($request->has('dt_envio_max') && $request->dt_envio_max != '') :
            $invoicingReport->whereDate('data_envio', '<=', $request->dt_envio_max);
        endif;
        /* dt visualização */
        if ($request->has('dt_visu_min') && $request->dt_visu_min != '') :
            $invoicingReport->whereDate('data_visualizado', '>=', $request->dt_visu_min);
        endif;
        if ($request->has('dt_visu_max') && $request->dt_visu_max != '') :
            $invoicingReport->whereDate('data_visualizado', '<=', $request->dt_visu_max);
        endif;

        /* tipo */
        if ($request->has('t') && $request->t != '') :
        else :
            $types = [];
            if ($request->has('t2') && $request->t2 != '')
                $types[] = 'FATURAMENTO - PEDIDO';

            if (count($types) > 0) :
                $invoicingReport->whereHas('message', function ($q) use ($types) {
                    return $q->whereIn('type', $types);
                });
            endif;

        endif;

        $invoicingReport = $invoicingReport->orderBy('data_envio', 'desc')->get();

        $data = [];
        $data[] = [
            "Nome",
            "Envio",
            "Situação",
            "Visualizado",
        ];

        foreach ($invoicingReport as $item) :


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
