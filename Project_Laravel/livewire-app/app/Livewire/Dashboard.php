<?php

namespace App\Livewire;

use App\Models\Service_logsModel;
use App\Models\Service_typeModel;
use App\Models\StatusModel;
use App\Models\UsersModel;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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
    public $searchFromDateIn;
    public $searchToDateIn;
    public $searchFromCompleted;
    public $searchToCompleted;

    // Public properties to store static data
    public $allStatuses;
    public $allServiceTypes;
    public $allUsers;
    
    // Mount is only called once when the component is created.
    public function mount()
    {
        // Redirect if not logged in
        if (!auth()->check()) {
            return $this->redirect(route('auth.login'), navigate: true);
        }

        // Fetch static data only once on mount
        $this->allStatuses = StatusModel::all();
        $this->allServiceTypes = Service_typeModel::all();
        $this->allUsers = UsersModel::all();
    }

    public function deleteTechlog($idInput){
        // dd($idInput, 'aksddhiaugwauhjw');
        $delete = Service_logsModel::find($idInput);
        $delete->delete();

        session()->flash('success', 'Delete Berhasil!.');
        $this->dispatch('crud-done');
    }

    // A computed property to get status counts
    // It will be re-evaluated only when a dependent property (like a search term) changes
    public function getStatusCountsProperty()
    {
        $statusCountsFromDb = Service_logsModel::select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->pluck('total', 'status_id');

        $allPossibleStatuses = [1, 2, 3, 4, 5, 6, 7, 8];
        
        return collect($allPossibleStatuses)->mapWithKeys(function ($statusId) use ($statusCountsFromDb) {
            return [$statusId => $statusCountsFromDb->get($statusId, 0)];
        })->toArray();
    }

    // A computed property for the main paginated query
    // This is the most efficient way to handle this in Livewire
    public function getServiceLogsProperty()
    {
    return Service_logsModel::with('status', 'serviceId')
            ->when($this->nameSearch, fn (Builder $query) => $query->where('received_from', 'like', "%{$this->nameSearch}%"))
            ->when($this->mobileNumberSearch, fn (Builder $query) => $query->where('mobile_number', 'like', "%{$this->mobileNumberSearch}%"))
            ->when($this->emailSearch, fn (Builder $query) => $query->where('email', 'like', "%{$this->emailSearch}%"))
            ->when($this->contactPersonSearch, fn (Builder $query) => $query->where('contact_person', 'like', "%{$this->contactPersonSearch}%"))
            ->when($this->brandTypeSearch, fn (Builder $query) => $query->where('brand_type', 'like', "%{$this->brandTypeSearch}%"))
            ->when($this->serialNumberSearch, fn (Builder $query) => $query->where('serial_number', 'like', "%{$this->serialNumberSearch}%"))
            ->when($this->skuSearch, fn (Builder $query) => $query->where('SKU', 'like', "%{$this->skuSearch}%"))
            ->when($this->salesOrdersSearch, fn (Builder $query) => $query->where('sales_order', 'like', "%{$this->salesOrdersSearch}%"))
            ->when($this->TechlogIDSearch, fn (Builder $query) => $query->where('techlog_id', 'like', "%{$this->TechlogIDSearch}%"))
            ->when($this->statusDDL, fn (Builder $query) => $query->where('status_id', 'like', "%{$this->statusDDL}%"))
            ->when($this->serviceTypeDDL, fn (Builder $query) => $query->where('service_type', 'like', "%{$this->serviceTypeDDL}%"))
            ->when($this->createByDDL, fn (Builder $query) => $query->where('create_by', 'like', "%{$this->createByDDL}%"))
            ->when($this->searchFromDateIn && $this->searchToDateIn, fn (Builder $query) => $query->whereBetween('date_in', [$this->searchFromDateIn, $this->searchToDateIn . ' 23:59:59']))
            ->when($this->searchFromDateIn && !$this->searchToDateIn, fn (Builder $query) => $query->where('date_in', '>=', $this->searchFromDateIn))
            ->when($this->searchToDateIn && !$this->searchFromDateIn, fn (Builder $query) => $query->where('date_in', '<=', $this->searchToDateIn . ' 23:59:59'))
            ->when($this->searchFromCompleted && $this->searchToCompleted, fn (Builder $query) => $query->whereBetween('completed_date', [$this->searchFromCompleted, $this->searchToCompleted . ' 23:59:59']))
            ->when($this->searchFromCompleted && !$this->searchToCompleted, fn (Builder $query) => $query->where('completed_date', '>=', $this->searchFromCompleted))
            ->when($this->searchToCompleted && !$this->searchFromCompleted, fn (Builder $query) => $query->where('completed_date', '<=', $this->searchToCompleted . ' 23:59:59'))
            ->latest()
            ->paginate(10);

    }

    #[On('crud-done')]
    public function updateList($sl = null)
    {
        // $sl = Service_logsModel::all();
    }

    public function ticketPageLink($id_selected){
        // dd($id_selected);
        
        // $this->dispatch('open-ticketPage', $id_selected);

        return redirect()->route('TicketPage', ['id' => $id_selected]);
    }
    
    #[Layout('welcome')]
    public function render()
    {
        return view('livewire.dashboard', [
            // Use the computed properties in the view
            'Users_DDL_ArrayContain' => $this->allUsers,
            'ServiceType_DDL_ArrayContain' => $this->allServiceTypes,
            'Status_DDL_ArrayContain' => $this->allStatuses,
            'service_log' => $this->serviceLogs,
            'cardOnOpen' => $this->statusCounts[1], // Access the computed property value
            'statusCount' => $this->statusCounts
        ]);
    }
}






















