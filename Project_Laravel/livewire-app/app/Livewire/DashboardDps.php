<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;

use App\Models\ServiceLogDps; // Use the correct model
use App\Models\StatusDps;

class DashboardDps extends Component
{

    public $overviewSearchFromDateIn;
    public $overviewSearchToDateIn;

#[Computed]
public function getStatusTypeCountsProperty()
{
    // 1. Fetch the counts by joining the status table and grouping by status_type
    $statusCountsFromDb = ServiceLogDps::query()
        // Join the related status table. 
        // ->join('status_dps', 'service_logs_dps.status', '=', 'status_dps.id') 
        
        // Select the status type name and count the records
        ->select('status', DB::raw('count(*) as total'))
        
        // Apply the date range filtering using the existing properties
        ->when($this->overviewSearchFromDateIn && $this->overviewSearchToDateIn, fn (Builder $query) => 
            $query->whereBetween('service_logs_dps.jadwal_kunjungan', [$this->overviewSearchFromDateIn, $this->overviewSearchToDateIn . ' 23:59:59']))
        ->when($this->overviewSearchFromDateIn && !$this->overviewSearchToDateIn, fn (Builder $query) => 
            $query->where('service_logs_dps.jadwal_kunjungan', '>=', $this->overviewSearchFromDateIn))
        ->when($this->overviewSearchToDateIn && !$this->overviewSearchFromDateIn, fn (Builder $query) => 
            $query->where('service_logs_dps.jadwal_kunjungan', '<=', $this->overviewSearchToDateIn . ' 23:59:59'))
            
        // Group by the status type (name)
        ->groupBy('status')
        
        // Pluck total counts, keyed by status_type string
        ->pluck('total', 'status'); 


    // 2. Get all possible Status records (ID and Name) and SORT BY ID
    $allStatuses = StatusDps::orderBy('id', 'asc')->get();
    
    // 3. Map the counts (keyed by ID) to the Status Names (for display)
    $finalCounts = [];
    
    // Iterate over the collection that is ALREADY sorted by ID
    foreach ($allStatuses as $status) {
        $id = $status->id;
        $name = $status->status_type;
        
        // Get the count from the results, defaulting to 0
        $count = $statusCountsFromDb->get($id, 0); 
        
        // Store the result using the Status NAME as the key
        // Since we are iterating in ID order, the resulting array will be in ID order
        $finalCounts[$name] = $count;
    }
    
    return $finalCounts; // Returns an array like: ['New Request' => 5, 'On Hold' => 0, 'Completed' => 12]
}


#[Computed]
public function getServiceLogCountTotalProperty()
{
return ServiceLogDps::query()
        
        // Apply date range filtering (only if properties are set)
        ->when($this->overviewSearchFromDateIn && $this->overviewSearchToDateIn, fn (Builder $query) => 
            $query->whereBetween('created_at', [$this->overviewSearchFromDateIn, $this->overviewSearchToDateIn . ' 23:59:59']))
        ->when($this->overviewSearchFromDateIn && !$this->overviewSearchToDateIn, fn (Builder $query) => 
            $query->where('created_at', '>=', $this->overviewSearchFromDateIn))
        ->when($this->overviewSearchToDateIn && !$this->overviewSearchFromDateIn, fn (Builder $query) => 
            $query->where('created_at', '<=', $this->overviewSearchToDateIn . ' 23:59:59'))            

        ->count();
}

    public function render()
    {
        return view('livewire.dashboard-dps')->extends('specific-dps')->section('dashboardDPSContent');
    }
}
