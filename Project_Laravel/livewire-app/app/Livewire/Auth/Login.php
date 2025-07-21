<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Login extends Component
{
    public $username;
    public $password;
    
    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        $this->validate([
            'username'     => 'required',
            'password'  => 'required'
        ]);

        if(Auth::attempt(['username' => $this->username, 'password'=> $this->password])) {

            // Save session data after successful login
            session(['user_id' => Auth::id(), 'username' => $this->username]);
            // Optionally, you can flash a success message
            session()->flash('message', 'Login successful!');

            return $this->redirect('/', navigate: true);

        } else {
            session()->flash('error', 'username atau Password Anda salah!.');
            return $this->redirect('/login', navigate: true);
        }
    }
    
    /**
     * render
     *
     * @return void
     */


    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }
}