// class Dashboard extends Component
// {
    
//     use WithPagination;

//     public $nameSearch;
//     public $mobileNumberSearch;
//     public $emailSearch;
//     public $contactPersonSearch;
//     public $brandTypeSearch;
//     public $serialNumberSearch;
//     public $skuSearch;
//     public $salesOrdersSearch;

//     public $TechlogIDSearch;

//     public $serviceTypeDDL;

//     public $statusDDL;
//     public $createByDDL;

//     public $statusCounts;

//     public $searchFromDateIn;

//     public $searchToDateIn;

//     public $searchFromCompleted;

//     public $searchToCompleted;

//     #[On('crud-done')]
//     public function updateList($sl = null)
//     {
//         // $sl = Service_logsModel::all();
//     }


//     // public function showStatusCounts()
//     // {
//     //     $statusCounts = Service_logsModel::select('status_id', Service_logsModel::raw('count(*) as total'))
//     //         ->groupBy('status_id')
//     //         ->pluck('total', 'status_id'); // This creates an associative array

//     //     // Example: To get a default of 0 for statuses that have no entries
//     //     $allPossibleStatuses = [1, 2, 3, 4, 5, 6, 7]; // Define all your status IDs
//     //     $finalStatusCounts = collect($allPossibleStatuses)->mapWithKeys(function ($statusId) use ($statusCounts) {
//     //         return [$statusId => $statusCounts->get($statusId, 0)];
//     //     });

//     //     return compact($finalStatusCounts);
//     // }
    
//     // public function logout()
//     // {
        
//     //     // Clear session data
//     //     session()->invalidate();
//     //     session()->regenerateToken();
        
//     //     // Redirect to login
//     //     return $this->redirect('/login', navigate: true);
//     // }

//     public function ticketPageLink($id_selected){
//         // dd($id_selected);
//         $this->dispatch('open-ticketPage', $id_selected);

//         return redirect()->route('TicketPage', ['id' => $id_selected]);
//     }
//     // public function receiptFormLink($id_selected){
//     //     // dd($id_selected);
//     //     $this->dispatch('open-receiptForm', $id_selected);

