<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;


class MainMenu extends Component
{
    public function render()
    {
        return view('livewire.main-menu')->extends('mainLayout')->section('mainmenu');
    }
}
