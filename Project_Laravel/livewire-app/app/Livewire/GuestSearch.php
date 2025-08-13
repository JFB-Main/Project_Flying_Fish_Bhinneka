<?php

namespace App\Livewire;

use App\Models\Service_logsModel;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class GuestSearch extends Component
{

    public $TechlogIDSearch = '';

    public function getServiceLogsProperty()
    {
        // Add ->get() to execute the query and return a Collection of models
        return Service_logsModel::with('status', 'serviceId')
            ->when($this->TechlogIDSearch, fn (Builder $query) => $query->where('techlog_id', 'like', "%{$this->TechlogIDSearch}%"))
            ->first();
    }


    public function render()
    {
        return view('livewire.guest-search', [
            'service_log' => $this->serviceLogs,
            'tl_hide' => $this->TechlogIDSearch
        ])->extends('specific')->section('guestSearchYield');
    }
}
