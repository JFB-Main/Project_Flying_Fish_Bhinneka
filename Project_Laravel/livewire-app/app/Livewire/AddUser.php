<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;

class AddUser extends Component
{
    public $input_username = ''; 
    public $input_email = '';
    public $input_password = '';
    public $input_confirmPassword = '';

    public function createUser(){
        dd($this->input_username, $this->input_email, $this->input_password, $this->input_confirmPassword);
    }

    public function mount(){
        if((session('role') !== 2 || !auth()->check())){
            return redirect()->route('auth.login');
        }
    }

    public function render()
    {
        return view('livewire.add-user')->extends('specific')->section('addUserYield');
    }
}
