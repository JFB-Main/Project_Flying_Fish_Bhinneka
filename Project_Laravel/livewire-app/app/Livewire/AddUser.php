<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\UsersModel;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

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

    public $input_role_id = '3';

    
    #[Validate('required|min:8', message: 'The password must be at least 8 characters long.')]
    public $pw_for_change;
    
    #[Validate('required|same:pw_for_change', message: 'The confirmation password must match the password.')]
    public $confirm_pw_for_change;

    public function createUser(){
        $this->validate();
        
        // dd($this->input_username, $this->input_email, $this->input_password, $this->input_confirmPassword, $this->input_role_id);

        if($this->input_password != $this->input_confirmPassword){
        }
        else{
        $userCreate = UsersModel::create([
            'username' => $this->input_username,
            'email' => $this->input_email,
            'password' => bcrypt($this->input_password),
            'role' => $this->input_role_id
        ]);
           if($userCreate) {
            session()->flash('success', 'Register Berhasil!.');
        }   
        $this->reset();
        $this->dispatch('crud-users-done');
        }
    }

    public function resetAdminchangePassword(){
        $this->reset('pw_for_change', 'confirm_pw_for_change');
        $this->dispatch('close-modal');
    }

    public function adminChangePassword($input){
        $this->validate([
            'pw_for_change' => 'required|min:8',
            'confirm_pw_for_change' => 'required|same:pw_for_change',
        ], [
            'pw_for_change.required' => 'The password field is required.',
            'pw_for_change.min' => 'The password must be at least 8 characters long.',
            'confirm_pw_for_change.required' => 'The confirmation password field is required.',
            'confirm_pw_for_change.same' => 'The confirmation password must match the password.',
        ]);

        // dd($input, $this->pw_for_change, $this->confirm_pw_for_change);

        $Admin_passwordUpdate = UsersModel::find($input)->update([
            'password' => bcrypt($this->pw_for_change)
        ]);
        if($Admin_passwordUpdate) {
            session()->flash('success', 'Password has been changed succesfully!.');
        }
        else{
            session()->flash('error', value: 'Password cannot be changed!.');
        }   

        $this->reset();
        $this->dispatch('crud-users-done');
        $this->dispatch('close-modal');
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
        if(((session('role') > 2 || session('role') <= 0 ) || session('role') == null || !auth()->check())){
            return redirect()->route('dashboard');
        }

    }

    #[Computed]
    public function usersList()
    {
        return UsersModel::paginate();
    }

    public function render()
    {
        return view('livewire.add-user', [
            'listUser' => $this->usersList
        ])->extends('specific')->section('addUserYield');
    }
}
