<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_invoices';

    protected $fillable = [
        'user_id',
        'invoice_id',
        'payment_method',
        'status',
        'transaction_id',
        'payed_at',
        'card_token_id',
        'credit_card',
        'request_meta_data',
        'parcels',
        'pix'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
