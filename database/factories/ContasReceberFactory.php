<?php

namespace Database\Factories;

use App\Models\Contacts;
use App\Models\Contrato;
use App\Models\FormasPagamento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NFS>
 */
class ContasReceberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $idsBling = FormasPagamento::pluck('idBling')->toArray();

        $dtEmissao = date('Y-m-d', strtotime("-" . rand(0, 25) . " days"));
        return [
            'user_id' => 1,
            'vencimento' => date('Y-m-d', strtotime($dtEmissao . " + 1 months")),
            'idBling' => fake()->unique()->numberBetween(111111, 999999),
            'linkQRCodePix' => null,
            'linkBoleto' => 'https://',
            'dataEmissao' => $dtEmissao,
            // 'contatoId' => $contRandom['contatoId'],
            // 'valor' => rand(),
            'formaPagamentoId' => fake()->randomElement($idsBling),
        ];
    }
}
