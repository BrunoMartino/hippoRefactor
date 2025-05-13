<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportedBilling extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'order_number',
        'nf_number',
        'whatsapp',
        'contract',
        'birth_date',
        'issue_date',
        'due_date',
        'value',
        'link_boleto',
        'qr_code_pix',
        'payment_method',
        'gender',
        'uf',

        'user_id',
        'group_id',
        'module_id'
    ];

    protected $appends = [
        'contract_max_length',
        'birth_date_format_br',
    ];

    public function getContractMaxLengthAttribute()
    {
        return Str::limit($this->contract, 20);
    }

    public function getBirthDateFormatBrAttribute()
    {
        return date('d/m/Y', strtotime($this->birth_date));
    }
}
