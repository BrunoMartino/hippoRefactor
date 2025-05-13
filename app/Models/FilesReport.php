<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FilesReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'modulo_id',
        'data_envio',
        'type',
        'situacao',
        'data_visualizado',
        'whatsapp_enviado',
        'messageTimestamp',
        'msg_enviada_id',
        'dataNascimento',
        'sexo',
        'uf',
    ];
}
