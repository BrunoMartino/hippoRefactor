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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->decimal('valor_plano', 10, 2)->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->enum('status', ['ativo', 'inativo'])->default('inativo');
            $table->datetime('data_change')->nullable();
            $table->datetime('data_cancel')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('plan_id')->references('id')->on('planos')->cascadeOnDelete();
            $table->foreign('coupon_id')->references('id')->on('discount_coupons')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
