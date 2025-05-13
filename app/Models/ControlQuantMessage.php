<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ControlQuantMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'control_quant_messages';

    protected $fillable = [
        'user_id',
        'quant_mensagens',
        'mensagens_enviadas',
        'mensagens_restantes'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
