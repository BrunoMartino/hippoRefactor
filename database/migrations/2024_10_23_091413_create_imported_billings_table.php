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
        Schema::create('imported_billings', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('order_number')->nullable();
            $table->string('nf_number')->nullable();
            $table->string('whatsapp')->nullable();// a posição do 'whatsapp' no array não deve ser alterada
            $table->string('contract')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->decimal('value', 10,2)->nullable();
            $table->string('link_boleto')->nullable();
            $table->longText('qr_code_pix')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('gender')->nullable();
            $table->string('uf')->nullable();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('imported_order_groups')->cascadeOnDelete();
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
        Schema::dropIfExists('imported_billings');
    }
};
