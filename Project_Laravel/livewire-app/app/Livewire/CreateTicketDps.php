<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;

use Illuminate\Support\Facades\DB;

use App\Models\TipeServiceDps;
use App\Models\PelangganDps;
use App\Models\AlamatServisDps;
use App\Models\ProdukDps;
use App\Models\ServiceLogDps;

use App\Models\UsersModel;



use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;

class CreateTicketDps extends Component
{
    public $inputPelanggan ; //take id pelanggan
    public $inputProduk ;

    public $inputTipeServis ;
    public $inputPermasalahan ;
    public $inputJadwalKunjungan ;
    public $inputPilihTeknisi ;
    public $hiddenAlamatServisId;

    protected function rules()
{
    return [
        'inputPelanggan' => 'required', // Expects a numeric ID for the customer
        'inputProduk' => 'required',    // Expects a numeric ID for the product
        'inputTipeServis' => 'required',
        'inputPermasalahan' => 'required', // Assuming a large text area for description
        'inputJadwalKunjungan' => 'nullable|date',
        'inputPilihTeknisi' => 'required', // Expects a numeric ID for the selected technician
    ];
}

    public function updatedInputProduk($value)
    {
        // 1. Fetch the product using the selected ID ($value)
        $product = ProdukDps::select('id_alamat_servis')->find($value);

        // 2. Extract the address ID
        $addressId = $product ? $product->id_alamat_servis : null;

        // 3. Store the address ID in the public property
        $this->hiddenAlamatServisId = $addressId;
    }
    public function createServis(){
        $this->validate($this->Rules());

        // dd(
        //     $this->hiddenAlamatServisId,
        //     $this->inputPelanggan,
        //     $this->inputProduk,
        //     $this->inputTipeServis,
        //     $this->inputPermasalahan,
        //     $this->inputJadwalKunjungan,
        //     $this->inputPilihTeknisi
        //     , session('user_id')
        // );

        try {
            $prod = ServiceLogDps::create([
                // Product Data
                'id_tipe_service' => $this->inputTipeServis,
                'jadwal_kunjungan' => $this->inputJadwalKunjungan,
                'waktu_mulai' => now(),

                'id_produk' => $this->inputProduk,
                'id_pelanggan' => $this->inputPelanggan,
                "id_alamat_servis" => $this->hiddenAlamatServisId,
                "id_teknisi" => $this->inputPilihTeknisi,
                "created_by" => session('user_id'),
                "permasalahan" => $this->inputPermasalahan,


            ]);

            session()->flash('success', 'tiket servis berhasil ditambahkan!');
        } catch (\Exception $prod) {
            // Handle any database or transaction errors
            session()->flash('error', 'Gagal menyimpan data: ' . $prod->getMessage());
        }
            $this->reset(); // Resets all public properties
    }

    #[Computed]
    public function pelangganData()
    {
        return PelangganDps::get();
    }    

    #[Computed]
    public function tipeServis()
    {
        return TipeServiceDps::get();
    }    

    #[Computed]
    public function teknisi()
    {
        return UsersModel::get()
        ->where('module_role', '=', 2);
    }    

    #[Computed]
    public function produkData()
    {
        if (empty($this->inputPelanggan)) 
        {        
            // return collect(); Returns an empty Laravel Collection
            return ProdukDps::hydrate([]); // Alternatively: Returns an empty Eloquent Collection
        }

        return ProdukDps::with(['alamatServis_dps', 'pelanggan_dps'])
        ->when($this->inputPelanggan, fn (Builder $query) => 
            $query->where('id_pelanggan_dps', $this->inputPelanggan)
        )
        ->get();

    }    

    #[Computed]
    public function alamatServisFetching()
    {
        if (empty($this->inputProduk)) {
        return null;
        }
        return ProdukDps::with(['alamatServis_dps'])->find($this->inputProduk);
    }


    public function render()
    {
        return view('livewire.create-ticket-dps', [
            'produkData' => $this->produkData,
            'pelangganData' => $this->pelangganData,
            'ASfetch' => $this->alamatServisFetching,
            'Tipe' => $this->tipeServis,
            'teknisi' => $this->teknisi
        ])->extends('specific-dps')->section('dataServisContent');
    }
}
