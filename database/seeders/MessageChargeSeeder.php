<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPrinc = User::where('email', 'usuario.princ@email.com')->first();


        for ($i = 0; $i < 10; $i++) :
            $type = fake()->randomElement([
                'COBRANÇA GERADA',
                'COBRANÇA VENCENDO',
                'COBRANÇA VENCIMENTO',
                'COBRANÇA VENCIDA'
            ]);

            $arrayDescription = '';

            if ($type == 'COBRANÇA GERADA') :
                $arrayDescription = '(Mensagem automática) Olá, tudo bem?
O Boleto referente ao serviço XXXXXXXX foi emitido.
Nome: {{nome}}
Contrato: {{contrato}}
Vencimento: {{vencimento}}
Faça o pagamento até o vencimento e evite a incidência de multa e juros. Qualquer dúvida, entre em contato conosco através do número: (99) 99999-9999.
Link do boleto: {{link}}';
            endif;

            if ($type == 'COBRANÇA VENCENDO') :
                $arrayDescription = '(Mensagem automática) Olá, tudo bem?
O Boleto referente ao serviço XXXXXXXX vence em {{qtd-dias}} dias.
Nome: {{nome}}
Contrato: {{contrato}}
Vencimento: {{vencimento}}
Faça o pagamento até o vencimento e evite a incidência de multa e juros. Qualquer dúvida, entre em contato conosco através do número: (99) 99999-9999.
Link do boleto: {{link}}';
            endif;

            if ($type == 'COBRANÇA VENCIMENTO') :
                $arrayDescription = '(Mensagem automática) Olá, tudo bem?
Hoje é o vencimento do boleto referente ao serviço XXXXXXXX.
Nome: {{nome}}
Contrato: {{contrato}}
Vencimento: {{vencimento}}
Faça o pagamento e evite a incidência de multa e juros.
Qualquer dúvida, entre em contato conosco através do número: (99) 99999-9999. Link do boleto: {{link}}';
            endif;

            if ($type == 'COBRANÇA VENCIDA') :
                $arrayDescription = '(Mensagem automática) Olá, tudo bem?
O Boleto referente ao serviço XXXXXXXX está vencido a {{qtd-dias}} dias. Nome: {{nome}}
Contrato: {{contrato}}
Vencimento: {{vencimento}}
Faça o pagamento através do link enviado abaixo.
Qualquer dúvida, entre em contato conosco através do número: (99) 99999-9999.
Link do boleto: {{link}}';
            endif;


            \App\Models\Message::factory()->create([
                'user_id' => $userPrinc ? $userPrinc->id : 1,
                'type' => $type,
                'description' => $arrayDescription,
                'module_id' => 3
            ]);
        endfor;
    }
}
