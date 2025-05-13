<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportedTracking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'order_number',
        'nf_number',
        'whatsapp',
        'send_date',
        'contract',
        'carrier',
        'cod_rastreio',
        'link_rastreio',
        'birth_date',
        'gender',
        'uf',
        'user_id',
        'group_id',
        'module_id'
    ];

    protected $appends = [
        'birth_date_format_br',
    ];
    
    public function getBirthDateFormatBrAttribute()
    {
        return date('d/m/Y', strtotime($this->birth_date));
    }
}
