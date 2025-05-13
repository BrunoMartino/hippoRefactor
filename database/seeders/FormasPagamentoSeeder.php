<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormasPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $descArray = [
            'Boleto - Bling Conta',
            'Boleto - Wirecard',
            'Cartão de Crédito - Bling Conta',
            'Cartão de Crédito - Mensalidade',
            'Conta a receber/pagar',
            'Devolução de mercadorias',
            'Dinheiro',
            'Link de Pagamento - Múltiplas Formas',
            'Pix - Bling Conta',
        ];

        foreach ($descArray as $key => $value) {
            \App\Models\FormasPagamento::factory()->create([
                'user_id' => 1,
                'descricao' => $value,
            ]);
            
        }
    }
}
