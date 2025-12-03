<?php

namespace App\Livewire\Auth;

use App\Models\UsersModel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Login extends Component
{
    public $username;
    public $password;

    public $rolefetch = null;

    public $role_write;
    
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

        if(Auth::attempt(['username' => $this->username, 'password'=> $this->password]) || Auth::attempt(['email' => $this->username, 'password'=> $this->password])) {
            $this->rolefetch = UsersModel::where('id', '=', Auth::id())->first();


            // $this->role = $this->rolefetch->tip->pluck('role');

            // if ($this->rolefetch->role == 1) {
            //     $this->role_name = 'Superadmin';
            // }
            // elseif($this->rolefetch->role == 2){
            //     $this->role_name = 'admin';
            // }

            // Save session data after successful login
            session(['user_id' => Auth::id(), 'username' => $this->rolefetch->username, 'role' => $this->rolefetch->role, 'module_role' => $this->rolefetch->module_role]);
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
