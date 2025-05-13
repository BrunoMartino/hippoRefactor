<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notificacoes';

    protected $fillable = [
        'usuario_id',
        'id_conta',
        'vencimento',
        'valor',
        'numero_contrato',
        'nome',
        'situacao',
    ];
}
