<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountCoupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'value',
        'qtd_total',
        'qtd_uso',
        'percent',
        'code',
        'situation',
        'occurrence',
        'rec_duration', // Duração Recorrência
        'expiration_date',
    ];


    public function used_coupons()
    {
        return $this->hasMany(UsedCoupons::class, 'cupom_id');
    }
}
