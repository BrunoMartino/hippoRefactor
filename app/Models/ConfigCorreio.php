<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigCorreio extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'modulo_id',
        'codigo_api',
        'contrato',
        'basic_auth',
        'token',
        'emissao',
        'expiraEm',
    ];
}
