<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessageReport extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'pedido',
        'nota_fiscal',
        'nome_cliente',
        'situacao',
        'data_envio',
        'whatsapp_enviado',
        'msg_enviada_id',
        'messageTimestamp',
        'data_visualizado',
        'idPedido',
        'idNotaFiscal',
        'user_id',
        'message_id',
        'identificador',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
