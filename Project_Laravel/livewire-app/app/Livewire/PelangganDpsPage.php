<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;

use Illuminate\Support\Facades\DB;
use App\Models\PelangganDps;
use App\Models\AlamatServisDps;
use App\Models\ProdukDps;

use Livewire\Attributes\Computed;
class PelangganDpsPage extends Component
{
    // --- Section 1: PELANGGAN ---
    public string $namaPelanggan = '';
    public string $email = '';
    public string $telepon = '';
    public string $alamatPelanggan = '';

    // --- Section 2: ALAMAT SERVIS ---
    public bool $isAddressSame = false; // Checkbox
    public string $alamatServis = '';

    // --- Section 3: PRODUK ---
    public bool $isNoProduct = false; // Checkbox
    public string $namaProduk = '';
    public string $serialNumber = '';
    public string $skuProduk = '';
    public string $nomorInvoice = '';
    public bool $isBhinnekaProduct = false; // Checkbox

    // Real-time Update Logic For Alamat Servis CheckBox
    public function updatedIsAddressSame($value)
    {
        // If the 'Same Address' box is checked, copy the customer address.
        if ($value) {
            $this->alamatServis = $this->alamatPelanggan;
        } else {
            
            $this->alamatServis = '';
        }
    }


    protected function Rules()
    {
        return [
            // Customer Validation
            'namaPelanggan' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string',
            'alamatPelanggan' => 'required|string|max:500',

            // Service Address Validation
            'alamatServis' => $this->isAddressSame ? 'nullable' : 'required|string',

            // Product Validation (Only required if isNoProduct is false)
            // If $this->isNoProduct is TRUE, exclude these rules entirely.
            'namaProduk' => $this->isNoProduct ? 'exclude' : 'required|string|max:255',
            'serialNumber' => $this->isNoProduct ? 'exclude' : 'required|string|max:255',
            
            // These fields are nullable anyway, but we can exclude them too if the product is skipped.
            'skuProduk' => $this->isNoProduct ? 'exclude' : 'nullable|string|max:255',
            'nomorInvoice' =>  $this->isNoProduct ? 'exclude' : 'nullable|string|max:255',

            'isBhinnekaProduct' => 'boolean',
        ];
    }

    public function addPelanggan()
    {
        //Validation rules
        // dd($this->all());   
       $this->validate($this->getRules());


        try {
            DB::transaction(function () {
                // 1. CREATE PELANGGAN DPS (Customer)
                $customer = PelangganDps::create([
                    'nama' => $this->namaPelanggan,
                    'email' => $this->email,
                    'nomor_telepon' => $this->telepon,
                    'alamat' => $this->alamatPelanggan,
                ]);

                // 2. CREATE ALAMAT SERVIS DPS (Service Address)
                // Using the relationship ensures the id_pelanggan is automatically set
                $serviceAddress = $customer->alamatServis_dps()->create([
                    'nama_alamat' => $this->alamatServis,
                ]);

                // 3. CREATE PRODUK DPS (Product)
                if (!$this->isNoProduct) {
                    ProdukDps::create([
                        // Foreign Keys
                        'id_pelanggan_dps' => $customer->id,
                        'id_alamat_servis' => $serviceAddress->id,
                        
                        // Product Data
                        'sku_produk' => $this->skuProduk,
                        'nama_produk' => $this->namaProduk,
                        'serial_number' => $this->serialNumber,
                        'nomor_invoice_so' => $this->nomorInvoice,
                        'produk_bhinneka' => $this->isBhinnekaProduct, // boolean converts to tinyint(1)
                        
                        // 'sales_order' and 'id_warranty' are nullable/not included in form, so we omit them here.
                    ]);
                }

                // 4. Success feedback and form reset
                session()->flash('success', 'Data pelanggan dan servis berhasil ditambahkan!');
                $this->reset(); // Resets all public properties
            });

        } catch (\Exception $e) {
            // Handle any database or transaction errors
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }


        session()->flash('success', 'Data pelanggan berhasil ditambahkan!');

        // 4. Reset form fields or redirect
        // $this->reset();
    }

    public function render()
    {
        return view('livewire.pelanggan-dps-page')->extends('specific-dps')->section('pelangganDPSContent');
    }
}