//     //     return redirect()->route('receiptForm', ['id' => $id_selected]);
//     // }

//     public function mount()
//     {
//         // Redirect if not logged in
//         if (!auth()->check()) {
//             return redirect()->route('auth.login');
//         }
//     }

// #[Layout('welcome')]
//     public function render()
//     {
//         $statusCountsFromDb = Service_logsModel::select('status_id', Service_logsModel::raw('count(*) as total'))
//             ->groupBy('status_id')
//             ->pluck('total', 'status_id');

     
//         $allPossibleStatuses = [1, 2, 3, 4, 5, 6, 7, 8]; // Example: 1=Open, 2=Pending, etc.


//         $finalStatusCounts = collect($allPossibleStatuses)->mapWithKeys(function ($statusId) use ($statusCountsFromDb) {
//             return [$statusId => $statusCountsFromDb->get($statusId, 0)];
//         })->toArray(); 

//         $this->statusCounts = $finalStatusCounts;


//         $Open = Service_logsModel::where('status_id', '=', "1")->count();

//         $Status_ListDDL = StatusModel::all();
//         $ServiceType_ListDDL = Service_typeModel::all();
//         $Users_ListDDL = usersModel::all();
        
//         $sl = Service_logsModel::with('status', 'serviceId')
//         ->where('received_from', 'like', "%{$this->nameSearch}%")
//         ->where('mobile_number', 'like', "%{$this->mobileNumberSearch}%")
//         ->where('email', 'like', "%{$this->emailSearch}%")
//         ->where('contact_person', 'like', "%{$this->contactPersonSearch}%")
//         ->where('brand_type', 'like', "%{$this->brandTypeSearch}%")
//         ->where('serial_number', 'like', "%{$this->serialNumberSearch}%")
//         ->where('SKU', 'like', "%{$this->skuSearch}%")
//         ->where('sales_order', 'like', "%{$this->salesOrdersSearch}%")
        
//         ->where('techlog_id', 'like', "%{$this->TechlogIDSearch}%")
//         ->where('status_id', 'like', "%{$this->statusDDL}%")
//         ->where('service_type', 'like', "%{$this->serviceTypeDDL}%")
//         ->where('create_by', 'like', "%{$this->createByDDL}%");

//         if ($this->searchFromDateIn && $this->searchToDateIn) {

//             $toDateForQuery = $this->searchToDateIn . ' 23:59:59'; 

//             $sl->whereBetween('date_in', [$this->searchFromDateIn, $toDateForQuery]);
//         }
//         // conditions for when only one date is provided
//         elseif ($this->searchFromDateIn) {
//             $sl->where('date_in', '>=', $this->searchFromDateIn);
//         }
//         elseif ($this->searchToDateIn) {
//             $sl->where('date_in', '<=', $this->searchToDateIn . ' 23:59:59');
//         }

        
//         if ($this->searchFromCompleted && $this->searchToCompleted) {

//             $toCompletedForQuery = $this->searchToCompleted . ' 23:59:59'; 

//             $sl->whereBetween('completed_date', [$this->searchFromCompleted, $toCompletedForQuery]);
//         }
//         elseif ($this->searchFromCompleted) {
//             $sl->where('completed_date', '>=', $this->searchFromCompleted);
//         }
//         elseif ($this->searchToCompleted) {
//             $sl->where('completed_date', '<=', $this->toCompletedForQuery . ' 23:59:59');
//         }


//         $sl = $sl->latest()->paginate(10);

//         return view('livewire.dashboard', [
//             'Users_DDL_ArrayContain' => $Users_ListDDL,
//             'ServiceType_DDL_ArrayContain' => $ServiceType_ListDDL,
//             'Status_DDL_ArrayContain' => $Status_ListDDL,
//             'service_log' => $sl,
//             'cardOnOpen' => $Open,
//             'statusCount' => $this->statusCounts
//         ]);
//     }
// }
