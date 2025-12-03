<?php

namespace App\Livewire;

use Livewire\Component;
// use Livewire\Attributes\Validate;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;
// use Livewire\Attributes\On;
// use Livewire\Attributes\Computed;

class ChangePassword extends Component
{
    public $id = '';
    public $old_password = '';
    public $old_confirmPassword = '';
    public $new_password = '';
    public $new_confirmPassword = '';

    protected function rules()
    {
        return [
            'old_password' => 'required|min:8',
            'old_confirmPassword' => 'required|same:old_password',
            'new_password' => 'required|min:8|different:old_password',
            'new_confirmPassword' => 'required|same:new_password',
        ];
    }

    protected function messages()
    {
        return [
            'old_password.required' => 'The old password is required.',
            'old_password.min' => 'The old password must be at least 8 characters long.',
            'old_confirmPassword.required' => 'The old confirmation password is required.',
            'old_confirmPassword.same' => 'The old confirmation password must match the old password.',
            'new_password.required' => 'The new password is required.',
            'new_password.min' => 'The new password must be at least 8 characters long.',
            'new_password.different' => 'The new password must be different from the old password.',
            'new_confirmPassword.required' => 'The new confirmation password is required.',
            'new_confirmPassword.same' => 'The new confirmation password must match the new password.',
        ];
    }

    public function updatePassword(){
        $this->validate();
        // dd(session('user_id'), $this->old_password, $this->old_confirmPassword, $this->new_password, $this->new_confirmPassword);
        $old_p_check = UsersModel::find(session('user_id'));

        if(Hash::check($this->old_password, $old_p_check->password)){
            $passwordupdate = UsersModel::find(session('user_id'))->update([
                'password' => bcrypt($this->new_password),
            ]);
            if($passwordupdate) {
                session()->flash('success', 'Update Berhasil!.');

            }
            else{
                session()->flash('error', 'Update Tidak Berhasil!.');
            }  
        }
        else{
            session()->flash('error', 'Password Lama Tidak Sesuai Dengan Yang Ada!');
        }

    $this->reset();
    }

    public function render()
    {
        return view('livewire.change-password')->extends('mainLayout')->section('changePasswordYield');;
    }
}
