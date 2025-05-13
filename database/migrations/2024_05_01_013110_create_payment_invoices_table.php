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
        Schema::create('payment_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_id');
            $table->string('payment_method');
            $table->string('status');
            $table->string('transaction_id');
            $table->string('payed_at');
            $table->string('card_token_id')->nullable();
            $table->json('credit_card')->nullable();
            $table->json('request_meta_data')->nullable();
            $table->json('parcels')->nullable();
            $table->json('pix')->nullable();
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_invoices');
    }
};
