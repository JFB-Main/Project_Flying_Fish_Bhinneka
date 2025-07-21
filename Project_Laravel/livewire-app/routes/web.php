<?php

use App\Livewire\Auth\Logout;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;


use App\Livewire\Clicker;

use App\Livewire\Auth\Login;


Route::group(['middleware' => 'guest'], function(){

    //login
    Route::get('/login', Login::class)->name('auth.login');

});


// Route::middleware([['auth'], 'prefix' => 'auth.'])->group(function () {
//     Route::get('/', Clicker::class)->name('clicker');
// });

// Route::middleware('auth')->delete('login')->name('auth.login')->group(function () {
//     Route::get('/', Clicker::class)->name('clicker');
// });;


// Route::group(['middleware' => ['auth'], 'as' => 'auth'], function () {
//     Route::delete('login')->name('login');
//     Route::get('/', Clicker::class)->name('clicker');
// });

    // Route::get('/', Dashboard::class)->name('dashboard');

    Route::get('/', Dashboard::class)->name('dashboard');

    Route::get('/logout', Logout::class)->name('auth.logout');

