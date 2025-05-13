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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', [
                'ANIVERSÁRIO',
                'AGRADECIMENTO',
                'PESQUISA SATISFAÇÃO',
                'PESQUISA SATISFAÇÃO ANEXO',

                'COBRANÇA GERADA',
                'COBRANÇA VENCENDO',
                'COBRANÇA VENCIMENTO',
                'COBRANÇA VENCIDA',

                // 'FATURAMENTO - PEDIDO',
                // 'FATURAMENTO - NF',
                'FATURAMENTO - PEDIDO RECEBIDO',
                'FATURAMENTO - PEDIDO EM ANDAMENTO',
                'FATURAMENTO - PEDIDO ATENDIDO',
                'FATURAMENTO - PEDIDO VERIFICADO',
                'FATURAMENTO - PEDIDO EM SEPARAÇÃO',
                
                'RASTREIO - CODIGO',
                'RASTREIO - PROXIMO DESTINO',
                'RASTREIO - LOC ATUAL',
                'RASTREIO - SAIU ENTREGAR',
                'RASTREIO - CONFIRMACAO',
                'RASTREIO - AUSENTE'
            ]);
            $table->text('description')->nullable();
            $table->json('satisfaction_survey')->nullable(); // json para pesquisa satisfação
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('module_id');
            $table->foreign('module_id')->references('id')->on('modulos')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
