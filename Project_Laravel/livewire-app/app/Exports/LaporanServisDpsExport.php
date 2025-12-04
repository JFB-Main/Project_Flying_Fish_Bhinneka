<?php

namespace App\Exports;

use App\Models\ServiceLogDps; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class LaporanServisDpsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    /**
     * Constructor: Accepts the current filter values from the Livewire component.
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
    * collection(): Builds the filtered query and fetches the collection.
    */
    public function collection()
    {
        // Eager load all necessary relationships defined in ServiceLogDps model
        $query = ServiceLogDps::with([
            'pelanggan_dps', 'produk_dps', 'status_dps', 'teknisi_dps', 'tipeService_dps', 'creator_dps',
        ])
        ->where('status', '=', 4); // Filter to only show completed service logs

        $f = $this->filters;

        // --- Applying Filters (identical to Livewire component logic) ---
        
        $query->when($f['inputPelanggan'], fn (Builder $q) => $q->where('id_pelanggan', '=', $f['inputPelanggan']));
        
        $query->when($f['inputProduk'], fn (Builder $q) => $q->whereHas('produk_dps', fn (Builder $subQuery) 
            => $subQuery->where('nama_produk', 'like', "%{$f['inputProduk']}%")
        ));
        
        $query->when($f['inputNomorServis'], fn (Builder $q) => $q->where('nomor_service', 'like', "%{$f['inputNomorServis']}%"));
        
        $query->when($f['inputNomorSeri'], fn (Builder $q) => $q->whereHas('produk_dps', fn (Builder $subQuery) 
            => $subQuery->where('serial_number', 'like', "%{$f['inputNomorSeri']}%")
        ));
        
        $query->when($f['inputTeknisi'], fn (Builder $q) => $q->where('id_teknisi', '=', $f['inputTeknisi']));
        
        $query->when($f['inputStatus'], fn (Builder $q) => $q->where('status', '=', $f['inputStatus']));
        
        // Date Range Filters on 'waktu_mulai'
        $query->when($f['inputWaktuAwal'] && $f['inputWaktuAkhir'], fn (Builder $q) => 
            $q->whereBetween('waktu_mulai', [ $f['inputWaktuAwal'], $f['inputWaktuAkhir'] . ' 23:59:59' ])
        );
        $query->when($f['inputWaktuAwal'] && !$f['inputWaktuAkhir'], fn (Builder $q) => 
            $q->where('waktu_mulai', '>=', $f['inputWaktuAwal'])
        );
        $query->when($f['inputWaktuAkhir'] && !$f['inputWaktuAwal'], fn (Builder $q) => 
            $q->where('waktu_mulai', '<=', $f['inputWaktuAkhir'] . ' 23:59:59')
        );

        return $query->orderBy('nomor_service', 'desc')->get();
    }

    /**
    * headings(): Defines the header row for the Excel file.
    */
    public function headings(): array
    {
        return [
            'Nomor Servis',
            'Tanggal Masuk (Jadwal)',
            'Nama Pelanggan',
            'Alamat Servis',
            'Nomor Seri Produk',
            'Nama Produk',
            'Tipe Service',
            'Status Akhir',
            'Teknisi Yang Menangani',
            'Waktu Mulai Service',
            'Waktu Selesai Service',
            'Dibuat Oleh',
            'Permasalahan',
        ];
    }

    /**
    * map(): Maps the ServiceLogDps model object to the Excel row structure.
    */
    public function map($log): array
    {
        return [
            $log->nomor_service,
            // We use 'jadwal_kunjungan' as the entry date/schedule if 'date_in' isn't available
            $log->jadwal_kunjungan, 
            $log->pelanggan_dps->nama ?? 'N/A',
            $log->alamatServis_dps->alamat_lengkap ?? 'N/A', // Using AlamatServisDps relation
            $log->produk_dps->serial_number ?? 'N/A',
            $log->produk_dps->nama_produk ?? 'N/A',
            $log->tipeService_dps->nama_tipe ?? 'N/A',
            $log->status_dps->status_name ?? 'N/A', // Assuming StatusDps has a status_name field
            $log->teknisi_dps->username ?? 'N/A',
            $log->waktu_mulai,
            $log->waktu_selesai,
            $log->creator_dps->username ?? 'N/A',
            $log->permasalahan, // Using the 'permasalahan' field
        ];
    }
}