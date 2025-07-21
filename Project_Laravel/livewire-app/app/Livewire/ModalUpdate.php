<?php

namespace App\Livewire;

use App\Models\Status_updatelogModel;
use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Service_logsModel;
use App\Models\StatusModel;
use Illuminate\Support\Facades\DB;

class ModalUpdate extends Component
{

    public $selectedId; // To store the status_id received from the button
    public $techlogIdSelector;

    public $note_update;

    public $id_for_status_update;
    public $status_id;

    private $finalizeStatusId;

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
    public function cancelStatus(){
        dd($this->id_for_status_update, "saklek kabean");
    }
    // #[On('update-data')]
    public function updateStatus(){

        if ($this->status_id == 7) {
            // Rule: Do nothing if status_id is 7
            $this->dispatch('close-modal');
            $this->dispatch('crud-done');
            return; // Exit the method
        }
        elseif ($this->status_id >= 1 && $this->status_id <= 5){
            $this->finalizeStatusId = $this->status_id + 1;
        }
        elseif ($this->status_id == 6) {
            // Rule: If status_id is 6, skip 7 and proceed to 8
            $this->finalizeStatusId = 8;
        }
        
        $coba = Service_logsModel::where('id', '=', $this->id_for_status_update)->first();

        // dd($this->id_for_status_update, $this->finalizeStatusId, $this->note_update, session('user_id'), $coba->techlog_id);


        $statusUpdated = Service_logsModel::where('id', '=', $this->id_for_status_update)->update([
            'status_id' => ($this->finalizeStatusId)
        ]);

        $sl = Service_logsModel::all();

        $statusLogCreate = Status_updatelogModel::create([
            'service_logs_id' => $coba->techlog_id,
            'status_id' => $this->finalizeStatusId,
            'teknisi_id' => session('user_id'),
            'status_note' => $this->note_update
        ]);
        if($statusLogCreate && $statusUpdated) {
            session()->flash('success', 'Techlog ' . $coba->techlog_id . ' has been succesfully updated');
        } else {

            session()->flash('error', 'Error: Failed to update Techlog or log the status change.');
        }

        $this->dispatch('close-modal');
        $this->dispatch('crud-done', $sl);
    }

    public function render()
    {

        return view('livewire.modal-update', [
        ]);
    }
}
