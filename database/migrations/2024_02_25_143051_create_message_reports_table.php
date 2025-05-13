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
        Schema::create('message_reports', function (Blueprint $table) {
            $table->id();
            $table->string('pedido')->nullable();
            $table->string('nota_fiscal')->nullable();
            $table->string('nome_cliente');
            $table->enum('situacao', ['entregue', 'nao_entregue', 'visualizado']);
            $table->datetime('data_envio');
            $table->string('whatsapp_enviado')->nullable();
            $table->string('msg_enviada_id')->nullable();
            $table->string('messageTimestamp')->nullable();
            $table->datetime('data_visualizado')->nullable();
            $table->string('idPedido')->nullable();
            $table->string('idNotaFiscal')->nullable();
            $table->datetime('dataNascimento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('uf')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('message_id')->constrained()->cascadeOnDelete();
            $table->string('identificador');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_reports');
    }
};
