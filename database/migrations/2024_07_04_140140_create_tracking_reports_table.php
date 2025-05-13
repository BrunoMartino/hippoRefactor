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
        Schema::create('tracking_reports', function (Blueprint $table) {
            $table->id();
            $table->string('pedido')->nullable();
            $table->string('nota_fiscal')->nullable();
            $table->string('contrato')->nullable();
            $table->string('nome_cliente');
            $table->enum('situacao', ['entregue', 'nao_entregue', 'visualizado']);
            $table->datetime('data_envio');
            $table->datetime('data_visualizado')->nullable();
            $table->string('msg_enviada_id')->nullable();
            $table->string('messageTimestamp')->nullable();
            $table->string('whatsapp_enviado')->nullable();
            $table->string('idPedido')->nullable();
            $table->string('idNotaFiscal')->nullable();
            $table->string('idContrato')->nullable();
            $table->datetime('dataNascimento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('uf')->nullable();
            $table->string('codigoRastreamento')->nullable();
            $table->string('situacao_entrega')->nullable();
            $table->datetime('data_situacao')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('message_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_reports');
    }
};
