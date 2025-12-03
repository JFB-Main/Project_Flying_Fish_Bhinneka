<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\URL; 
use Livewire\Attributes\On; 

use Livewire\Attributes\Computed;

use App\Models\ServiceLogDps;
use App\Models\NoteDps;
use App\Models\StatusUpdatelogDps;
use App\Models\TipeServiceDps;
use App\Models\AlamatServisDps;


class ExportServisDps extends Component
{

    public $pageTitle = 'Laporan Servis';

    #[URL(as: 'id', except: '')]
    public $id = '';

    #[Computed]
    public function fetchServiceLog()
    {

        return ServiceLogDps::with([
            'tipeService_dps', // Links to TipeServiceDps via id_tipe_service
            'status_dps',      // Links to StatusDps via status
            'produk_dps',      // Links to ProdukDps via id_produk
            'produk_dps.alamatServis_dps',
            'alamatServis_dps',
            'pelanggan_dps',   // Links to PelangganDps via id_pelanggan
            'teknisi_dps',     // Links to UsersModel via id_teknisi
            'creator_dps',     // Links to UsersModel via created_by
            // 'notes_dps' is a HasMany relationship, typically only loaded 
            // if you need to display all notes for every log item.
        ])->find($this->id);    
    }

    #[Computed]
    public function fetchNoteDps()
    {
        return NoteDps::with([
            'serviceLog_dps',
            'teknisi_dps'
        ])
            ->where('id_service_logs_dps', '=', $this->fetchServiceLog->id)
            ->orderBy('created_at', 'desc') // Order notes chronologically
            ->paginate(10); // Adjust the pagination limit as needed
    }

    public function render()
    {
        return view('livewire.export-servis-dps',[
            'serviceData' => $this->fetchServiceLog,
            'note' => $this->fetchNoteDps,
        ])->extends('layouts.printFormDps')->section('contentExportServisDps')->title($this->pageTitle);;
    }
}
