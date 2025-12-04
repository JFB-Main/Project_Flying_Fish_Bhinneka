<?php

//---------------------------------------------------
//                  NOTE PENTING:
//   WITH['alamatServis_dps'] ON FETCHSERVICELOG
// IS NOT USED BECAUSE OF DEPENDENCIES MISALIGMENT
//---------------------------------------------------

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\URL; 
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\DB;
use Exception;

use Livewire\Attributes\Computed;

use App\Models\ServiceLogDps;
use App\Models\NoteDps;
use App\Models\StatusUpdatelogDps;
use App\Models\TipeServiceDps;
use App\Models\AlamatServisDps;
use App\Models\UsersModel;

class DetailServisDps extends Component
{
    #[URL(as: 'id', except: '')]
    public $id = '';

    public $notedps_specific_update;

    public $alamat_servis_list;
    public $tipe_service_list;

    public $edit_nama_produk;
    public $edit_sn_produk;
    public $edit_alamat_servis;

    public $edit_teknisi_assign;
    public $edit_jadwal_kunjungan;
    public $edit_tipe;
    public $edit_permasalahan;

    // #[Computed]
    // public function alamatServisptions()
    // {
    //     return AlamatServisDps::where('id_pelanggan', '=', $this->fetchServiceLog->id_pelanggan_dps)->get();
    // }

