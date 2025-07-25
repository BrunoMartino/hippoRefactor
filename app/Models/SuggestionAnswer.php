<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuggestionAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'text',
        'user_id',
        'suggestion_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
