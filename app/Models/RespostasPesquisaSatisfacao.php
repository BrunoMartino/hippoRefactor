<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RespostasPesquisaSatisfacao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'respostas_pesquisa_satisfacao';
    protected $fillable = [
        'user_id',
        'pesquisa_id',
        'whatsapp',
        'message_id',
        'etapa',
        'msg_enviada_id',
        'data_envio',
        'data_visualizado',
        'situacao',
        'resposta',
        'msg_recebida_id',
        'data_resposta',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
