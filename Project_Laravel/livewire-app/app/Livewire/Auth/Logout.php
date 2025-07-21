<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function render()
    {
        Auth::logout();
        // Clear session data
        session()->invalidate();
        session()->regenerateToken();
        
        // Redirect to login
        return view('livewire.auth.login')->layout('layouts.auth');
        // return view('livewire.auth.logout');
    }
}
