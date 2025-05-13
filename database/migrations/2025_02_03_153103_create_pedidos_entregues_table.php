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
        Schema::create('pedidos_entregues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('pedidoId')->nullable();
            $table->string('transportadora')->nullable();
            $table->string('cod_rastreamento');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_entregues');
    }
};
