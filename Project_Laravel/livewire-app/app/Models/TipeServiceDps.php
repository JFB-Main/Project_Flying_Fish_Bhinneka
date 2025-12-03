<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipeServiceDps extends Model
{
    use HasFactory;
    protected $table = 'tipe_service_dps';
    protected $fillable = ['nama_tipe_service'];

    public function serviceLogs(): HasMany
    {
        return $this->hasMany(ServiceLogDps::class, 'id_tipe_service');
    }
}