<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service_logsModel;
use Livewire\Attributes\On; 
use Livewire\Attributes\URL; 
use Livewire\Attributes\Title; 

class ReceiptForm extends Component
{

    #[Url(as: 'id', except: '')]
    public $id = '';

    public $tl;

    public $pageTitle = 'Receipt Form';
//    #[Title(fn () => $this->pageTitle)]

    public function mount()
    {
        // Fetch the service log data using the ID from the URL
        $this->tl = Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')
            ->where('id', '=', $this->id)
            ->first();

        // Dynamically update the pageTitle property based on fetched data
        if ($this->tl && $this->tl->techlog_id) {
            $this->pageTitle = 'Receipt_Form_' . $this->tl->techlog_id;
        } else {
            // Fallback if data is not found or techlog_id is missing
            $this->pageTitle = 'Receipt_Form_N/A';
        }
    }
    
    
    public function render()
    {
        return view('livewire.receipt-form')->extends('layouts.printForm')->section('receiptForm')->title($this->pageTitle);
    }
}
