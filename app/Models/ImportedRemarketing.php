<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportedRemarketing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'imported_remarketing';
    protected $fillable = [
        'name',
        'type',
        'order_number',
        'nf_number',
        'whatsapp',
        'birth_date',
        'contract',
        'date_order',
        'date_nf',
        'date_contract',
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
