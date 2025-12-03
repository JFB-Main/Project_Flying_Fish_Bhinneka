<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusDps extends Model
{
    use HasFactory;
    protected $table = 'status_dps';
    protected $fillable = ['status_type'];

    public function serviceLogs(): HasMany
    {
        return $this->hasMany(ServiceLogDps::class, 'status');
    }
    
    public function statusUpdateLogs(): HasMany
    {
        // Links StatusDps.id (PK) to status_updatelog_dps.status_id (FK)
        return $this->hasMany(StatusUpdatelogDps::class, 'status_id');
    }
}