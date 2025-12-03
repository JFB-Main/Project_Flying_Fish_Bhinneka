<?php

namespace App\Livewire;

use App\Models\StatusUpdatelogDps;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use App\Models\ServiceLogDps;
use App\Models\StatusDps;
use App\Models\UsersModel;
use App\Models\PelangganDps;

use Livewire\Attributes\Computed;

use Illuminate\Database\Eloquent\Builder;

class ManajemenServis extends Component
{
    use WithPagination;

    public $inputPelanggan ; //take id pelanggan
    public $inputProduk ;

    public $inputNomorServis ;
    public $inputNomorSeri ;
    public $inputTeknisi ;
    public $inputStatus ;
    public $inputWaktuAwal;
    public $inputWaktuAkhir;

    public $allStatuses;
    public $allPelanggan;
    public $allUsers;

    public function mount()
    {
        // Redirect if not logged in
        if (!auth()->check()) {
            return $this->redirect(route('auth.login'), navigate: true);
        }

        // Fetch static data only once on mount
        $this->allStatuses = StatusDps::where('id', '<', 4)->get();

        $this->allUsers = UsersModel::orderBy('username', 'asc')->get()->where('module_role', '=', 2);

        $this->allPelanggan = PelangganDps::orderBy('nama', 'asc')->get();
    }

    #[Computed]
    public function serviceLogData()
    {

        return ServiceLogDps::with([
            'tipeService_dps', // Links to TipeServiceDps via id_tipe_service
            'status_dps',      // Links to StatusDps via status
            'produk_dps',      // Links to ProdukDps via id_produk
            'pelanggan_dps',   // Links to PelangganDps via id_pelanggan
            'teknisi_dps',     // Links to UsersModel via id_teknisi
            'creator_dps',     // Links to UsersModel via created_by
            // 'notes_dps' is a HasMany relationship, typically only loaded 
            // if you need to display all notes for every log item.
        ])
        ->where('status', '<', 4)
        ->when($this->inputPelanggan, fn (Builder $query) => $query->where('id_pelanggan', '=', $this->inputPelanggan))
        ->when($this->inputProduk, fn (Builder $query) => $query->whereHas('produk_dps', fn (Builder $subQuery) 
            => $subQuery->where('nama_produk', 'like', "%{$this->inputProduk}%")
            ))
        ->when($this->inputNomorServis, fn (Builder $query) => $query->where('nomor_service', 'like', "%{$this->inputNomorServis}%"))
        ->when($this->inputNomorSeri, fn (Builder $query) => $query->whereHas('produk_dps', fn (Builder $subQuery) 
            => $subQuery->where('serial_number', 'like', "%{$this->inputNomorSeri}%")
            ))
        ->when($this->inputTeknisi, fn (Builder $query) => $query->where('id_teknisi', '=', $this->inputTeknisi))
        ->when($this->inputStatus, fn (Builder $query) => $query->where('status', '=', $this->inputStatus))
        // ->when($this->inputWaktuAwal, fn (Builder $query) => $query->whereDate('date_in', $this->inputWaktuAwal))

        // 1. Both start (Waktu Awal) and end (Waktu Akhir) dates are provided.
        ->when($this->inputWaktuAwal && $this->inputWaktuAkhir, fn (Builder $query) => 
            $query->whereBetween('waktu_mulai', [
                $this->inputWaktuAwal, 
                // Append time to ensure the search includes the entire last day
                $this->inputWaktuAkhir . ' 23:59:59'
            ])
        )
        // 2. Only the start date (Waktu Awal) is provided.
        ->when($this->inputWaktuAwal && !$this->inputWaktuAkhir, fn (Builder $query) => 
            $query->where('waktu_mulai', '>=', $this->inputWaktuAwal)
        )
        // 3. Only the end date (Waktu Akhir) is provided.
        ->when($this->inputWaktuAkhir && !$this->inputWaktuAwal, fn (Builder $query) => 
            $query->where('waktu_mulai', '<=', 
                // Append time to ensure the search includes the entire day
                $this->inputWaktuAkhir . ' 23:59:59'
            ))
        ->orderBy('nomor_service', 'desc')
        ->paginate(10);
    }

    public function updateTiketdps($id_tiket){
        // dd($id_tiket, 'update');
        $serviceLog = ServiceLogDps::with('teknisi_dps')->find($id_tiket);

        if (!$serviceLog) {
            session()->flash('error', 'Service Log not found.');
            return;
        }
        
        if($serviceLog->status == 2){
            $finalizeStatusId = 4;

            $note_update = "Tiket ditutup oleh: ".$serviceLog->teknisi_dps->username;

            $serviceLog->status = $finalizeStatusId;
            $serviceLog->waktu_selesai = now();

            $serviceLog->save();

            // Create the status update log
            StatusUpdatelogDps::create([
                'service_logs_id_dps' => $serviceLog->id,
                'status_id' => $finalizeStatusId,
                'status_note' => $note_update
            ]);
            $this->dispatch('crud-done');
        }
        else{
            $finalizeStatusId = 2;

            $note_update = "Tiket diupdate oleh: ".$serviceLog->teknisi_dps->username;

            $serviceLog->status = $finalizeStatusId;

            $serviceLog->save();

            // Create the status update log
            StatusUpdatelogDps::create([
                'service_logs_id_dps' => $serviceLog->id,
                'status_id' => $finalizeStatusId,
                'status_note' => $note_update
            ]);
            $this->dispatch('crud-done');
        }

    }

    public function pendingTiketdps($id_tiket){
        // dd($id_tiket, 'pending');

        $serviceLog = ServiceLogDps::with('teknisi_dps')->find($id_tiket);

        if (!$serviceLog) {
            session()->flash('error', 'Service Log not found.');
            return;
        }

        if($serviceLog->status == 2){
            $pendingStatusId = 3;

            $note_update = "Tiket dipending oleh: ".$serviceLog->teknisi_dps->username;

            $serviceLog->status = $pendingStatusId;

            $serviceLog->save();

            // Create the status update log
            StatusUpdatelogDps::create([
                'service_logs_id_dps' => $serviceLog->id,
                'status_id' => $pendingStatusId,
                'status_note' => $note_update
            ]);
            $this->dispatch('crud-done');
        }
        else if($serviceLog->status == 3){
            $pendingStatusId = 2;

            $note_update = "Tiket dilanjutkan oleh: ".$serviceLog->teknisi_dps->username;

            $serviceLog->status = $pendingStatusId;

            $serviceLog->save();

            // Create the status update log
            StatusUpdatelogDps::create([
                'service_logs_id_dps' => $serviceLog->id,
                'status_id' => $pendingStatusId,
                'status_note' => $note_update
            ]);
            $this->dispatch('crud-done');
        }
    }

    public function deleteTiketdps($id_tiket){
        dd($id_tiket);
    }

    #[On(event: 'crud-done')]
    public function noteRefresh()
    {
        // dd($sl);
        // This method can be empty, as the component will re-render
        // and fetch the updated data from the computed properties.
    }

    public function render()
    {
        return view('livewire.manajemen-servis', [
            'serviceLogData' => $this->serviceLogData
        ])->extends('specific-dps')->section('dataServisContent');
    }
}
