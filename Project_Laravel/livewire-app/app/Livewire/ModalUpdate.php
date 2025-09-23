<?php

namespace App\Livewire;

use App\Models\Status_updatelogModel;
use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Service_logsModel;
use App\Models\StatusModel;
use App\Models\NotesModel;
// use Illuminate\Support\Facades\DB;

class ModalUpdate extends Component
{
    public $selectedId;
    public $techlogIdSelector;
    public $note_update;
    public $status_id;
    
    // need not a separate variable for the techlog ID from the model,
    // access it directly from the `techlogIdSelector` property.
    // public $id_for_status_update; 
    // public $techlogIdString;

    // Use a private property to store the next status ID
    private $finalizeStatusId;

    #[On('open-modal')]
    public function receiveDataAndOpen($name, $slId_For_UpdateStatusId)
    {
        // Fetch only the single record needed to populate the modal
        $this->techlogIdSelector = Service_logsModel::with('status', 'serviceId')
            ->where('id', $slId_For_UpdateStatusId)
            ->first();

        // If the service log is not found, handle the error
        if (!$this->techlogIdSelector) {
            session()->flash('error', 'Error: Service Log not found.');
            $this->dispatch('close-modal');
            return;
        }

        // Assign properties directly from the fetched model
        $this->selectedId = $this->techlogIdSelector->id;
        $this->status_id = $this->techlogIdSelector->status_id;
        $this->note_update = ''; // Clear note for a new update action
    }

    public function updateStatus()
    {
        // First, check if the record actually exists before proceeding
        if (!$this->techlogIdSelector) {
            session()->flash('error', 'Error: Service Log not found.');
            $this->dispatch('close-modal');
            return;
        }

        // Determine the new status ID based on the current status
        $this->finalizeStatusId = $this->calculateNextStatusId($this->status_id);

        if ($this->finalizeStatusId === null) {
            // Status ID is 7, no action needed
            $this->dispatch('close-modal');
            $this->dispatch('crud-done');
            return;
        }

        // Update the Service Log record
        $this->techlogIdSelector->status_id = $this->finalizeStatusId;

        // Conditionally update date fields based on the new status
        $this->updateDateFields($this->techlogIdSelector, $this->finalizeStatusId);
        $this->techlogIdSelector->save();

        // Create the status update log
        Status_updatelogModel::create([
            'service_logs_id' => $this->techlogIdSelector->techlog_id,
            'status_id' => $this->finalizeStatusId,
            'teknisi_id' => session('user_id'),
            'status_note' => $this->note_update
        ]);
        

        $noteEdit = "STATUS UPDATE NOTE: ".$this->note_update;
        NotesModel::create([
            'service_logs_id' => $this->techlogIdSelector->techlog_id,
            'teknisi_id' => session('user_id'),
            'note_content' => $noteEdit
        ]);
        
        session()->flash('success', 'Techlog ' . $this->techlogIdSelector->techlog_id . ' has been successfully updated');

        // Close the modal and notify the parent component to refresh its data
        $this->dispatch('close-modal');
        $this->dispatch('crud-done');
    }

    // Consolidated method for the other status changes
    public function updateWithSpecificStatus($status)
    {
        // check if the record actually exists before proceeding
        if (!$this->techlogIdSelector) {
            session()->flash('error', 'Error: Service Log not found.');
            $this->dispatch('close-modal');
            return;
        }
        
        // Update the Service Log record with the specific status
        $this->techlogIdSelector->status_id = $status;
        $this->updateDateFields($this->techlogIdSelector, $status);
        $this->techlogIdSelector->save();

        // Create the status update log
        Status_updatelogModel::create([
            'service_logs_id' => $this->techlogIdSelector->techlog_id,
            'status_id' => $status,
            'teknisi_id' => session('user_id'),
            'status_note' => $this->note_update
        ]);

        $noteEdit = "STATUS UPDATE NOTE: ".$this->note_update;
        NotesModel::create([
            'service_logs_id' => $this->techlogIdSelector->techlog_id,
            'teknisi_id' => session('user_id'),
            'note_content' => $noteEdit
        ]);
        
        
        $actionMessage = $this->getStatusMessage($status);
        session()->flash('success', 'Techlog ' . $this->techlogIdSelector->techlog_id . ' has been successfully ' . $actionMessage);

        // Close the modal and notify the parent component to refresh its data
        $this->dispatch('close-modal');
        $this->dispatch('crud-done');
    }

    public function cancelStatus()
    {
        $this->updateWithSpecificStatus(7);
    }

