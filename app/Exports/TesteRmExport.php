<?php

namespace App\Exports;

use App\Models\ImportedOrder;
use App\Models\ImportedRemarketing;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TesteRmExport implements FromArray, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function array(): array
    {

        $dataCollection = ImportedRemarketing::where('module_id', 3)->get();

        $data = [];
        $data[] = [
            'Nome',
            'Tipo Cliente',
            'Nº do Pedido',
            'Nº Nota Fiscal',
            'WhatsApp',
            'Data de nascimento',
            'Data Pedido',
            'Data Nota Fiscal',
            'Data Contrato',
            'Contrato',
            'Gênero',
            'UF'
        ];

        foreach ($dataCollection as $key => $value) :
            $data[] = [
                $value->name,
                $value->type,
                $value->order_number,
                $value->nf_number,
                $value->whatsapp,
                date('d/m/Y', strtotime($value->birth_date)),
                date('d/m/Y', strtotime($value->date_order)),
                date('d/m/Y', strtotime($value->date_nf)),
                date('d/m/Y', strtotime($value->date_contract)),
                $value->contract,
                $value->gender,
                $value->uf,
            ];
        endforeach;

        return $data;
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
