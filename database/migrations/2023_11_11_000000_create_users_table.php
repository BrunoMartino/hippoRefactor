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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_usuario')->nullable()->default('PF');
            $table->string('nome_usuario');
            $table->string('razao_social')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->string('cpf')->unique()->nullable();
            $table->string('cnpj')->unique()->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('whatsapp')->unique()->nullable();
            $table->boolean('aceite')->default(true);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('reset_token')->nullable();
            $table->enum('status',  ['ativo', 'desativado'])->default('ativo');
            $table->unsignedBigInteger('cadastrado_por')->nullable();
            $table->unsignedBigInteger('nivel_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('plano_id')->nullable();
            $table->foreign('plano_id')->references('id')->on('planos');
            $table->foreign('cadastrado_por')->references('id')->on('users');
            $table->foreign('nivel_id')->references('id')->on('niveis');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->boolean('beta_user')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
