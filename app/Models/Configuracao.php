<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'configuracoes';

    protected $fillable = [
        'usuario_id',
        'chave_bling',
        'whatsapp_remarketing',
        'agradecimento',
        'satisfacao',
        'autoforma',
        'sem_notificacao',
        'pesq_satisfacao',
        'aniversario',
        'cupom_desc',

        'whatsapp_faturamento',
        'whatsapp_nota',

        'whatsapp_cobrancas',
        'gerado',
        'vencendo',
        'vencimento',
        'vencido',
        'cnpj',
        'cpf',
        'link',
        'pdf',
    ];
}
