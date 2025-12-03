<?php

use App\Livewire\AddUser;
use App\Livewire\Auth\Logout;
use App\Livewire\CreateTicketDps;
use App\Livewire\Dashboard;
use App\Livewire\CreateTechlog;
use App\Livewire\DashboardDps;
use App\Livewire\DataPelanggan;
use App\Livewire\DataReport;
use App\Livewire\DetailPelangganDps;
use App\Livewire\DetailServisDps;
use App\Livewire\ExportServisDps;
use App\Livewire\JobOrder;
use App\Livewire\LaporanServisDps;
use App\Livewire\MainMenu;
use App\Livewire\ManajemenServis;
use App\Livewire\PelangganDpsPage;
use App\Livewire\ReceiptForm;
use App\Livewire\TicketPage;
use App\Livewire\GuestSearch;
use App\Livewire\ChangePassword;
use Illuminate\Support\Facades\Route;


use App\Livewire\Clicker;

use App\Livewire\Auth\Login;


Route::group(['middleware' => 'guest'], function(){

    //login
    Route::get('/login', Login::class)->name('auth.login');

});

Route::get('/guestSearch', GuestSearch::class)->name('guestSearch');
Route::get('/', MainMenu::class)->name('mainMenu');


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

    //batas=-------------------------------------------------------------------------------
    //batas=-------------------------------------------------------------------------------

    // Route::get('/login', Login::class)->name('auth.login');

    // Route::get('/', Dashboard::class)->name('dashboard');
    // Route::get('/dataReport', DataReport::class)->name('dataReport');

    // Route::get('/create', CreateTechlog::class)->name('create-techlog');
    // Route::get('/addUser', AddUser::class)->name('addUser');
    
    // // Route::get('/ticketPage', TicketPage::class)->name('TicketPage');
    // Route::get('/ticketPage/{id}', TicketPage::class)->name('TicketPage');

    // Route::get('/receiptForm/{id}', ReceiptForm::class)->name('receiptForm');
    // Route::get('/jobOrder/{id}', JobOrder::class)->name('jobOrder');

    // Route::get('/logout', Logout::class)->name('auth.logout');


    //batas=-------------------------------------------------------------------------------
    //batas=-------------------------------------------------------------------------------

    // Route::get('/ticketPage/{id_selected}', TicketPage::class($id_selected))->name('TicketPage');
    // Route::get('/', Dashboard::class)->name('dashboard');

    //------------------------------------------------------------------------------------------------------------------------------------------------

    // Route::middleware(['auth', 'role:22'])->group(function () {
        
    //     // Note: The role check happens at the group level. 
    //     // If you need more granular control, use the 'permission' middleware instead (as discussed previously).

    //     Route::get('/flyingfish/dashboard', Dashboard::class)->name('dashboard');
    //     Route::get('/dataReport', DataReport::class)->name('dataReport');
    //     Route::get('/create', CreateTechlog::class)->name('create-techlog');
    //     Route::get('/addUser', AddUser::class)->name('addUser');
        
    //     // Routes with parameters (make sure the Livewire components handle the parameters)
    //     Route::get('/ticketPage/{id}', TicketPage::class)->name('TicketPage');
    //     Route::get('/receiptForm/{id}', ReceiptForm::class)->name('receiptForm');
    //     Route::get('/jobOrder/{id}', JobOrder::class)->name('jobOrder');
        
    //     // Logout route is usually simple and sometimes is outside a group depending on its implementation
    //     Route::get('/logout', Logout::class)->name('auth.logout');
    //     Route::get('/changePassword', ChangePassword::class)->name('changePassword');
    // });


//     Route::group(['middleware' => 'auth'], function () {
//         // Route::get('/', MainMenu::class)->name('main-menu');
//         Route::get('/flyingfish/dashboard', Dashboard::class)->name('dashboard');
//         Route::get('/dataReport', DataReport::class)->name('dataReport');
//         Route::get('/create', CreateTechlog::class)->name('create-techlog');
//         Route::get('/addUser', AddUser::class)->name('addUser');
//         Route::get('/ticketPage/{id}', TicketPage::class)->name('TicketPage');
//         Route::get('/receiptForm/{id}', ReceiptForm::class)->name('receiptForm');
//         Route::get('/jobOrder/{id}', JobOrder::class)->name('jobOrder');
//         Route::get('/logout', Logout::class)->name('auth.logout');
//         Route::get('/changePassword', ChangePassword::class)->name('changePassword');

//     //--------------------------------------------------------------------------------------------------------

//         Route::get('/dps/dashboard', DashboardDps::class)->name('dashboard-dps');

//         Route::get('/dps/dataServis', ManajemenServis::class)->name('data-servis-dps');
//         Route::get('/dps/tambahServis', CreateTicketDps::class)->name('add-servis-dps');
//         Route::get('/dps/detailServis/{id}', DetailServisDps::class)->name('detail-servis-dps');
//         Route::get('/dps/laporanServis', LaporanServisDps::class)->name('laporan-servis-dps');
//         Route::get('/dps/exportServis/{id}', ExportServisDps::class)->name('export-servis-dps');

//         Route::get('/dps/pelanggan', PelangganDpsPage::class)->name('pelanggan-dps');
//         Route::get('/dps/dataPelanggan', DataPelanggan::class)->name('data-pelanggan-dps');
//         Route::get('/dps/detailPelanggan/{id}', DetailPelangganDps::class)->name('detail-pelanggan-dps');
// });

//ROLE DISINI DIMAKSUDKAN UNTUK MODULE ROLE YANG MEMISAHKAN AKSES MASING-MASING DEPARTEMEN
// module_role 1 = ff, 2 = dps, 3 = superadmin
// role 1 = superadmin, 2 = admin, 3 = user
    Route::group(['middleware' => 'role:1'], function () {
        // Route::get('/', MainMenu::class)->name('main-menu');
        Route::get('/flyingfish/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/dataReport', DataReport::class)->name('dataReport');
        Route::get('/create', CreateTechlog::class)->name('create-techlog');
        // Route::get('/addUser', AddUser::class)->name('addUser');
        Route::get('/ticketPage/{id}', TicketPage::class)->name('TicketPage');
        Route::get('/receiptForm/{id}', ReceiptForm::class)->name('receiptForm');
        Route::get('/jobOrder/{id}', JobOrder::class)->name('jobOrder');

});


    Route::group(['middleware' => 'auth'], function () {
        Route::get('/addUser', AddUser::class)->name('addUser');
        Route::get('/logout', Logout::class)->name('auth.logout');
        Route::get('/changePassword', ChangePassword::class)->name('changePassword');
});

    //--------------------------------------------------------------------------------------------------------

    Route::group(['middleware' => 'role:2'], function () {

        Route::get('/dps/dashboard', DashboardDps::class)->name('dashboard-dps');

        Route::get('/dps/dataServis', ManajemenServis::class)->name('data-servis-dps');
        Route::get('/dps/tambahServis', CreateTicketDps::class)->name('add-servis-dps');
        Route::get('/dps/detailServis/{id}', DetailServisDps::class)->name('detail-servis-dps');
        Route::get('/dps/laporanServis', LaporanServisDps::class)->name('laporan-servis-dps');
        Route::get('/dps/exportServis/{id}', ExportServisDps::class)->name('export-servis-dps');

        Route::get('/dps/pelanggan', PelangganDpsPage::class)->name('pelanggan-dps');
        Route::get('/dps/dataPelanggan', DataPelanggan::class)->name('data-pelanggan-dps');
        Route::get('/dps/detailPelanggan/{id}', DetailPelangganDps::class)->name('detail-pelanggan-dps');
});
