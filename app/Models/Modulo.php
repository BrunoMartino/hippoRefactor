<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modulo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'titulo',
    ];

    public function confSistemas()
    {
        return $this->hasMany(ConfSistema::class);
    }

    public function planos()
    {
        return $this->hasMany(Plano::class);
    }
}
