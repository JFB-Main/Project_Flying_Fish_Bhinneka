<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\UsersModel;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AddUser extends Component
{
    use WithPagination;

    #[Validate('required|min:3|max:50', message: 'The username must be between 3 and 50 characters.')]
    public $input_username = '';

    #[Validate('required|email|unique:users,email', message: 'This email is already in use or invalid.')]
    public $input_email = '';

    #[Validate('required|min:8', message: 'The password must be at least 8 characters long.')]
    public $input_password = '';

    #[Validate('required|same:input_password', message: 'The confirmation password must match the password.')]
    public $input_confirmPassword = '';

    public function createUser(){
        $this->validate();
        
        // dd($this->input_username, $this->input_email, $this->input_password, $this->input_confirmPassword);

        if($this->input_password != $this->input_confirmPassword){
        }
        else{
        $userCreate = UsersModel::create([
            'username' => $this->input_username,
            'email' => $this->input_email,
            'password' => bcrypt($this->input_password)
        ]);
           if($userCreate) {
            session()->flash('success', 'Register Berhasil!.');
        }   
        $this->dispatch('crud-users-done', $userCreate);
        }
    }

    public function deleteUser($input){
        // dd($input);

        $record = UsersModel::find($input); 
        if ($record) {
            // dd($record);
            $deleted = $record->delete();

            if($deleted){
                session()->flash('successDelete', 'Penghapusan Akun Berhasil!');
            }
            else{
                session()->flash('errorDelete', 'Penghapusan Akun gagal!');
            }
        }


    }

    #[On('crud-user-done')]
    public function updateList($userlist = null)
    {
        // $sl = Service_logsModel::all();
    }

    public function mount(){
        if((session('role') != 1 || !auth()->check())){
            return redirect()->route('auth.login');
        }

    }

    public function render()
    {
        $userlist = UsersModel::paginate();

        return view('livewire.add-user', [
            'listUser' => $userlist
        ])->extends('specific')->section('addUserYield');
    }
}
