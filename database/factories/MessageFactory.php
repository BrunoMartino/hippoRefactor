<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $type =  fake()->randomElement(['ANIVERSÁRIO', 'AGRADECIMENTO']);
        // $type =  fake()->randomElement(['ANIVERSÁRIO', 'AGRADECIMENTO', 'PESQUISA SATISFAÇÃO', 'PESQUISA SATISFAÇÃO ANEXO']);

        $satisfaction = null;
        if ($type == 'ANIVERSÁRIO') :
            $msg = "Olá, {{ nome }}! Seu aniversário é {{ data-nascimento }}.";
        endif;
        if ($type == 'AGRADECIMENTO') :
            $msg = "Olá, {{ nome }}! Pedido {{ pedido }} e NF {{ nota-fiscal }}";
        endif;
        if ($type == 'PESQUISA SATISFAÇÃO' || $type == 'PESQUISA SATISFAÇÃO ANEXO') :
            $msg = null;
            $satisfaction = [
                'pergunta_inicial' => [
                    'pergunta' => "Faaaaala {{ nome }}, como vai? \n\n Queremos deixar a nossa parceria ainda melhor! Topa responder algumas perguntinhas em troca de um cupom de desconto? Só leva 1 minutinho, bora?",
                    'opcoes' => [
                        1 => 'Claro',
                        2 => 'Não, obrigado!'
                    ]
                ],
                'caso_nao_perg_inicial' => [
                    'msg' => "Sem problemas, {{ nome }}! \n\n Agradecemos mesmo assim pela sua consideração. Se precisar de algo, é só chamar!"
                ],
                'pergunta1' => [
                    'pergunta' => "O produto/serviço atendeu às suas expectativas?",
                    'opcoes' => [
                        1 => 'Péssimo',
                        2 => 'Ruim',
                        3 => 'Médio',
                        4 => 'Bom',
                        5 => 'Excelente',
                    ]
                ],
                'pergunta2' => [
                    'pergunta' => "Suas necessidades foram atendidas durante sua experiência conosco?",
                    'opcoes' => [
                        1 => 'Péssimo',
                        2 => 'Ruim',
                        3 => 'Médio',
                        4 => 'Bom',
                        5 => 'Excelente',
                    ]
                ],
                'pergunta3' => [
                    'pergunta' => "Você consideraria indicar nossos produtos/serviços para outras pessoas?",
                    'opcoes' => [
                        1 => 'Sim',
                        2 => 'Não',
                    ]
                ],
                'agradecimento' => [
                    'msg' => "Obrigado por ajudar a tornar nossos produtos/serviços ainda melhores! \n\n Como prometido, aqui está seu cupom de desconto para a próxima compra/contratação: CUPOM"
                ],
                'pergunta4' => [
                    'pergunta' => "Notou algo que poderíamos ter feito de forma diferente para tornar sua experiência mais agradável? \n\n Compartilhe conosco!",
                ],
                'caso_resp_perg4' => [
                    'msg' => "Agradecemos muito pelo seu feedback e sugestões! Sua opinião nos ajuda a melhorar e garantir que nossos clientes tenham as melhores experiências possíveis. Obrigado por compartilhar seus pensamentos conosco!",
                ],
            ];
        endif;

        return [
            'name' => fake()->sentence(2),
            'description' => $msg,
            'type' => $type,
            'satisfaction_survey' => $satisfaction
        ];
    }
}
