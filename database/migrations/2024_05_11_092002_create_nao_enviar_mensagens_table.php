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
        Schema::create('nao_enviar_mensagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('whatsapp');
            $table->string('msg_enviada_id')->nullable();
            $table->datetime('data_envio')->nullable();
            $table->datetime('data_visualizado')->nullable();
            $table->enum('situacao', ['entregue', 'nao_entregue', 'visualizado'])->nullable();           
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nao_enviar_mensagens');
    }
};
