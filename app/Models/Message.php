<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'description',
        'satisfaction_survey',
        'user_id',
        'module_id'
    ];

    protected $casts = [
        'satisfaction_survey' => 'array',
    ];
    
    public function sending_setting()
    {
        return $this->hasOne(SendingSetting::class);
    }
}
