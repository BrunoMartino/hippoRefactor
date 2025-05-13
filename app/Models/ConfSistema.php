<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfSistema extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'modulo_id',
        'tipo',
        'status',
        'integracao',
    ];

    protected $casts = [
        'integracao' => 'array',
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
