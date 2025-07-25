<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NFS extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'nfs';

    protected $fillable = [
        'user_id',
        'numero',
        'dataEmissao',
        'contatoId',
        'notaFiscalBlingId',
    ];
}
