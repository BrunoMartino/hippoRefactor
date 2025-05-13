<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportedOrderGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'module_id'
    ];

    public function imported_billings()
    {
        return $this->hasMany(ImportedBilling::class, 'group_id');
    }

    public function imported_remarketing()
    {
        return $this->hasMany(ImportedRemarketing::class, 'group_id');
    }

    public function imported_invoicing()
    {
        return $this->hasMany(ImportedInvoicing::class, 'group_id');
    }

    public function imported_tracking()
    {
        return $this->hasMany(ImportedTracking::class, 'group_id');
    }
}
