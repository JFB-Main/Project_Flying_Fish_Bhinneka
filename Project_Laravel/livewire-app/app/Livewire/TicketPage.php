<?php

namespace App\Livewire;

use App\Models\NotesModel;
use App\Models\Service_logsModel;
use App\Models\Status_updatelogModel;
use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\Attributes\URL; 
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class TicketPage extends Component
{
    use WithPagination;

    #[URL(as: 'id', except: '')]
    public $id = '';

    public $note_specific_update;

    public $input_received_from;
    public $input_email;
    public $input_contact_person;
    public $input_mobile_number;
    public $input_address;

    public function editCustomerData(){
        // dd($this->input_received_from, $this->input_email, $this->input_contact_person, $this->input_mobile_number, $this->input_address,);
        $this->dispatch('open-edit-techlog');
        $this->dispatch('note-crud-done');
    }

    public function createNote(){
        // Using find() is more efficient for single record retrieval by primary key.
        $tl_for_create_note = Service_logsModel::find($this->id);

        if (!$tl_for_create_note) {
            session()->flash('error', 'Service log not found.');
            $this->dispatch('close-modal');
            return;
        }

        $noteCreate = NotesModel::create([
            'service_logs_id' => $tl_for_create_note->techlog_id,
            'teknisi_id' => session('user_id'),
            'note_content' => $this->note_specific_update
        ]);
        
        if($noteCreate) {
            session()->flash('success', 'Note created successfully.');
            $this->reset('note_specific_update'); // Reset the note input field
            $this->dispatch('close-modal');
            // Dispatching the event without a payload is more efficient.
            $this->dispatch('note-crud-done');
        } else {
            session()->flash('error', 'Failed to create note.');
        }
    }

    #[On('note-crud-done')]
    public function noteRefresh()
    {
        // This method can be empty, as the component will re-render
        // and fetch the updated data from the computed properties.
    }

    // Use a computed property for the main service log.
    // This will only run the query once per request.
    #[Computed]
    public function sl()
    {
        return Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')->find($this->id);
    }
    
    // Use a computed property for status update logs with pagination.
    #[Computed]
    public function statusLog()
    {
        if ($this->sl) {
            return Status_updatelogModel::with('status', 'technician')
                ->where('service_logs_id', '=', $this->sl->techlog_id)
                ->paginate(10);
        }
        return null;
    }

    // Use a computed property for notes with pagination.
    #[Computed]
    public function notes()
    {
        if ($this->sl) {
            return NotesModel::with('technician')
                ->where('service_logs_id', '=', $this->sl->techlog_id)
                ->paginate(10);
        }
        return null;
    }

    public function render()
    {
        // The render method is now very clean and only passes data from
        // the computed properties to the view.
        return view('livewire.ticket-page', [
            'sl' => $this->sl,
            'notes' => $this->notes,
            'statusLog' => $this->statusLog
        ])->extends('specific')->section('ticketContent');
    }
}