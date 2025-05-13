<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            NiveisTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            ModulosTableSeeder::class,
            PlanosTableSeeder::class,
            UsuariosTableSeeder::class,
            MessageSeeder::class,
            MessageChargeSeeder::class,
            DiscountCouponSeeder::class,
            ImportedOrderSeeder::class, // seeder para teste
            RespostasPesquisaSatisfacaoSeeder::class,
            AffiliateSeeder::class,
            MonthlyDiscountSeeder::class,
            InvoiceSeeder::class,
            SubscriptionSeeder::class,
            ContactSeeder::class,
            NFSSeeder::class,
            OrderSeeder::class,
            FormasPagamentoSeeder::class,
            ContratoSeeder::class,
            ContasReceberSeeder::class,
            ConfigSistemaModuloSeeder::class,
            BillingsReportSeeder::class,
            InvoicingReportSeeder::class,
            TrackingReportSeeder::class,
            SuggestionSeeder::class,
            SuggestionAnswerSeeder::class,
            SendingSettingSeeder::class,
            MessageReportSeeder::class,
        ]);


        \App\Models\Message::whereIn('type', [
            'COBRANÇA GERADA',
            'COBRANÇA VENCENDO',
            'COBRANÇA VENCIMENTO',
            'COBRANÇA VENCIDA'
        ])->update([
           'module_id' => 1
        ]);
        
        // Message::where('id', '>', 3)->forceDelete();

    }
}
