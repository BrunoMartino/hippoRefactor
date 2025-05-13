<?php

namespace Database\Factories;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NFS>
 */
class FormasPagamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $descArray = [
            'Boleto - Bling Conta',
            'Boleto - Wirecard',
            'Boleto - Wirecard',
            'Cartão de Crédito - Bling Conta',
            'Cartão de Crédito - Mensalidade',
            'Conta a receber/pagar',
            'Devolução de mercadorias',
            'Dinheiro',
            'Link de Pagamento - Múltiplas Formas',
            'Pix - Bling Conta',
        ];
        $desc = fake()->randomElement($descArray);
        
        return [
            'user_id' => 1,
            'idBling' => fake()->unique()->numberBetween(111111, 999999),
            'descricao' => $desc,
        ];
    }
}
