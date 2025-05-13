<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ConfigSistemaModulo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'modulo_id',
        // 'config',


        'enviar_notificacao_de_fatura_emitida',
        'enviar_notificacao_de_fatura_vencendo',
        'quantidade_de_envios_antecipados',
        'quantidade_de_dias_antes_do_vencimento',
        'quantidade_de_dias_de_intervalo_do_envio_vencimento',
        'enviar_notificacao_de_fatura_no_vencimento',
        'enviar_notificacao_de_fatura_vencida',
        'quantidade_de_envios_apos_vencimento',
        'quantidade_de_dias_de_intervalo_do_envio_vencida',
        'enviar_notificacoes_para_cnpj',
        'enviar_notificacoes_para_cpf',
        'enviar_link_do_boleto',
        'enviar_pdf_do_boleto',
        'formas_pagamento',
        'usar_dados_da_integracao',
        'usar_dados_importados',
        'usar_dados_importados_import',
        'enviar_para_faturas_com_vencimento_a_partir_de',
        'data_inicial',
        'enviar_todos_os_dias_as_hora',

        // faturamento
        'enviar_pdf_da_nota_fiscal',
        'enviar_link_da_nota_fiscal',
        'enviar_xml_para_cnpj',
        'enviar_xml_para_cpf',
        'enviar_link_xml',
        'enviar_arquivo_xml',
        'enviar_mensagem_sobre_nao_receber_mais_notificacoes',
        'enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto',

        // rastreamento
        'enviar_codigo_de_rastreamento',
        'enviar_codigo_de_rastreamento_msg_id',
        'enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria',
        'enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_id',
        'enviar_mensagem_de_aviso_saiu_para_entrega',
        'enviar_mensagem_de_aviso_saiu_para_entrega_msg_id',
        'enviar_mensagem_de_confirmacao_de_entrega',
        'enviar_mensagem_de_confirmacao_de_entrega_msg_id',
        'enviar_mensagem_de_aviso_de_destinatario_ausente',
        'enviar_mensagem_de_aviso_de_destinatario_ausente_msg_id',
    ];

    protected $casts = [
        'config' => 'array',
        'formas_pagamento' => 'array',
        'usar_dados_importados_import' => 'array',
    ];
}
