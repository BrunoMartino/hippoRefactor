<?php

namespace Database\Factories;

use App\Models\FormasPagamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConfigSistemaModulo>
 */
class ConfigSistemaModuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $users = User::role('usuario_princ')->whereNotIn('id', [3])->pluck('id');
        $json = '{"enviar_notificacao_de_fatura_emitida":true,"enviar_notificacao_de_fatura_vencendo":true,"quantidade_de_envios_antecipados":"3","quantidade_de_dias_antes_do_vencimento":"1","quantidade_de_dias_de_intervalo_do_envio_vencimento":"2","enviar_notificacao_de_fatura_no_vencimento":true,"quantidade_de_envios_no_vencimento":"3","quantidade_de_horas_de_intervalo_do_envio":"5","enviar_notificacao_de_fatura_vencida":true,"quantidade_de_envios_apos_vencimento":"3","quantidade_de_dias_de_intervalo_do_envio_vencida":"2","enviar_notificacoes_para_cnpj":true,"enviar_notificacoes_para_cpf":false,"enviar_link_do_boleto":true,"enviar_pdf_do_boleto":false,"formas_pagamento":0,"usar_dados_da_integracao":true,"usar_dados_importados":false,"usar_dados_importados_import":"","enviar_para_faturas_com_vencimento_a_partir_de":false,"data_inicial":null,"enviar_todos_os_dias_as_hora":"09:00"}';
        return [
            // 'user_id' => fake()->unique()->randomElement($users),
            // 'modulo_id' => 1, // cobrancas
        ];
    }
}
