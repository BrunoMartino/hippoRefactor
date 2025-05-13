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
        Schema::create('files_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('modulo_id')->constrained()->cascadeOnDelete();
            $table->dateTime('data_envio');
            $table->integer('type');
            $table->enum('situacao', ['entregue', 'nao_entregue', 'visualizado']);
            $table->datetime('data_visualizado')->nullable();
            $table->string('whatsapp_enviado')->nullable();
            $table->string('messageTimestamp')->nullable();
            $table->string('msg_enviada_id')->nullable();
            $table->datetime('dataNascimento')->nullable();
            $table->string('sexo')->nullable();
            $table->string('uf')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files_reports');
    }
};
