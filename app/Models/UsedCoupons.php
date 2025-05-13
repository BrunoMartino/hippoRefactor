<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsedCoupons extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'modulo_id',
        'plano_id',
        'cupom_id',
        'subscription_id',
    ];
}
