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
        Schema::create('sending_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('module_id');
            $table->foreign('module_id')->references('id')->on('modulos')->cascadeOnDelete();
            // $table->json('settings')->nullable();

            $table->string('name')->nullable();
            $table->boolean('message_no_receiving_notifications')->nullable();
            $table->longText('message_no_receiving_notifications_text')->nullable();
            $table->boolean('send_message_for_satisfaction_survey')->nullable();
            $table->bigInteger('send_message_for_satisfaction_survey_id_message')->nullable();
            $table->boolean('send_to_pj')->nullable();
            $table->boolean('send_to_pf')->nullable();
            $table->boolean('automatic_send_at_9am_every_day')->nullable();
            $table->boolean('every_day_at_specific_time')->nullable();
            $table->string('every_day_at_specific_time_value')->nullable();
            $table->boolean('specific_date')->nullable();
            $table->string('specific_date_value_date')->nullable();
            $table->string('specific_date_value_time')->nullable();
            $table->boolean('only_customers_nf')->nullable();
            $table->boolean('use_imported_data')->nullable();
            $table->json('use_imported_data_import')->nullable();
            $table->boolean('use_integration_data')->nullable();
            $table->boolean('send_only_for_new_sales')->nullable();
            $table->boolean('send_to_sales_from')->nullable();
            $table->string('send_to_sales_from_date')->nullable();
            $table->text('image')->nullable();
            $table->boolean('qtd_dias_apos_entrega')->nullable();
            $table->bigInteger('qtd_dias_apos_entrega_valor')->nullable();
            $table->boolean('qtd_dias_nao_rast')->nullable();
            $table->bigInteger('qtd_dias_nao_rast_valor')->nullable();


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sending_settings');
    }
};
