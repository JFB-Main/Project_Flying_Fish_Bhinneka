<?php

namespace App\Exports;

use App\Models\PelangganDps; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Builder;

class DataPelangganExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    /**
     * Constructor: Accepts the current search filter values from the Livewire component.
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
    * collection(): Builds the filtered query based on the active search terms.
    */
    public function collection()
    {
        // Start the base query
        $query = PelangganDps::query();

        $f = $this->filters;

        // Apply filters (matching the logic in DataPelanggan::getPelangganProperty)
        $query->when($f['namaSearch'], fn (Builder $q) => $q->where('nama', 'like', "%{$f['namaSearch']}%"));
        $query->when($f['teleponSearch'], fn (Builder $q) => $q->where('nomor_telepon', 'like', "%{$f['teleponSearch']}%"));
        $query->when($f['emailSearch'], fn (Builder $q) => $q->where('email', 'like', "%{$f['emailSearch']}%"));
        $query->when($f['alamatSearch'], fn (Builder $q) => $q->where('alamat', 'like', "%{$f['alamatSearch']}%"));

        // Use the same ordering (latest/newest first)
        return $query->latest()->get();
    }

    /**
    * headings(): Defines the column headers for the Excel file.
    */
    public function headings(): array
    {
        return [
            'ID Pelanggan',
            'Nama',
            'Email',
            'Nomor Telepon',
            'Alamat Utama',
            'Tanggal Dibuat',
        ];
    }

    /**
    * map(): Maps the PelangganDps model object to the Excel row structure.
    */
    public function map($pelanggan): array
    {
        return [
            $pelanggan->id,
            $pelanggan->nama,
            $pelanggan->email,
            $pelanggan->nomor_telepon,
            $pelanggan->alamat,
            $pelanggan->created_at->format('Y-m-d H:i:s'),
        ];
    }
}