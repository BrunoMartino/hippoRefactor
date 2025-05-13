<?php

namespace Database\Seeders;

use App\Models\InvoicingReport;
use Illuminate\Database\Seeder;

class InvoicingReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $desc = "Olá {{ nome-cliente }} 👋,

Seu pedido {{ pedido }} foi recebido! 📦✨

Estamos trabalhando para preparar seu pedido o mais rápido possível. Caso tenha alguma dúvida, estamos à disposição para ajudar 🤗.";
        $msgFt = \App\Models\Message::factory()->create([
            'user_id' => 1,
            'module_id' => 2,
            'description' => $desc,
            'type' => 'FATURAMENTO - PEDIDO RECEBIDO',
        ]);

        for ($i = 0; $i < 20; $i++) :
            $dtEnvio = date('Y-m-d', strtotime('-' . rand(5, 10) . ' days'));
            $situacao = fake()->randomElement(['entregue', 'nao_entregue', 'visualizado']);
            $pedidoId = rand(1000, 9999);
            $notaFiscalId = rand(10000000, 999999999);
            $contratoId = rand(10000000, 900999999);

            InvoicingReport::create([
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
            ]);
        endfor;
    }
}
