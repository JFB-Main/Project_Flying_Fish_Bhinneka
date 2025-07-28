<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
// use Livewire\Attributes\Layout;

class Logout extends Component
{
    
// #[Layout('layouts.auth')]

 public function mount()
    {
        Auth::logout();
        
        // Clear session data
        session()->invalidate();
        session()->regenerateToken();
        
        // Redirect to login route
        return $this->redirect(route('auth.login'), navigate: true); 
        // Or if you don't use SPA navigation:
        // return $this->redirect(route('auth.login')); 
    }
    public function render()
    {
        return view('livewire.auth.logout');
    }
}
