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
        Schema::create('contas_receber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('idBling');
            $table->date('vencimento');
            $table->decimal('valor', 12, 2);
            $table->text('linkQRCodePix')->nullable();
            $table->string('linkBoleto')->nullable();
            $table->date('dataEmissao')->nullable();
            $table->string('contatoId');
            $table->string('formaPagamentoId');
            $table->string('pedido')->nullable();
            $table->string('notaFiscal')->nullable();
            $table->string('contrato')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_receber');
    }
};
