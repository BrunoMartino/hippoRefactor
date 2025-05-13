<?php

namespace Database\Seeders;

use App\Models\TrackingReport;
use App\Models\InvoicingReport;
use Illuminate\Database\Seeder;

class TrackingReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $desc = "Olá {{ nome-cliente }},

Seu pedido foi enviado com sucesso! Segue abaixo o código de rastreamento para que você possa acompanhar a entrega:

Código de Rastreamento: {{ codigo-rastreio }}

Você pode acompanhar o status da entrega através do site clicando [aqui](link do rastreamento).

Atenciosamente,
[Seu Nome / Nome da Empresa]";
        $msgFt = \App\Models\Message::factory()->create([
            'user_id' => 1,
            'module_id' => 4,
            'description' => $desc,
            'type' => 'RASTREIO - CODIGO',
        ]);

        for ($i = 0; $i < 30; $i++) :
            $dtEnvio = date('Y-m-d', strtotime('-' . rand(5, 10) . ' days'));
            $situacao = fake()->randomElement(['entregue', 'nao_entregue', 'visualizado']);
            $pedidoId = rand(1000, 9999);
            $notaFiscalId = rand(10000000, 999999999);
            $contratoId = rand(10000000, 900999999);

            TrackingReport::create([
                'pedido' => $pedidoId,
                'nota_fiscal' => $notaFiscalId,
                'contrato' => $contratoId,
                'nome_cliente' => fake()->name(),
                'situacao' => $situacao,
                'data_envio' => $dtEnvio,
                'data_visualizado' => $situacao == 'visualizado' ?  $dtEnvio : null,
                'msg_enviada_id' => null,
                'messageTimestamp' => null,
                'idPedido' => $pedidoId,
                'idNotaFiscal' => $notaFiscalId,
                'idContrato' => $contratoId,
                'user_id' => 1,
                'message_id' => $msgFt->id,
                'situacao_entrega' => fake()->randomElement(["postado", "entregue", "transferencia", "saiu_entregar", "ausente"])
            ]);
        endfor;
    }
}
