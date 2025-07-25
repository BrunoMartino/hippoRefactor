<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Affiliate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'comission',
        'ref_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
