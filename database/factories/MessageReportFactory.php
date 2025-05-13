<?php

namespace Database\Factories;

use App\Models\Message;
// use App\Models\ImportedOrder;
use App\Models\ImportedBilling;
use App\Models\ImportedTracking;
use App\Models\ImportedInvoicing;
use App\Models\ImportedRemarketing;
use App\Models\RespostasPesquisaSatisfacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageReport>
 */
class MessageReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $msgIds = Message::where('type', "!=", 'PESQUISA SATISFAÇÃO ANEXO')
            ->pluck('id')
            ?->toArray();

        // $whats1 = ImportedOrder::pluck('whatsapp')->toArray();
        // $whats2 = RespostasPesquisaSatisfacao::pluck('whatsapp')->toArray();
        $whats1 = ImportedBilling::pluck('whatsapp')->toArray();
        $whats2 = ImportedInvoicing::pluck('whatsapp')->toArray();
        $whats3 = ImportedRemarketing::pluck('whatsapp')->toArray();
        $whats4 = ImportedTracking::pluck('whatsapp')->toArray();

        // $whats= array_merge($whats1, $whats2);
        $whats= array_merge($whats1, $whats2, $whats3, $whats4);
        $situacao= fake()->randomElement(['entregue', 'nao_entregue', 'visualizado']);

        return [
            'pedido' => rand(100, 1000),
            'nota_fiscal' => rand(1000, 9999),
            'nome_cliente' => fake()->name(),
            'whatsapp_enviado' => fake()->randomElement($whats),
            'data_envio' => fake()->dateTimeBetween('-24 months'),
            'data_visualizado' => $situacao == 'visualizado' ? fake()->dateTimeBetween('-1 week', '+1 week') : null,
            'situacao' => $situacao,
            'message_id' => fake()->randomElement($msgIds), // 30 -> total de msgs geradas por seeder
            'identificador' => rand(1000, 9999),
        ];
    }
}
