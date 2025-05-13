<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SendingSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'message_id',
        'module_id',
        // 'settings',


        'name',
        'message_no_receiving_notifications',
        'message_no_receiving_notifications_text',
        'send_message_for_satisfaction_survey',
        'send_message_for_satisfaction_survey_id_message',
        'send_to_pj',
        'send_to_pf',
        'automatic_send_at_9am_every_day',
        'every_day_at_specific_time',
        'every_day_at_specific_time_value',
        'specific_date',
        'specific_date_value_date',
        'specific_date_value_time',
        'only_customers_nf',
        'use_imported_data',
        'use_imported_data_import',
        'use_integration_data',
        'send_only_for_new_sales',
        'send_to_sales_from',
        'send_to_sales_from_date',
        'image',
        'qtd_dias_apos_entrega',
        'qtd_dias_apos_entrega_valor',
        'qtd_dias_nao_rast',
        'qtd_dias_nao_rast_valor'
    ];

    protected $casts = [
        // 'settings' => 'array', 
        'use_imported_data_import' => 'array',
    ];
}
