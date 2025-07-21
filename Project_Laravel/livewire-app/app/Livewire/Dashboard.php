<?php

namespace App\Livewire;

use App\Models\Service_logsModel;
use App\Models\Service_typeModel;
use App\Models\StatusModel;
use App\Models\UsersModel;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Collection;

class Dashboard extends Component
{
    
    use WithPagination;

    public $nameSearch;
    public $mobileNumberSearch;
    public $emailSearch;
    public $contactPersonSearch;
    public $brandTypeSearch;
    public $serialNumberSearch;
    public $skuSearch;
    public $salesOrdersSearch;

    public $TechlogIDSearch;

    public $serviceTypeDDL;

    public $statusDDL;
    public $createByDDL;

    // #[On('crud-done')]
    // public function updateList($sl = null)
    // {
    //     // $sl = Service_logsModel::all();
    // }
    // public function showStatusCounts()
    // {
    //     $statusCounts = Service_logsModel::select('status_id', Service_logsModel::raw('count(*) as total'))
    //         ->groupBy('status_id')
    //         ->pluck('total', 'status_id'); // This creates an associative array

    //     // Example: To get a default of 0 for statuses that have no entries
    //     $allPossibleStatuses = [1, 2, 3, 4, 5, 6, 7]; // Define all your status IDs
    //     $finalStatusCounts = collect($allPossibleStatuses)->mapWithKeys(function ($statusId) use ($statusCounts) {
    //         return [$statusId => $statusCounts->get($statusId, 0)];
    //     });

    //     return compact($finalStatusCounts);
    // }
    
    // public function logout()
    // {
        
    //     // Clear session data
    //     session()->invalidate();
    //     session()->regenerateToken();
        
    //     // Redirect to login
    //     return $this->redirect('/login', navigate: true);
    // }
    public function mount()
    {
        // Redirect if not logged in
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }
    }


    public function render()
    {
        $statusCountsFromDb = Service_logsModel::select('status_id', Service_logsModel::raw('count(*) as total'))
            ->groupBy('status_id')
            ->pluck('total', 'status_id');

     
        $allPossibleStatuses = [1, 2, 3, 4, 5, 6, 7, 8]; // Example: 1=Open, 2=Pending, etc.


        $finalStatusCounts = collect($allPossibleStatuses)->mapWithKeys(function ($statusId) use ($statusCountsFromDb) {
            return [$statusId => $statusCountsFromDb->get($statusId, 0)];
        })->toArray(); 

        $this->statusCounts = $finalStatusCounts;


        $Open = Service_logsModel::where('status_id', '=', "1")->count();

        $Status_ListDDL = StatusModel::all();
        $ServiceType_ListDDL = Service_typeModel::all();
        $Users_ListDDL = usersModel::all();
        
        $sl = Service_logsModel::with('status', 'serviceId')
        ->where('received_from', 'like', "%{$this->nameSearch}%")
        ->where('mobile_number', 'like', "%{$this->mobileNumberSearch}%")
        ->where('email', 'like', "%{$this->emailSearch}%")
        ->where('contact_person', 'like', "%{$this->contactPersonSearch}%")
        ->where('brand_type', 'like', "%{$this->brandTypeSearch}%")
        ->where('serial_number', 'like', "%{$this->serialNumberSearch}%")
        ->where('SKU', 'like', "%{$this->skuSearch}%")
        ->where('sales_order', 'like', "%{$this->salesOrdersSearch}%")
        
        ->where('techlog_id', 'like', "%{$this->TechlogIDSearch}%")
        ->where('status_id', 'like', "%{$this->statusDDL}%")
        ->where('service_type', 'like', "%{$this->serviceTypeDDL}%")
        ->where('create_by', 'like', "%{$this->createByDDL}%")
        ->paginate(10);

        return view('livewire.dashboard', [
            'Users_DDL_ArrayContain' => $Users_ListDDL,
            'ServiceType_DDL_ArrayContain' => $ServiceType_ListDDL,
            'Status_DDL_ArrayContain' => $Status_ListDDL,
            'service_log' => $sl,
            'cardOnOpen' => $Open,
            'statusCount' => $this->statusCounts
        ])->layout('welcome');
    }
}
