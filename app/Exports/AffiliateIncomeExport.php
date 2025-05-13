<?php

namespace App\Exports;

use App\Models\AffiliateReferral;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AffiliateIncomeExport implements FromArray, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function array(): array
    {
        return $this->dataExpoert();
    }

    public function dataExpoert()
    {
        $user = Auth::user();
        $affiliate = $user->affiliate;
        $incomes = AffiliateReferral::where('affiliate_id', $affiliate->id)->get();

        $data = [
            ['Usuário', 'Data Cadastro', 'Data Contrato', 'Comissão'],
        ];

        foreach ($incomes as $key => $value) :
            $data[] = [
                $value->user->nome_usuario,
                $value->created_at->format('d/m/Y'),
                $value->contract_date  ? date('d/m/Y', strtotime($value->contract_date)) : '---',
                'R$ ' . number_format($value->commission, 2, ',', '.'),
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
