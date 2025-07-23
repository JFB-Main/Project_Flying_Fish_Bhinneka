<?php

namespace App\Livewire;

use App\Models\Service_logsModel;
use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\Attributes\URL; 
use Livewire\Attributes\Layout;

class TicketPage extends Component
{
    #[Url(as: 'id', except: '')]
    public $id = '';

    // #[On('open-ticketPage')]
    // public function passingData($id_selected){
    //     dd($id_selected);
    //     $this->id_selected = $id_selected;
    // }

    public function mount(){
        // dd("jsbvhd");
    }

// #[Layout('specific')]
    public function render()
    {
        $sl_ListDDL = Service_logsModel::with('user', 'status', 'serviceId', )->where('id', '=', $this->id)->get()->first();

        

        return view('livewire.ticket-page', [
            'sl' => $sl_ListDDL
        ])->extends('specific')->section('ticketContent');
    }
}
