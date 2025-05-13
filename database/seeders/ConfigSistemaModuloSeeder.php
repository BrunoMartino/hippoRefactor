<?php

namespace Database\Seeders;

use App\Models\FormasPagamento;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigSistemaModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $firstFormPg = FormasPagamento::where('user_id', 1)->first();
        // $json = '{"enviar_notificacao_de_fatura_emitida":true,"enviar_notificacao_de_fatura_vencendo":true,"quantidade_de_envios_antecipados":"3","quantidade_de_dias_antes_do_vencimento":"1","quantidade_de_dias_de_intervalo_do_envio_vencimento":"2","enviar_notificacao_de_fatura_no_vencimento":true,"quantidade_de_envios_no_vencimento":"3","quantidade_de_horas_de_intervalo_do_envio":"5","enviar_notificacao_de_fatura_vencida":true,"quantidade_de_envios_apos_vencimento":"3","quantidade_de_dias_de_intervalo_do_envio_vencida":"2","enviar_notificacoes_para_cnpj":true,"enviar_notificacoes_para_cpf":false,"enviar_link_do_boleto":true,"enviar_pdf_do_boleto":false,"formas_pagamento":[' . $firstFormPg->idBling . '],"usar_dados_da_integracao":true,"usar_dados_importados":false,"usar_dados_importados_import":"","enviar_para_faturas_com_vencimento_a_partir_de":false,"data_inicial":null,"enviar_todos_os_dias_as_hora":"09:00"}';

        // \App\Models\ConfigSistemaModulo::factory()->create([
        //     'user_id' => 1,
        //     'modulo_id' => 1,
        //     'config' => json_decode($json),
        // ]);
        // \App\Models\ConfigSistemaModulo::factory(20)->create();


        /* ============================================= */
        /* ============================================= */
        /* ============================================= */
        /* ============================================= */



        $configCobranca = [
            "user_id" => 1,
            "modulo_id" => 1,
            "enviar_notificacao_de_fatura_emitida" => 1,
            "enviar_notificacao_de_fatura_vencendo" => 1,
            "quantidade_de_envios_antecipados" => 3,
            "quantidade_de_dias_antes_do_vencimento" => 15,
            "quantidade_de_dias_de_intervalo_do_envio_vencimento" => 5,
            "enviar_notificacao_de_fatura_no_vencimento" => 1,
            "enviar_notificacao_de_fatura_vencida" => 1,
            "quantidade_de_envios_apos_vencimento" => 5,
            "quantidade_de_dias_de_intervalo_do_envio_vencida" => 2,
            "enviar_notificacoes_para_cnpj" => 1,
            "enviar_notificacoes_para_cpf" => 1,
            "enviar_link_do_boleto" => 1,
            "enviar_pdf_do_boleto" => 1,
            "formas_pagamento" => FormasPagamento::where('id', '<', 5)->pluck('idBling'),
            "usar_dados_da_integracao" => 1,
            "usar_dados_importados" => 1,
            "usar_dados_importados_import" => [
                "2"
            ],
            "enviar_para_faturas_com_vencimento_a_partir_de" => 1,
            "data_inicial" => "2025-03-11",
            "enviar_todos_os_dias_as_hora" => "07:00",
            "enviar_pdf_da_nota_fiscal" => null,
            "enviar_link_da_nota_fiscal" => null,
            "enviar_xml_para_cnpj" => null,
            "enviar_xml_para_cpf" => null,
            "enviar_link_xml" => null,
            "enviar_arquivo_xml" => null,
            "enviar_mensagem_sobre_nao_receber_mais_notificacoes" => null,
            "enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto" => null,
            "enviar_codigo_de_rastreamento" => null,
            "enviar_codigo_de_rastreamento_msg_id" => null,
            "enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria" => null,
            "enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_id" => null,
            "enviar_mensagem_de_aviso_saiu_para_entrega" => null,
            "enviar_mensagem_de_aviso_saiu_para_entrega_msg_id" => null,
            "enviar_mensagem_de_confirmacao_de_entrega" => null,
            "enviar_mensagem_de_confirmacao_de_entrega_msg_id" => null,
            "enviar_mensagem_de_aviso_de_destinatario_ausente" => null,
            "enviar_mensagem_de_aviso_de_destinatario_ausente_msg_id" => null,
        ];

        $configFaturamento = [
            "user_id" => 1,
            "modulo_id" => 2,
            "enviar_notificacao_de_fatura_emitida" => null,
            "enviar_notificacao_de_fatura_vencendo" => null,
            "quantidade_de_envios_antecipados" => null,
            "quantidade_de_dias_antes_do_vencimento" => null,
            "quantidade_de_dias_de_intervalo_do_envio_vencimento" => null,
            "enviar_notificacao_de_fatura_no_vencimento" => null,
            "enviar_notificacao_de_fatura_vencida" => null,
            "quantidade_de_envios_apos_vencimento" => null,
            "quantidade_de_dias_de_intervalo_do_envio_vencida" => null,
            "enviar_notificacoes_para_cnpj" => 1,
            "enviar_notificacoes_para_cpf" => 1,
            "enviar_link_do_boleto" => null,
            "enviar_pdf_do_boleto" => null,
            "formas_pagamento" => null,
            "usar_dados_da_integracao" => 1,
            "usar_dados_importados" => 1,
            "usar_dados_importados_import" => [
                "4"
            ],
            "enviar_para_faturas_com_vencimento_a_partir_de" => null,
            "data_inicial" => null,
            "enviar_todos_os_dias_as_hora" => null,
            "enviar_pdf_da_nota_fiscal" => 1,
            "enviar_link_da_nota_fiscal" => 1,
            "enviar_xml_para_cnpj" => 1,
            "enviar_xml_para_cpf" => 1,
            "enviar_link_xml" => 1,
            "enviar_arquivo_xml" => 1,
            "enviar_mensagem_sobre_nao_receber_mais_notificacoes" => 0,
            "enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto" => null,
            "enviar_codigo_de_rastreamento" => null,
            "enviar_codigo_de_rastreamento_msg_id" => null,
            "enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria" => null,
            "enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_id" => null,
            "enviar_mensagem_de_aviso_saiu_para_entrega" => null,
            "enviar_mensagem_de_aviso_saiu_para_entrega_msg_id" => null,
            "enviar_mensagem_de_confirmacao_de_entrega" => null,
            "enviar_mensagem_de_confirmacao_de_entrega_msg_id" => null,
            "enviar_mensagem_de_aviso_de_destinatario_ausente" => null,
            "enviar_mensagem_de_aviso_de_destinatario_ausente_msg_id" => null,
        ];

        $configRastreamento = [
            "user_id" => 1,
            "modulo_id" => 4,
            "enviar_notificacao_de_fatura_emitida" => null,
            "enviar_notificacao_de_fatura_vencendo" => null,
            "quantidade_de_envios_antecipados" => null,
            "quantidade_de_dias_antes_do_vencimento" => null,
            "quantidade_de_dias_de_intervalo_do_envio_vencimento" => null,
            "enviar_notificacao_de_fatura_no_vencimento" => null,
            "enviar_notificacao_de_fatura_vencida" => null,
            "quantidade_de_envios_apos_vencimento" => null,
            "quantidade_de_dias_de_intervalo_do_envio_vencida" => null,
            "enviar_notificacoes_para_cnpj" => 1,
            "enviar_notificacoes_para_cpf" => 0,
            "enviar_link_do_boleto" => null,
            "enviar_pdf_do_boleto" => null,
            "formas_pagamento" => null,
            "usar_dados_da_integracao" => 1,
            "usar_dados_importados" => 1,
            "usar_dados_importados_import" => [
                "3"
            ],
            "enviar_para_faturas_com_vencimento_a_partir_de" => null,
            "data_inicial" => null,
            "enviar_todos_os_dias_as_hora" => null,
            "enviar_pdf_da_nota_fiscal" => null,
            "enviar_link_da_nota_fiscal" => null,
            "enviar_xml_para_cnpj" => null,
            "enviar_xml_para_cpf" => null,
            "enviar_link_xml" => null,
            "enviar_arquivo_xml" => null,
            "enviar_mensagem_sobre_nao_receber_mais_notificacoes" => 0,
            "enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto" => null,
            "enviar_codigo_de_rastreamento" => 1,
            "enviar_codigo_de_rastreamento_msg_id" => 50,
            "enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria" => 1,
            "enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_id" => 51,
            "enviar_mensagem_de_aviso_saiu_para_entrega" => 1,
            "enviar_mensagem_de_aviso_saiu_para_entrega_msg_id" => 52,
            "enviar_mensagem_de_confirmacao_de_entrega" => 1,
            "enviar_mensagem_de_confirmacao_de_entrega_msg_id" => 53,
            "enviar_mensagem_de_aviso_de_destinatario_ausente" => 0,
            "enviar_mensagem_de_aviso_de_destinatario_ausente_msg_id" => null,
        ];

        \App\Models\ConfigSistemaModulo::factory()->create($configCobranca);
        \App\Models\ConfigSistemaModulo::factory()->create($configFaturamento);
        \App\Models\ConfigSistemaModulo::factory()->create($configRastreamento);
    }
}
