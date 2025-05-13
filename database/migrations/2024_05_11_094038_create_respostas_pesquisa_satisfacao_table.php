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
        Schema::create('respostas_pesquisa_satisfacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('message_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('pesquisa_id');
            $table->foreign('pesquisa_id')->references('id')->on('messages')->cascadeOnDelete();
            $table->string('whatsapp');
            $table->string('etapa');
            $table->string('msg_enviada_id')->nullable();
            $table->datetime('data_envio')->nullable();
            $table->datetime('data_visualizado')->nullable();
            $table->enum('situacao', ['entregue', 'nao_entregue', 'visualizado'])->nullable();
            $table->string('resposta')->nullable();
            $table->string('msg_recebida_id')->nullable();
            $table->dateTime('data_resposta')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respostas_pesquisa_satisfacao');
    }
};
