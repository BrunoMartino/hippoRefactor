<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Models\MessageReport;
use App\Models\BillingsReport;
use App\Models\TrackingReport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RelatorioRemarketingExport implements FromArray, WithEvents, ShouldAutoSize, WithStyles
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function array(): array
    {
        $request = $this->request;

        $reports = MessageReport::where('user_id', user_princ()->id)
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

        $reports = $reports->orderBy('data_envio', 'desc')->get();

        $data = [];
        $data[] = [
            "Cliente",
            "Pedido",
            "Nota fiscal",
            "Data Envio",
            "Situação",
        ];

        foreach ($reports as $item) :

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
                $item->nome_cliente ?  $item->nome_cliente : 'Deletada',
                $item->pedido,
                $item->nota_fiscal,
                date('d/m/Y H:i:s', strtotime($item->data_envio)),
                $situacao,
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
