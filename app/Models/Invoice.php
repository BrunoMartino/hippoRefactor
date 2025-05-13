<?php

namespace App\Models;

use App\Traits\InvoiceTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'user_id',
        'plan_id',
        'client_id',
        'invoice_id',
        'status',
        'type',
        'total_value',
        'qrcode',
        'date_payment',
        'quant_users'
    ];

    protected $casts = [
        'invoice_id' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plano::class);
    }

    public function payment()
    {
        return $this->hasOne(PaymentInvoice::class, 'invoice_id', 'invoice_id');
    }
}
