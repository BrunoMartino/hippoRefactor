<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sistema extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'usuario_id',
        'whatsapp_remarketing',
        'whatsapp_faturamento',
        'whatsapp_nota',
        'whatsapp_cobrancas',
        'chave_bling',
        'gerado',
        'vencendo',
        'vencimento',
        'vencido',
        'cnpj',
        'cpf',
        'link',
        'pdf',
        'agradecimento',
        'satisfacao',
        'autoforma',
        'sem_notificacao',
        'pesq_satisfacao',
        'aniversario',
        'cupom_desc',];

    // Relação com o usuário, se necessário
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
