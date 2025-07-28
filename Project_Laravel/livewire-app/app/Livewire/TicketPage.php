<?php

namespace App\Livewire;

use App\Models\NotesModel;
use App\Models\Service_logsModel;
use App\Models\Status_updatelogModel;
use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\Attributes\URL; 
use Livewire\WithPagination;

class TicketPage extends Component
{
        
    use WithPagination;

    #[Url(as: 'id', except: '')]
    public $id = '';

    public $note_specific_update;

    // #[On('open-ticketPage')]
    // public function passingData($id_selected){
    //     dd($id_selected);
    //     $this->id_selected = $id_selected;
    // }

    public function createNote(){
        $tl_for_create_note = Service_logsModel::where('id', '=', $this->id)->get()->first();
        // dd($this->id, $tl_for_create_note->techlog_id, session('user_id'), $this->note_specific_update);

        $noteCreate = NotesModel::create([
            'service_logs_id' => $tl_for_create_note->techlog_id,
            'teknisi_id' => session('user_id'),
            'note_content' => $this->note_specific_update
        ]);
        if($noteCreate) {
            session()->flash('success', 'Register Berhasil!.');
        }   
        $this->dispatch('close-modal');
        $this->dispatch('note-crud-done', $noteCreate);

    }

    #[On('note-crud-done')]
    public function noteRefresh($notesList = null)
    {
    }


    public function mount(){
        // dd("jsbvhd");
    }

// #[Layout('specific')]
    public function render()
    {
        $sl_ListDDL = Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')->where('id', '=', $this->id)->get()->first();

        if ($sl_ListDDL){
            $statusUpdateLogList = Status_updatelogModel::with('status', 'technician')->where('service_logs_id', '=', $sl_ListDDL->techlog_id)->paginate(10);
            $notesList = NotesModel::with('technician')->where('service_logs_id', '=', $sl_ListDDL->techlog_id)->paginate(10);
        }

        

        return view('livewire.ticket-page', [
            'sl' => $sl_ListDDL,
            'notes' => $notesList,
            'statusLog' => $statusUpdateLogList
        ])->extends('specific')->section('ticketContent');
    }
}
