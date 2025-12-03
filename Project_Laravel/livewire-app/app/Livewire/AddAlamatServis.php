<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AlamatServisDps;
use Livewire\Attributes\On; 

class AddAlamatServis extends Component
{
    public $selectedId;
    public string $inputAlamat;

    #[On('open-modal-alamat-add-dps')]
    public function receiveDataAndOpen($name, $slId_For_UpdateStatusId)
    {
        $this->selectedId = $slId_For_UpdateStatusId;
    }

    protected function RulesAddAddress()
    {
        return [
            // Service Address Validation
            'inputAlamat' => 'required|string',
        ];
    }

    public function addAlamatServis()
    {
       $this->validate($this->RulesAddAddress());

        // dd($this->inputAlamat, $this->selectedId);
        try {
            AlamatServisDps::create([
                'nama_alamat' => $this->inputAlamat,
                'id_pelanggan' => $this->selectedId
            ]);

        } catch (\Exception $e) {
            // Handle any database or transaction errors
            session()->flash('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }


        session()->flash('success', 'Data pelanggan berhasil ditambahkan!');

        // 4. Reset form fields or redirect
        $this->reset();
        $this->dispatch('close-modal-alamat-add-dps');
        $this->dispatch('alamat-servis-crud-done');
    }

    public function render()
    {
        return view('livewire.add-alamat-servis');
    }
}
