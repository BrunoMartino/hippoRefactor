<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('invoice_id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('plan_id')->references('id')->on('planos')->cascadeOnDelete();
            $table->string('client_id');
            $table->string('status');
            $table->string('discount_coupon')->nullable();
            $table->string('total_value');
            $table->string('type');
            $table->integer('quant_users')->nullable();
            $table->text('qrcode')->nullable();
            $table->date('date_payment')->nullable();
            $table->string('situation')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
