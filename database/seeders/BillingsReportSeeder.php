<?php

namespace Database\Seeders;

use App\Models\ContasReceber;
use App\Models\BillingsReport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BillingsReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

//         $desc = "Olá, tudo bem?
// O Boleto referente ao serviço XXXXXXXX foi emitido.
// Nome: {{ nome }}
// Contrato: {{ contrato }}
// Vencimento: {{ vencimento }}
// Faça o pagamento até o vencimento e evite a incidência de multa e juros.  Qualquer dúvida, entre em contato conosco através do número: (99) 99999-9999.
// Link do boleto: {{ link }}. {{ qtd-dias }}";
        $tipos = [
            'COBRANÇA GERADA',
            'COBRANÇA VENCENDO',
            'COBRANÇA VENCIMENTO',
            'COBRANÇA VENCIDA',
        ];

        $msgCobranca = [];

        foreach ($tipos as $tipo) {
            $msgCobranca[$tipo] = \App\Models\Message::factory()->create([
                'user_id' => 1,
                'module_id' => 1,
                'description' => 'texto para enviar para'.$tipo,
                'type' => $tipo,
            ]);
        }

        // $msgCobranca = \App\Models\Message::factory()->create([
        //     'user_id' => 1,
        //     'module_id' => 1,
        //     'description' => $desc,
        //     'type' => fake()->randomElement([
        //         'COBRANÇA GERADA',
        //         'COBRANÇA VENCENDO',
        //         'COBRANÇA VENCIMENTO',
        //         'COBRANÇA VENCIDA',
        //     ]),
        // ]);

        $contasReceber = ContasReceber::get();

        foreach ($contasReceber as $key => $item) :
            $dtEnvio = date('Y-m-d', strtotime('-' . rand(5, 10) . ' days'));
            $situacao = fake()->randomElement(['entregue', 'nao_entregue', 'visualizado']);
            $tipoSorteado = fake()->randomElement($tipos);
            BillingsReport::create([
                'idCobrancaBling' => $item->idBling,
                'pedido' => $item->pedidoId,
                'nota_fiscal' => $item->notaFiscalId,
                'contrato' => $item->contratoId,
                'nome_cliente' => fake()->name(),
                'valor' => $item->valor,
                'vencimento' => $item->vencimento,
                'situacao' => $situacao,
                'data_envio' => $dtEnvio,
                'data_visualizado' => $situacao == 'visualizado' ?  $dtEnvio : null,
                'whatsapp_enviado' => rand(11111111111, 99999999999),
                'msg_enviada_id' => null,
                'messageTimestamp' => null,
                'user_id' => 1,
                'message_id' => $msgCobranca[$tipoSorteado]->id,
            ]);
        endforeach;
    }
}
