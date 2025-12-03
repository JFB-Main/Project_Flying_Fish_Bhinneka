<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlamatServisDps extends Model
{
    use HasFactory;

    protected $table = 'alamat_servis_dps';
    protected $fillable = ['nama_alamat', 'id_pelanggan'];

    public function pelanggan_dps(): BelongsTo
    {
        return $this->belongsTo(PelangganDps::class, 'id_pelanggan');
    }

    public function produks_dps(): HasMany
    {
        return $this->hasMany(ProdukDps::class, 'id_alamat_servis');
    }

    public function serviceLogs_dps(): HasMany
    {
        return $this->hasMany(ServiceLogDps::class, 'id_alamat_servis');
    }
}