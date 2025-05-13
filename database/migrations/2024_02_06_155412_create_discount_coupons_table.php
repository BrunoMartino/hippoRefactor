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
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('value', 12, 2)->nullable()->default(null);
            $table->integer('qtd_total');
            $table->integer('qtd_uso'); // quantidade de uso por usuário
            $table->integer('percent')->nullable()->default(null);
            $table->string('code');
            $table->enum('situation', ['ativo', 'desativado'])->default('ativo');
            $table->enum('occurrence', ['sim', 'nao'])->default('nao');
            $table->string('rec_duration')->nullable(); // Duração Recorrência
            $table->datetime('expiration_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_coupons');
    }
};
