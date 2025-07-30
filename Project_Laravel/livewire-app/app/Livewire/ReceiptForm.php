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

    public function mount(){
        // Fetch the service log data
        $this->tl = Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')
            ->where('id', '=', $this->id)
            ->first();

        // Dynamically set the pageTitle property here
        if ($this->tl && $this->tl->techlog_id) {
            $this->pageTitle = 'Receipt Form - TechLog_ID_' . $this->tl->techlog_id;
        } else {
            $this->pageTitle = 'Receipt Form - N/A';
        }

        $this->dispatch('set-page-title', title: $this->pageTitle);
    }
    
    
    public function render()
    {
        return view('livewire.receipt-form')->extends('layouts.printForm')->section('receiptForm');;
    }
}