    public function revertStatus()
    {
        $this->updateWithSpecificStatus(3);
    }

    public function skipStatus()
    {
        $this->updateWithSpecificStatus(6);
    }
    
    // Helper method to determine the next status ID
    private function calculateNextStatusId($currentStatus)
    {
        if ($currentStatus == 7) {
            return null; // No action for status 7
        } elseif ($currentStatus >= 1 && $currentStatus <= 5) {
            return $currentStatus + 1;
        } elseif ($currentStatus == 6) {
            return 8; // Skip to 8 from 6
        }
        return $currentStatus; // Default to current status if no rule applies
    }

    // Helper method to update date fields based on status change
    private function updateDateFields(Service_logsModel $serviceLog, $newStatusId)
    {
        $today = now()->toDateString();
        switch ($newStatusId) {
            case 5:
                $serviceLog->part_ready = $today;
                break;
            case 6:
                $serviceLog->completed_date = $today;
                break;
            case 8:
                $serviceLog->return_date = $today;
                break;
        }
    }
    
    // Helper method for flash messages
    private function getStatusMessage($status)
    {
        switch ($status) {
            case 3: return 'reverted';
            case 6: return 'finished';
            case 7: return 'reverted'; // Canceled is a form of revert
            default: return 'updated';
        }
    }

    public function getStatusesProperty()
    {
        return StatusModel::all();
    }

    public function render()
    {
        return view('livewire.modal-update', [
            'statuses' => $this->statuses
        ]);
    }
}













// class ModalUpdate extends Component
// {

//     public $selectedId; // To store the status_id received from the button
//     public $techlogIdSelector;

//     public $note_update;

//     public $id_for_status_update;
//     public $status_id;

//     private $finalizeStatusId;

//     // The method name (receiveDataAndOpen) will be called when 'open-modal' is dispatched.
//     // The arguments ($name, $statusId) from the dispatched event are passed here.
//     #[On('open-modal')]
//     public function receiveDataAndOpen($name, $slId_For_UpdateStatusId)
//     {
//         $this->selectedId = $slId_For_UpdateStatusId;
        
//         // Always fetch the LATEST data from the database when opening the modal
//         $this->techlogIdSelector = Service_logsModel::with('status', 'serviceId')->where('id', $slId_For_UpdateStatusId)->first();

//         if ($this->techlogIdSelector) {
//             $this->id_for_status_update = $this->techlogIdSelector->id;
//             $this->status_id = $this->techlogIdSelector->status_id; // THIS IS CRITICAL: Always get fresh status_id
//             $this->techlogIdString = $this->techlogIdSelector->techlog_id; 
            
//             $this->note_update = ''; // Clear note for new update action
//         } else {
//             session()->flash('error', 'Error: Service Log with ID ' . $slId_For_UpdateStatusId . ' not found. Cannot open modal.');
//             $this->dispatch('close-modal');
//         }

        
//         // For this specific modal, we don't need to check $name here
//         // as the x-modalUpdateShow component already filters by name.
//         // However, if ModalUpdate itself controls its visibility, you'd check $name here.

//         // $this->selectedId = $slId_For_UpdateStatusId;
//         // $this->techlogIdSelector = Service_logsModel::with('status', 'serviceId')->where('id', '=', "{$slId_For_UpdateStatusId}")->first();


        
//         // Assign the received status_id
//         // If this Livewire component also controls its own 'show' state, set it here:
//         // $this->dispatch('open-modal-for-this-livewire-component'); // or similar
//     }

//     // public function deleteUser(){
//     //     // dd("dhgfvwhbjak");
//     //     $this->dispatch('log-message', message: "dhgfvwhbjak");
//     // }
//     public function cancelStatus(){
//         // dd($this->id_for_status_update, now()->toDateString(), $this->note_update, $this->status_id);

//         $coba = Service_logsModel::where('id', '=', $this->id_for_status_update)->first();

//         $statusUpdated = Service_logsModel::where('id', '=', $this->id_for_status_update)->update([
//             'status_id' => 7
//         ]);

//         $statusLogCreate = Status_updatelogModel::create([
//             'service_logs_id' => $coba->techlog_id,
//             'status_id' => 7,
//             'teknisi_id' => session('user_id'),
//             'status_note' => $this->note_update
//         ]);

//         if($statusLogCreate && $statusUpdated) {
//             session()->flash('success', 'Techlog ' . $coba->techlog_id . ' has been succesfully reverted');
//         } else {

//             session()->flash('error', 'Error: Failed to update Techlog or log the status change.');
//         }

