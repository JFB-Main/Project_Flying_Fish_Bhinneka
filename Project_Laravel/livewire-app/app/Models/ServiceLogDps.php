<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceLogDps extends Model
{
    use HasFactory;

    protected $table = 'service_logs_dps';
    protected $fillable = [
        'nomor_service', 'id_tipe_service', 'status', 'jadwal_kunjungan', 
        'waktu_mulai', 'waktu_selesai', 'id_produk', 'id_pelanggan', 
        'id_alamat_servis', 'id_teknisi', 'created_by', 'permasalahan'
    ];

    public function tipeService_dps(): BelongsTo
    {
        return $this->belongsTo(TipeServiceDps::class, 'id_tipe_service');
    }

    public function status_dps(): BelongsTo
    {
        return $this->belongsTo(StatusDps::class, 'status');
    }

    public function produk_dps(): BelongsTo
    {
        return $this->belongsTo(ProdukDps::class, 'id_produk');
    }

    public function pelanggan_dps(): BelongsTo
    {
        return $this->belongsTo(PelangganDps::class, 'id_pelanggan');
    }

    public function alamatServis_dps(): BelongsTo
    {
        return $this->belongsTo(AlamatServisDps::class, 'id_alamat_servis');
    }


    public function teknisi_dps(): BelongsTo
    {
        return $this->belongsTo(UsersModel::class, 'id_teknisi');
    }

    public function creator_dps(): BelongsTo
    {
        return $this->belongsTo(UsersModel::class, 'created_by');
    }

    public function notes_dps(): HasMany
    {
        return $this->hasMany(NoteDps::class, 'id_service_logs_dps');
    }

    public function statusUpdateHistory(): HasMany
    {
        // Links service_logs_dps.id (PK) to status_updatelog_dps.service_logs_id_dps (FK)
        return $this->hasMany(StatusUpdatelogDps::class, 'service_logs_id_dps');
    }
}