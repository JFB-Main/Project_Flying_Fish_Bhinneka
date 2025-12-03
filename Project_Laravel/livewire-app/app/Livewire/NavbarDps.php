<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class NavbarDps extends Component
{
    
    
    public $pageTitle; // default

    public $message;

    public function mount($message = '')
    {
        $this->message = $message;

        $routeName = Route::currentRouteName();

        $this->pageTitle = match($routeName) {
            'dashboard-dps' => 'Dashboard',
            'data-servis-dps' => 'Manajemen Servis',
            'add-servis-dps' => 'Tambah Servis',
            'pelanggan-dps' => 'Tambah Pelanggan',
            'data-pelanggan-dps' => 'Data Pelanggan',
            'detail-pelanggan-dps' => 'Detail Pelanggan',
            null => 'N/A', // <- if route has no name
            default => 'Dashboard'
        };
    }

    public function render()
    {
        return view('livewire.navbar-dps');
    }
}
