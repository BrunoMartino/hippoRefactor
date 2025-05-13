<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPrinc = User::where('email', 'usuario.princ@email.com')->first();



        /* Msg pesquisa satisfaç~eos */

        $json = '{
  "pergunta_inicial": {
    "pergunta": "Faaaaala {{ nome }}, como vai?\r\n\r\nQueremos deixar a nossa parceria ainda melhor! Topa responder algumas perguntinhas em troca de um cupom de desconto? Só leva 1 minutinho, bora?",
    "opcoes": {
      "1": "Claro",
      "2": "Não, obrigado!"
    }
  },
  "caso_nao_perg_inicial": {
    "msg": "Sem problemas, {{ nome }}!\r\n\r\nAgradecemos mesmo assim pela sua consideração. Se precisar de algo, é só chamar!"
  },
  "pergunta1": {
    "pergunta": "O produto/serviço atendeu às suas expectativas?",
    "opcoes": {
      "1": "Péssimo",
      "2": "Ruim",
      "3": "Médio",
      "4": "Bom",
      "5": "Excelente",
      "titulo": "Avalie de 1 a 5:"
    }
  },
  "pergunta2": {
    "pergunta": "Suas necessidades foram atendidas durante sua experiência conosco?",
    "opcoes": {
      "1": "Péssimo",
      "2": "Ruim",
      "3": "Médio",
      "4": "Bom",
      "5": "Excelente",
      "titulo": "Avalie de 1 a 5:"
    }
  },
  "pergunta3": {
    "pergunta": "Você consideraria indicar nossos produtos/serviços para outras pessoas?",
    "opcoes": {
      "1": "Sim",
      "2": "Não",
      "titulo": "Avalie:"
    }
  },
  "agradecimento": {
    "msg": "Obrigado por ajudar a tornar nossos produtos/serviços ainda melhores! \r\n\r\nComo prometido, aqui está seu cupom de desconto para a próxima compra/contratação: CUPOM"
  },
  "pergunta4": {
    "pergunta": "Notou algo que poderíamos ter feito de forma diferente para tornar sua experiência mais agradável?\r\n\r\nCompartilhe conosco!"
  },
  "caso_resp_perg4": {
    "msg": "Agradecemos muito pelo seu feedback e sugestões! Sua opinião nos ajuda a melhorar e garantir que nossos clientes tenham as melhores experiências possíveis. Obrigado por compartilhar seus pensamentos conosco!"
  }
}';

        \App\Models\Message::factory(1)->create([
            'user_id' => $userPrinc ? $userPrinc->id : 1,
            "type" => "PESQUISA SATISFAÇÃO",
            "description" => null,
            "satisfaction_survey" => json_decode($json),
            'module_id' => 3
        ]);

        \App\Models\Message::factory(30)->create([
            'user_id' => $userPrinc ? $userPrinc->id : 1,
            'module_id' => 3
        ]);


        \App\Models\Message::factory(5)->create([
            'user_id' => $userPrinc ? $userPrinc->id : 1,
            "type" => "PESQUISA SATISFAÇÃO",
            "description" => null,
            "satisfaction_survey" => json_decode($json),
            'module_id' => 3
        ]);

    }
}
