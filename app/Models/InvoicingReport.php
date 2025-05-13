<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class InvoicingReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pedido',
        'nota_fiscal',
        'contrato',
        'nome_cliente',
        'situacao',
        'data_envio',
        'data_visualizado',
        'msg_enviada_id',
        'whatsapp_enviado',
        'messageTimestamp',
        'idPedido',
        'idNotaFiscal',
        'idContrato',
        'user_id',
        'message_id',
        'enviado_pdf_nf',
        'enviado_xml_nf'
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
