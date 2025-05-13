<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NfsWithoutOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nfs_without_order';

    protected $fillable = [
        'user_id',
        'numero',
        'dataEmissao',
        'contatoId',
        'notaFiscalBlindId'
    ];
}
