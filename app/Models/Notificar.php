<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Notificar extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notificar';

    protected $fillable = [
        'usuario_id',
        'id_conta',
        'conta',
        'celular',
        'msg_enviar',
    ];
}
