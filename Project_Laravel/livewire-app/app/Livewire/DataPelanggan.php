<?php
//INI CLASS BUAT DATA PELANGGAN DPS
//DPS
//DPS

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\PelangganDps; 

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


    public function render()
    {
        return view('livewire.data-pelanggan',[
            'query_pelanggan' => $this->pelanggan,
        ])->extends('specific-dps')->section('dataPelangganContent');
    }
}
