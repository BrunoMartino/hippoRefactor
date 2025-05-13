<?php

namespace App\Exports;

use App\Models\ImportedOrder;
use App\Models\ImportedTracking;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TesteRtExport implements FromArray, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function array(): array
    {

        $dataCollection = ImportedTracking::where('module_id', 4)->get();

        $data = [];
        $data[] = [
            "Nome",
            "Tipo Cliente",
            "Nº do Pedido",
            "Nº Nota Fiscal",
            "WhatsApp",
            "Data de envio",
            "Contrato",
            "Transportadora",
            "Código rastreio",
            'Link rastreio',
            "Data de nascimento",
            "Gênero",
            "UF"
        ];

        foreach ($dataCollection as $key => $value) :
            $data[] = [
                $value->name,
                $value->type,
                $value->order_number,
                $value->nf_number,
                $value->whatsapp,
                date('d/m/Y', strtotime($value->send_date)),
                $value->contract,
                $value->carrier,
                $value->cod_rastreio,
                $value->link_rastreio,
                date('d/m/Y', strtotime($value->birth_date)),
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
