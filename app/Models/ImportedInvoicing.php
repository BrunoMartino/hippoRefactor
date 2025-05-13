<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportedInvoicing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'imported_invoicing';
    protected $fillable = [
        'name',
        'type',
        'order_number',
        'nf_number',
        'whatsapp',
        'contract',
        'link_nf',
        'link_xml',
        'birth_date',
        'gender',
        'uf',
        'situacao',
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
