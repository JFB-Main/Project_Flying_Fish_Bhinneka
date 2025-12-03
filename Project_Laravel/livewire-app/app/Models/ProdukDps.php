<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProdukDps extends Model
{
    use HasFactory;

    protected $table = 'produk_dps';
    protected $fillable = [
        'sku_produk', 'nama_produk', 'serial_number', 'nomor_invoice_so', 
        'sales_order', 'produk_bhinneka', 'id_warranty', 'id_alamat_servis', 'id_pelanggan_dps'
    ];

    public function pelanggan_dps(): BelongsTo
    {
        return $this->belongsTo(PelangganDps::class, 'id_pelanggan_dps');
    }

    public function alamatServis_dps(): BelongsTo
    {
        return $this->belongsTo(AlamatServisDps::class, 'id_alamat_servis');
    }

    public function warranty_dps(): BelongsTo
    {
        return $this->belongsTo(WarrantyModel::class, 'id_warranty');
    }

    public function serviceLogs_dps(): HasMany
    {
        return $this->hasMany(ServiceLogDps::class, 'id_produk');
    }
}