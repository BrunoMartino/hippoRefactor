<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plano extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'planos';
    protected $fillable = [
        'nome',
        'limite_mensagens',
        'valor',
        'qtd_usuarios',
        'qtd_instancias',
        'custo_excedente',
        'modulo_id',
        'icon',
        'color'
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function subscriptions()
    {
        return $this->hasMany(User::class);
    }
    
}
