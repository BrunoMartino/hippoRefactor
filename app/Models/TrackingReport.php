<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TrackingReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pedido',
        'nota_fiscal',
        'contrato',
        'nome_cliente',
        'situacao',
        'data_envio',
        'whatsapp_enviado',
        'data_visualizado',
        'msg_enviada_id',
        'situacao_entrega',
        'messageTimestamp',
        'idPedido',
        'idNotaFiscal',
        'idContrato',
        'user_id',
        'message_id',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