    // #[Computed]
    // public function tipeServiceOptions()
    // {
    //     return TipeServiceDps::all();
    // }

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
    public function fetchStatusLog()
    { 
            return StatusUpdatelogDps::with('status_dps_fk', 'serviceLog_dps_fk')
                ->where('service_logs_id_dps', '=', $this->fetchServiceLog->id)
                ->orderBy('created_at', 'desc') // Order notes chronologically
                ->paginate(10);
        // return null;
        // return collect();
        // return new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
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

    #[Computed]
    public function fetchTeknisi()
    {
        return UsersModel::get()
        ->where('module_role', '=', 2);
    }    

    public function createNoteDps(){
        $this->validate([
            'notedps_specific_update' => 'required',
        ], [
            'notedps_specific_update.required' => 'Note harus memiliki isi.',
        ]);

        // dd($this->inputAlamat, $this->selectedId);
        try {
            // dd($this->fetchServiceLog->id);
            NoteDps::create([
                'id_service_logs_dps' => $this->fetchServiceLog->id,
                'id_teknisi' => $this->fetchServiceLog->id_teknisi,
                'note_content' => $this->notedps_specific_update
            ]);

        } catch (\Exception $e) {
            // Handle any database or transaction errors
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }


        session()->flash('success', 'Data berhasil ditambahkan!');

        // 4. Reset form fields or redirect
        $this->reset('notedps_specific_update');
        $this->dispatch('close-modal');
        // $this->dispatch('alamat-servis-crud-done');

    }

    public function editTiketDpsData(){
        

        if($this->edit_alamat_servis == null){
            $this->edit_alamat_servis = $this->fetchServiceLog->produk_dps?->id_alamat_servis;
            // dd($this->edit_alamat_servis, "gg");
        }

        if($this->edit_tipe == null){
            $this->edit_tipe = $this->fetchServiceLog->id_tipe_service;
            // dd($this->edit_tipe, "gg");
        }

        // dd($this->edit_alamat_servis, $this->edit_nama_produk, $this->edit_sn_produk, $this->fetchServiceLog->produk_dps->id, $this->edit_permasalahan, $this->edit_tipe);


        // 1. Fetch the main Service Log record and its dependencies
        $serviceLog = ServiceLogDps::find($this->id);

        if (!$serviceLog) {
            session()->flash('error', 'Service Log not found.');
            return;
        }
        
        // // 2. Update the ServiceLogDps table (Direct Update)
        // $serviceLog->update([
        //     'id_tipe_service' => $this->edit_tipe,
        //     'permasalahan' => $this->edit_permasalahan,
        //     'id_alamat_servis' => $this->edit_alamat_servis
        // ]);

        // // 3. Update the ProductDps table (Via Relationship)
        // // This updates the row in the products_dps table linked by $serviceLog->id_produk
        // $serviceLog->produk_dps()->update([
        //     'nama_produk' => $this->edit_nama_produk,
        //     'serial_number' => $this->edit_sn_produk,
        //     'id_alamat_servis' => $this->edit_alamat_servis
        // ]);

        try {
            // 1. Start a database transaction
            DB::beginTransaction();

            // 2. Update the ServiceLogDps table (Direct Update)
            $serviceLog->update([
                'id_tipe_service' => $this->edit_tipe,
                'permasalahan' => $this->edit_permasalahan,
                'id_alamat_servis' => $this->edit_alamat_servis
            ]);

            // 3. Update the ProductDps table (Via Relationship)
            // If 'edit_sn_produk' is a duplicate, the database will throw an exception here.
            $serviceLog->produk_dps()->update([
                'nama_produk' => $this->edit_nama_produk,
                'serial_number' => $this->edit_sn_produk,
                'id_alamat_servis' => $this->edit_alamat_servis
            ]);

            // 4. Commit the transaction if both updates succeed
            DB::commit();

            // SUCCESS Notification
            $this->dispatch('note-crud-done');
            $this->dispatch('open-edit-techlog');
            session()->flash('success', 'Detail Service berhasil diperbarui!');

        } catch (Exception $e) {
            // 5. Rollback the transaction if any error occurs (including unique constraint violation)
            DB::rollBack();

            $errorMessage = 'Gagal menyimpan data.';

            // Check for the specific unique constraint error (usually SQLSTATE 23000)
            // You might need to adjust the SQLSTATE or message check based on your database driver.
            if (str_contains($e->getMessage(), 'Duplicate entry') || $e->getCode() === '23000') {
                $errorMessage = 'Gagal update produk: Serial Number sudah terdaftar pada produk lain.';
            } else {
                // Log the unexpected error for debugging
                \Log::error("Service Log Update Failed: " . $e->getMessage());
            }

            // ERROR Notification
            // $this->dispatch('show-notification', [
            //     'type' => 'error',
            //     'message' => $errorMessage,
            // ]);
            session()->flash('error', $errorMessage);
        }

        // session()->flash('success', 'Data servis telah di update!');
    }

    public function editTiketDpsDataTeknisi(){
        // dd('testteknisi', $this->edit_jadwal_kunjungan);
        if($this->edit_teknisi_assign == null){
            $this->edit_teknisi_assign = $this->fetchServiceLog->id_teknisi;
            // dd($this->edit_alamat_servis, "gg");
        }

        // dd($this->edit_teknisi_assign);

        // 1. Fetch the main Service Log record and its dependencies
        $serviceLog = ServiceLogDps::find($this->id);

        if (!$serviceLog) {
            session()->flash('error', 'Service Log not found.');
            return;
        }
        
        // 2. Update the ServiceLogDps table (Direct Update)
        $serviceLog->update([
            'id_teknisi' => $this->edit_teknisi_assign,
            'jadwal_kunjungan' => $this->edit_jadwal_kunjungan
        ]);

        $this->dispatch('open-edit-techlog-teknisi');
        $this->dispatch('note-crud-done');
        session()->flash('success', 'Data servis telah di update!');
    }

    #[On(event: 'note-crud-done')]
    public function noteRefresh()
    {
        // dd($sl);
        // This method can be empty, as the component will re-render
        // and fetch the updated data from the computed properties.
    }

    public function mount()
    {
        // Redirect if not logged in
        if (!auth()->check()) {
            return $this->redirect(route('auth.login'), navigate: true);
        }

        // Fetch static data only once on mount

        $serviceLog = $this->fetchServiceLog();

        if ($this->fetchServiceLog) {
            $customerId = $serviceLog->id_pelanggan;
            
            $this->alamat_servis_list = AlamatServisDps::where('id_pelanggan', $customerId)->get();
        } else {
            // If the service log isn't found, initialize the list to empty
            $this->alamat_servis_list = collect(); 
        }

        $this->tipe_service_list = TipeServiceDps::all();
        // $this->allUsers = UsersModel::all();
    }

    public function render()
    {
        $this->edit_jadwal_kunjungan = $this->fetchServiceLog->jadwal_kunjungan;
        return view('livewire.detail-servis-dps',[
            'serviceData' => $this->fetchServiceLog,
            'note' => $this->fetchNoteDps,
            'statusNote' => $this->fetchStatusLog,
            'teknisiList' => $this->fetchTeknisi
        ])->extends('specific-dps')->section('detailServisContent');;
    }
}
