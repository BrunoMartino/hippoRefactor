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
        Schema::create('billings_reports', function (Blueprint $table) {
            $table->id();
            $table->string('idCobrancaBling')->nullable();
            $table->string('pedido')->nullable();
            $table->string('nota_fiscal')->nullable();
            $table->string('contrato')->nullable();
            $table->string('nome_cliente');
            $table->decimal('valor', 10, 2);
            $table->date('vencimento')->nullable();
            $table->enum('situacao', ['entregue', 'nao_entregue', 'visualizado']);
            $table->datetime('data_envio');
            $table->datetime('data_visualizado')->nullable();
            $table->string('whatsapp_enviado')->nullable();
            $table->string('msg_enviada_id')->nullable();
            $table->string('messageTimestamp')->nullable();
            $table->datetime('dataNascimento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('uf')->nullable();
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
        Schema::dropIfExists('billings_reports');
    }
};
