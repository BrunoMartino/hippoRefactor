<?php

namespace App\Exports;

use App\Models\ImportedOrder;
use App\Models\ImportedBilling;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TesteCbExport implements FromArray, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function array(): array
    {

        $dataCollection = ImportedBilling::where('module_id', 1)->get();

        $data = [];
        $data[] = [
            "Nome",
            "Tipo Cliente",
            "Nº do Pedido",
            "Nº Nota Fiscal",
            "WhatsApp",
            "Contrato",
            "Data de nascimento",
            "Data Emissão",
            "Vencimento",
            "Valor",
            "Link boleto",
            "QR Code PIX",
            "Forma Pagamento",
            "Gênero",
            "UF",
        ];

        foreach ($dataCollection as $key => $item) :
            $data[] = [
                $item->name,
                $item->type,
                $item->order_number,
                $item->nf_number,
                $item->whatsapp,
                $item->contract,
                $item->birth_date ? date('d/m/Y', strtotime($item->birth_date)) : '',
                $item->issue_date ? date('d/m/Y', strtotime($item->issue_date)) : '',
                $item->due_date ? date('d/m/Y', strtotime($item->due_date)) : '',
                $item->value,
                $item->link_boleto,
                $item->qr_code_pix,
                $item->payment_method,
                $item->gender,
                $item->uf,
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
