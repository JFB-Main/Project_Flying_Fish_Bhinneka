<?php

namespace App\Livewire;

use App\Models\AlamatServisDps;
use App\Models\PelangganDps;
use Livewire\Component;

use App\Models\ProdukDps;

use Livewire\Attributes\On; 
use Livewire\Attributes\URL; 
use Livewire\Attributes\Computed;
use Illuminate\Validation\Rule;

class DetailPelangganDps extends Component
{

    #[URL(as: 'id', except: '')]
    public $id = '';

    public string $namaProduk = '';
    public string $editnamaAlamat = '';

    public string $serialNumber = '';

   public string $editSerialNumber = '';

    public string $skuProduk = '';
    public string $nomorInvoice = '';
    public bool $isBhinnekaProduct = false; // Checkbox

    // public $alamatServisIdForAddProduk;
    #[On('alamat-servis-crud-done')]
    public function updateList()
    {
    }

        protected function Rules()
    {
        return [

            // Product Validation (Only required if isNoProduct is false)
            // If $this->isNoProduct is TRUE, exclude these rules entirely.
            'namaProduk' => 'required|string|max:255',
            'serialNumber' => [
                'required',
                'string',
                'max:255',
                // Rule::unique checks the serial_number column in the produk_dps table 
                // for existing values. Since we are creating a new record, 
                // we don't need to ignore any existing IDs.
                Rule::unique('produk_dps', 'serial_number'),
            ],
            // These fields are nullable anyway, but we can exclude them too if the product is skipped.
            'skuProduk' => 'nullable|string|max:255',
            'nomorInvoice' => 'nullable|string|max:255',

            'isBhinnekaProduct' => 'boolean',
        ];
    }

    #[Computed]
    public function pelangganData()
    {
        return PelangganDps::with(['alamatServis_dps.produks_dps'])->find($this->id);
    }    

    public function addProduk($as_id)
    {
        // $this->validate([
        //     // 'inputAlamat' => 'required|string|max:500',
        //     // Ensure you validate the ID is an integer if required
        //     'alamatServisIdForAddProduk' => 'required|integer|exists:alamat_servis_dps,id', 
        // ]);
        // dd($as_id);

        $this->validate($this->Rules());

        // dd($as_id, $this->pelangganData->id, $this->skuProduk, $this->namaProduk, $this->serialNumber, $this->nomorInvoice, $this->isBhinnekaProduct);
        try {
            $prod = ProdukDps::create([
                // Product Data
                'sku_produk' => $this->skuProduk,
                'nama_produk' => $this->namaProduk,
                'serial_number' => $this->serialNumber,
                'nomor_invoice_so' => $this->nomorInvoice,
                'produk_bhinneka' => $this->isBhinnekaProduct, // boolean converts to tinyint(1)

                // Foreign Keys
                'id_pelanggan_dps' => $this->pelangganData->id,
                'id_alamat_servis' => $as_id,

            ]);
        } catch (\Exception $prod) {
            // Handle any database or transaction errors
            session()->flash('error', 'Gagal menyimpan data: ' . $prod->getMessage());
            $this->dispatch('close-modal');
        }

        // 4. Reset form fields or redirect
        session()->flash('success', 'Berhasil menambahkan produk');
        $this->dispatch('alamat-servis-crud-done');
        $this->reset(['namaProduk', 'serialNumber', 'skuProduk', 'nomorInvoice', 'isBhinnekaProduct']);
        $this->dispatch('close-modal');

    }    

    public function editAlamat($as_id)
    {
        // dd('editalamat', $as_id);

        $prod = AlamatServisDps::find($as_id);

        $this->validate([
            'editnamaAlamat' => 'required|string|max:255',
        ]);
        // dd($this->editnamaAlamat);
        // dd($as_id, $this->pelangganData->id, $this->skuProduk, $this->namaProduk, $this->serialNumber, $this->nomorInvoice, $this->isBhinnekaProduct);
        try {
            $prod->update([
                // Product Data
                'nama_alamat' => $this->editnamaAlamat,
            ]);
        } catch (\Exception $prod) {
            // Handle any database or transaction errors
            session()->flash('error', 'Gagal update data: ' . $prod->getMessage());
            $this->dispatch('close-modal');
        }

        // 4. Reset form fields or redirect
        session()->flash('success', 'Berhasil update nama email');
        $this->dispatch('alamat-servis-crud-done');
        $this->reset(['namaProduk']);
        $this->dispatch('close-modal');

    }    

        public function editProduk($as_id)
    {
        // dd('editproduk');
        // $this->validate([
        //     // 'inputAlamat' => 'required|string|max:500',
        //     // Ensure you validate the ID is an integer if required
        //     'alamatServisIdForAddProduk' => 'required|integer|exists:alamat_servis_dps,id', 
        // ]);
        // dd($as_id);


        $prod = ProdukDps::find($as_id);

        $this->validate([
            'skuProduk' => 'nullable|string|max:255',
            'namaProduk' => 'required|string|max:255',
            'editSerialNumber' => [
                'required',
                'string',
                'max:255',
                // This tells Laravel to ignore the product with ID $as_id when checking uniqueness.
                Rule::unique('produk_dps', 'serial_number')->ignore($as_id), 
            ],
            'nomorInvoice' => 'nullable|string|max:255',
            'isBhinnekaProduct' => 'boolean',
        ]);

        // dd($as_id, $this->pelangganData->id, $this->skuProduk, $this->namaProduk, $this->serialNumber, $this->nomorInvoice, $this->isBhinnekaProduct);
        try {
            $prod->update([
                // Product Data
                'sku_produk' => $this->skuProduk,
                'nama_produk' => $this->namaProduk,
                'serial_number' => $this->editSerialNumber,
                'nomor_invoice_so' => $this->nomorInvoice,
                'produk_bhinneka' => $this->isBhinnekaProduct, // boolean converts to tinyint(1)
            ]);
        } catch (\Exception $prod) {
            // Handle any database or transaction errors
            session()->flash('error', 'Gagal update data: ' . $prod->getMessage());
            $this->dispatch('close-modal');
        }

        session()->flash('success', 'Berhasil update data produk');
        // 4. Reset form fields or redirect
        $this->dispatch('alamat-servis-crud-done');
        $this->reset(['namaProduk', 'editSerialNumber', 'skuProduk', 'nomorInvoice', 'isBhinnekaProduct']);
        $this->dispatch('close-modal');

    }    

    public function render()
    {
        return view('livewire.detail-pelanggan-dps', [
            'qp' => $this->pelangganData,
        ])->extends('specific-dps')->section('detailPelangganContent');
    }
}
