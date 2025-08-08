<?php

namespace App\Livewire;

use Livewire\Component;

class GuestSearch extends Component
{
    public function render()
    {
        return view('livewire.guest-search')->extends('specific')->section('guestSearchYield');
    }
}
