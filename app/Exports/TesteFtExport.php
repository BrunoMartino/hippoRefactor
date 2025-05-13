<?php

namespace App\Exports;

use App\Models\ImportedOrder;
use App\Models\ImportedInvoicing;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TesteFtExport implements FromArray, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function array(): array
    {

        $dataCollection = ImportedInvoicing::where('module_id', 2)->get();

        $data = [];
        $data[] = [
            "Nome",
            "Tipo Cliente",
            "Nº do Pedido",
            "Nº Nota Fiscal",
            "Contrato",
            "WhatsApp",
            "Link nota fiscal",
            "Link XML",
            "Data de nascimento",
            "Gênero",
            "UF",
            "Situação"
        ];

        foreach ($dataCollection as $key => $value) :
            $data[] = [
                $value->name,
                $value->type,
                $value->order_number,
                $value->nf_number,
                $value->contract,
                $value->whatsapp,
                $value->link_nf,
                $value->link_xml,
                date('d/m/Y', strtotime($value->birth_date)),
                $value->gender,
                $value->uf,
                $value->situacao,
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
