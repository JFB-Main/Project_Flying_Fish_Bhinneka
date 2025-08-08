<?php

namespace App\Livewire;

use App\Models\UsersModel;
use Livewire\Attribute\Rule;
use Livewire\Component;
use Livewire\Attribute\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class Clicker extends Component
{

    
    public $pageTitle; // default

    public $message;

    // protected $listeners = ['setPageTitle' => 'updatePageTitle'];

    // public function updatePageTitle($title)
    // {
    //     $this->pageTitle = $title;
    // }


    
    // public function createNewUser(){
    //     $userCreate = UsersModel::create([
    //         'username' => "testuse32",
    //         'email' => "testuser32@gmail.com",
    //         'password' => bcrypt('admin123')
    //     ]);
    //        if($userCreate) {
    //         session()->flash('success', 'Register Berhasil!.');
    //     }   
    //     $this->dispatch('crud-done', $userCreate);
    // }

    public function reloadList(){
        $users = UsersModel::paginate(2);
        $this->dispatch('crud-done');
    }

    // #[On('logout-press')]
    // public function logout()
    // {
        
    //     // Clear session data
    //     session()->invalidate();
    //     session()->regenerateToken();
        
    //     // Redirect to login
    //     return $this->redirect('/login', navigate: true);
    // }
    

    public function mount($message = '')
    {
        // Redirect if not logged in
        // if (!auth()->check()) {
        //     return redirect()->route('auth.login');
        // }

        $this->message = $message;

        $routeName = Route::currentRouteName();

        $this->pageTitle = match($routeName) {
            'dashboard' => 'Dashboard',
            'dataReport' => 'Data Report',
            'create-techlog' => 'Create Techlog',
            null => 'N/A', // <- if route has no name
            default => 'Dashboard'
        };
    }


    public function render()
    {
        
        $userId = session('user_id');
        $username = session('username');
        return view('livewire.clicker')->layout('welcome');
    }
}
