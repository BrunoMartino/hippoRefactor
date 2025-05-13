<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormasPagamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'formas_pagamento';

    protected $fillable = [
        'user_id',
        'idBling',
        'descricao',
    ];
}
