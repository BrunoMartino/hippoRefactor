<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'job_status';
    protected $fillable = [
        'user_id',
        'batch_id',
        'job_name',
        'status'
    ];
}
