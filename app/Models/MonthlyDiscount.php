<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyDiscount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'modulo_id',
        'plano_id',
        'valor',
        'porcentagem',
        'dt_inicio',
        'dt_termino',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }
}
