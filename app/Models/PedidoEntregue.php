<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedidoEntregue extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pedidos_entregues';

    protected $fillable = [
        'user_id',
        'pedidoId',
        'transportadora',
        'cod_rastreamento',
    ];
}
