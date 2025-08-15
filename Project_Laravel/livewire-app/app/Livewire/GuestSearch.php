<?php

namespace App\Livewire;

use App\Models\Service_logsModel;
use App\Models\NotesModel;
use App\Models\Status_updatelogModel;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;


class GuestSearch extends Component
{

    use WithPagination;

    public $TechlogIdSearch = '';

    protected function rules()
    {
        return [
            'TechlogIdSearch'   => 'required|string|min:11|max:11',
        ];
    }

    protected function messages()
    {
        return [
            'TechlogIdSearch.required'  => 'The Techlog is required.',
        ];
    }

    public function search(){
        $this->validate();
        return $this->TechlogIdSearch;
    }

    #[Computed]
    public function getServiceLogsProperty()
    {
        // Add ->get() to execute the query and return a Collection of models
        return Service_logsModel::with('status', 'serviceId', 'warranty_bind')
            ->when($this->TechlogIdSearch, fn (Builder $query) => $query->where('techlog_id', '=', "{$this->TechlogIdSearch}"))
            ->first();
    }

    #[Computed]
    public function statusLog()
    {
        if ($this->ServiceLogs) {
            return Status_updatelogModel::with('status', 'technician')
                ->where('service_logs_id', '=', $this->ServiceLogs->techlog_id)
                ->paginate(10);
        }
        // return null;
        // return collect();
        return new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
    }

    // Use a computed property for notes with pagination.
    #[Computed]
    public function notes()
    {
        if ($this->ServiceLogs) {
            return NotesModel::with('technician')
                ->where('service_logs_id', '=', $this->ServiceLogs->techlog_id)
                ->paginate(10);
        }
        // return null;
        return new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
    }


    public function render()
    {
        return view('livewire.guest-search', [
            'service_log' => $this->serviceLogs,
            'tl_hide' => $this->TechlogIdSearch,
            'notes' => $this->notes,
            'statusLog' => $this->statusLog
        ])->extends('specific')->section('guestSearchYield');
    }
}
