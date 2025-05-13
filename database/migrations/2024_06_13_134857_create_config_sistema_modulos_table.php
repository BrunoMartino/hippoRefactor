<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('config_sistema_modulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('modulo_id')->constrained()->cascadeOnDelete();
            // $table->json('config')->nullable();

            // cobranças e outros
            $table->boolean('enviar_notificacao_de_fatura_emitida')->nullable();
            $table->boolean('enviar_notificacao_de_fatura_vencendo')->nullable();
            $table->integer('quantidade_de_envios_antecipados')->nullable();
            $table->integer('quantidade_de_dias_antes_do_vencimento')->nullable();
            $table->integer('quantidade_de_dias_de_intervalo_do_envio_vencimento')->nullable();
            $table->boolean('enviar_notificacao_de_fatura_no_vencimento')->nullable();
            $table->boolean('enviar_notificacao_de_fatura_vencida')->nullable();
            $table->integer('quantidade_de_envios_apos_vencimento')->nullable();
            $table->integer('quantidade_de_dias_de_intervalo_do_envio_vencida')->nullable();
            $table->boolean('enviar_notificacoes_para_cnpj')->nullable();
            $table->boolean('enviar_notificacoes_para_cpf')->nullable();
            $table->boolean('enviar_link_do_boleto')->nullable();
            $table->boolean('enviar_pdf_do_boleto')->nullable();
            $table->json('formas_pagamento')->nullable();
            $table->boolean('usar_dados_da_integracao')->nullable();
            $table->boolean('usar_dados_importados')->nullable();
            $table->json('usar_dados_importados_import')->nullable();
            $table->boolean('enviar_para_faturas_com_vencimento_a_partir_de')->nullable();
            $table->date('data_inicial')->nullable();
            $table->string('enviar_todos_os_dias_as_hora')->nullable();

            // faturamento e outros
            $table->boolean('enviar_pdf_da_nota_fiscal')->nullable();
            $table->boolean('enviar_link_da_nota_fiscal')->nullable();
            $table->boolean('enviar_xml_para_cnpj')->nullable();
            $table->boolean('enviar_xml_para_cpf')->nullable();
            $table->boolean('enviar_link_xml')->nullable();
            $table->boolean('enviar_arquivo_xml')->nullable();
            $table->boolean('enviar_mensagem_sobre_nao_receber_mais_notificacoes')->nullable();
            $table->longText('enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto')->nullable();

            // rastreamento e outros
            $table->boolean('enviar_codigo_de_rastreamento')->nullable();
            $table->bigInteger('enviar_codigo_de_rastreamento_msg_id')->nullable();
            $table->boolean('enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria')->nullable();
            $table->bigInteger('enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_id')->nullable();
            $table->boolean('enviar_mensagem_de_aviso_saiu_para_entrega')->nullable();
            $table->bigInteger('enviar_mensagem_de_aviso_saiu_para_entrega_msg_id')->nullable();
            $table->boolean('enviar_mensagem_de_confirmacao_de_entrega')->nullable();
            $table->bigInteger('enviar_mensagem_de_confirmacao_de_entrega_msg_id')->nullable();
            $table->boolean('enviar_mensagem_de_aviso_de_destinatario_ausente')->nullable();
            $table->bigInteger('enviar_mensagem_de_aviso_de_destinatario_ausente_msg_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_sistema_modulos');
    }
};
