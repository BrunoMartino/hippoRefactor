<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateReferral extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'affiliate_id',
        'contract_date',
        'commission'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class)->withTrashed();
    }
}
