<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BillingsReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'idCobrancaBling',
        'pedido',
        'nota_fiscal',
        'contrato',
        'nome_cliente',
        'situacao',
        'data_envio',
        'data_visualizado',
        'whatsapp_enviado',
        'msg_enviada_id',
        'messageTimestamp',
        'idPedido',
        'idNotaFiscal',
        'idContrato',
        'user_id',
        'valor',
        'message_id',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