//         $sl = Service_logsModel::all();

//         $this->dispatch('crud-done', $sl);
//     }

//     public function revertStatus(){
//         // dd($this->id_for_status_update, now()->toDateString(), $this->note_update, $this->status_id);
//         $coba = Service_logsModel::where('id', '=', $this->id_for_status_update)->first();

//         $statusUpdated = Service_logsModel::where('id', '=', $this->id_for_status_update)->update([
//             'status_id' => 3
//         ]);

//         $statusLogCreate = Status_updatelogModel::create([
//             'service_logs_id' => $coba->techlog_id,
//             'status_id' => 3,
//             'teknisi_id' => session('user_id'),
//             'status_note' => $this->note_update
//         ]);

//         if($statusLogCreate && $statusUpdated) {
//             session()->flash('success', 'Techlog ' . $coba->techlog_id . ' has been succesfully reverted');
//         } else {

//             session()->flash('error', 'Error: Failed to update Techlog or log the status change.');
//         }
//         $sl = Service_logsModel::all();

//         $this->dispatch('crud-done', $sl);
//     }

//         public function skipStatus(){
//         // dd($this->id_for_status_update, now()->toDateString(), $this->note_update, $this->status_id);
//         $coba = Service_logsModel::where('id', '=', $this->id_for_status_update)->first();

//         $statusUpdated = Service_logsModel::where('id', '=', $this->id_for_status_update)->update([
//             'status_id' => 6
//         ]);

//         $statusLogCreate = Status_updatelogModel::create([
//             'service_logs_id' => $coba->techlog_id,
//             'status_id' => 6,
//             'teknisi_id' => session('user_id'),
//             'status_note' => $this->note_update
//         ]);

//         if($statusLogCreate && $statusUpdated) {
//             session()->flash('success', 'Techlog ' . $coba->techlog_id . ' has been succesfully finished');
//         } else {

//             session()->flash('error', 'Error: Failed to update Techlog or log the status change.');
//         }
//         $sl = Service_logsModel::all();

//         $this->dispatch('crud-done', $sl);
//     }

    
//     // #[On('update-data')]
//     public function updateStatus(){

//         if ($this->status_id == 7) {
//             // Rule: Do nothing if status_id is 7
//             $this->dispatch('close-modal');
//             $this->dispatch('crud-done');
//             return; // Exit the method
//         }
//         elseif ($this->status_id >= 1 && $this->status_id <= 5){
//             $this->finalizeStatusId = $this->status_id + 1;
//         }
//         elseif ($this->status_id == 6) {
//             // Rule: If status_id is 6, skip 7 and proceed to 8
//             $this->finalizeStatusId = 8;
//         }
        
//         $coba = Service_logsModel::where('id', '=', $this->id_for_status_update)->first();

//         // dd($this->id_for_status_update, $this->finalizeStatusId, $this->note_update, session('user_id'), $coba->techlog_id);


//         $statusUpdated = Service_logsModel::where('id', '=', $this->id_for_status_update)->update([
//             'status_id' => ($this->finalizeStatusId)
//         ]);

//         if($this->finalizeStatusId == 5){
//             $statusUpdated = Service_logsModel::where('id', '=', $this->id_for_status_update)->update([
//                 'part_ready' => (now()->toDateString())
//             ]);
//         }

//         if($this->finalizeStatusId == 6){
//             $statusUpdated = Service_logsModel::where('id', '=', $this->id_for_status_update)->update([
//                 'completed_date' => (now()->toDateString())
//             ]);
//         }

//         if($this->finalizeStatusId == 8){
//             $statusUpdated = Service_logsModel::where('id', '=', $this->id_for_status_update)->update([
//                 'return_date' => (now()->toDateString())
//             ]);
//         }

//         $sl = Service_logsModel::all();

//         $statusLogCreate = Status_updatelogModel::create([
//             'service_logs_id' => $coba->techlog_id,
//             'status_id' => $this->finalizeStatusId,
//             'teknisi_id' => session('user_id'),
//             'status_note' => $this->note_update
//         ]);
//         if($statusLogCreate && $statusUpdated) {
//             session()->flash('success', 'Techlog ' . $coba->techlog_id . ' has been succesfully updated');
//         } else {

//             session()->flash('error', 'Error: Failed to update Techlog or log the status change.');
//         }

//         $this->dispatch('close-modal');
//         $this->dispatch('crud-done', $sl);
//     }

//     public function render()
//     {

//         return view('livewire.modal-update', [
//         ]);
//     }
// }
