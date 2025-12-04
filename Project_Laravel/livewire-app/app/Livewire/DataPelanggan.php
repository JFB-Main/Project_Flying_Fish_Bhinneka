<?php
//INI CLASS BUAT DATA PELANGGAN DPS
//DPS
//DPS

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\PelangganDps; 

use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\DataPelangganExport;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DataPelanggan extends Component
{
    use WithPagination;

    public  $namaSearch;
    public  $teleponSearch;
    public  $emailSearch;
    public  $alamatSearch;

    public function getPelangganProperty()
    {
    return PelangganDps::query()
            ->when($this->namaSearch, fn (Builder $query) => $query->where('nama', 'like', "%{$this->namaSearch}%"))
            ->when($this->teleponSearch, fn (Builder $query) => $query->where('nomor_telepon', 'like', "%{$this->teleponSearch}%"))
            ->when($this->emailSearch, fn (Builder $query) => $query->where('email', 'like', "%{$this->emailSearch}%"))
            ->when($this->alamatSearch, fn (Builder $query) => $query->where('alamat', 'like', "%{$this->alamatSearch}%"))
            ->latest()
            ->paginate(10);
    }

    public function exportToExcel()
    {
        // 1. GATHER STATE: Collect all current search properties (filters)
        $filters = [
            'namaSearch' => $this->namaSearch,
            'teleponSearch' => $this->teleponSearch,
            'emailSearch' => $this->emailSearch,
            'alamatSearch' => $this->alamatSearch,
        ];
        
        try {
            $filename = 'Data_Pelanggan_DPS_' . now()->format('Ymd_His') . '.xlsx';
            
            // 2. TRIGGER EXPORT: Instantiate the export class with filters and trigger download.
            return Excel::download(new DataPelangganExport($filters), $filename);

        } catch (\Exception $e) {
            \Log::error("Livewire Data Pelanggan Export Failed: " . $e->getMessage());
            
            $this->dispatch('show-notification', [
                'type' => 'error',
                'message' => 'Gagal mengekspor data pelanggan. Error: ' . $e->getMessage(),
            ]);

            return;
        }
    }

    public function render()
    {
        return view('livewire.data-pelanggan',[
            'query_pelanggan' => $this->pelanggan,
        ])->extends('specific-dps')->section('dataPelangganContent');
    }
}
