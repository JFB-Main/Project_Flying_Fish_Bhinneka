<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PelangganDps extends Model
{
    use HasFactory;

    protected $table = 'pelanggan_dps';
    protected $fillable = ['nama', 'email', 'nomor_telepon', 'alamat'];

    public function alamatServis_dps(): HasMany
    {
        return $this->hasMany(AlamatServisDps::class, 'id_pelanggan');
    }

    public function produks_dps(): HasMany
    {
        return $this->hasMany(ProdukDps::class, 'id_pelanggan_dps');
    }

    public function serviceLogs_dps(): HasMany
    {
        return $this->hasMany(ServiceLogDps::class, 'id_pelanggan');
    }
}