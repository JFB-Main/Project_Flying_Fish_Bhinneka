<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Service_logsModel;
use App\Models\StatusModel;
use Illuminate\Support\Facades\DB;

class ModalUpdate extends Component
{

    public $selectedId; // To store the status_id received from the button
    public $techlogIdSelector;

    // The method name (receiveDataAndOpen) will be called when 'open-modal' is dispatched.
    // The arguments ($name, $statusId) from the dispatched event are passed here.
    #[On('open-modal')]
    public function receiveDataAndOpen($name, $slId_For_UpdateStatusId)
    {
        
        // For this specific modal, we don't need to check $name here
        // as the x-modalUpdateShow component already filters by name.
        // However, if ModalUpdate itself controls its visibility, you'd check $name here.

        $this->selectedId = $slId_For_UpdateStatusId;
        
        // $this->techlogIdSelector = "gg";

        $this->techlogIdSelector = Service_logsModel::with('status', 'serviceId')->where('id', '=', "{$slId_For_UpdateStatusId}")->first();
        // dd($this->techlogIdSelector);

        
        // Assign the received status_id
        // If this Livewire component also controls its own 'show' state, set it here:
        // $this->dispatch('open-modal-for-this-livewire-component'); // or similar
    }

    public function deleteUser(){
        // dd("dhgfvwhbjak");
        $this->dispatch('log-message', message: "dhgfvwhbjak");
    }

    #[On('update-data')]
    public function updateStatus($id_for_status_update, $status_id){

        // dd($id_for_status_update, $status_id);
        Service_logsModel::where('id', '=', $id_for_status_update)->update([
            'status_id' => ($status_id+1)
        ]);

        $sl = Service_logsModel::all();

        $this->dispatch('close-modal');
        $this->dispatch('crud-done', $sl);
    }

    public function render()
    {

        return view('livewire.modal-update', [
        ]);
    }
}
