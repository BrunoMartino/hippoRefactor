<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RespostasPesquisaSatisfacao>
 */
class RespostasPesquisaSatisfacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $etapa = fake()->randomElement(['pergunta_inicial', 'pergunta1', 'pergunta2', 'pergunta3', 'pergunta4']);
        if ($etapa == 'pergunta1' || $etapa == 'pergunta2') :
            $resp = rand(1, 5);
        endif;
        if ($etapa == 'pergunta_inicial' || $etapa == 'pergunta3') :
            $resp = rand(1, 2);
        endif;
        if ($etapa == 'pergunta4') :
            $resp = 'Lorem ipsum';
        endif;

        return [
            // 'user_id',
            // 'message_id',
            // 'pesquisa_id',
            'msg_enviada_id' => null,
            'msg_recebida_id' => null,
            'whatsapp' => rand(11111111111, 99999999999),
            'etapa' => $etapa,
            'data_envio' => fake()->dateTimeBetween('-10 days', '-5 days'),
            'data_visualizado' => fake()->dateTimeBetween('-4 days'),
            'situacao' => 'visualizado',
            'resposta' => $resp,
            'data_resposta' => fake()->dateTimeBetween('-4 days'),
        ];
    }
}
