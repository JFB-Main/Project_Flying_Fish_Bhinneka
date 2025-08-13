<?php

namespace App\Livewire;

use App\Models\NotesModel;
use App\Models\Service_logsModel;
use App\Models\Status_updatelogModel;
use App\Models\WarrantyModel;
use Livewire\Component;
use Livewire\Attributes\On; 
use Livewire\Attributes\URL; 
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class TicketPage extends Component
{
    use WithPagination;

    #[URL(as: 'id', except: '')]
    public $id = '';

    public $note_specific_update;

    public $input_invoice_date = null;

    public $input_so;

    public $input_email;
    public $input_contact_person;
    public $input_mobile_number;
    public $input_address;

    public $input_sku;
    public $input_brand_type;
    public $input_part_number;
    public $input_serial_number;

    public $input_warranty = null;

    public $input_desc;
    public $input_problem;
    public $input_pre_diagnostic;
    public $input_add_on;

    protected function rules()
    {
        return [
            'input_invoice_date'   => 'nullable|date',
            'input_so'             => 'nullable|string|max:255',
            'input_email'          => 'required|email|max:255',
            'input_contact_person' => 'nullable|string|max:255',
            'input_mobile_number'  => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9()+\-]+$/'
            ],
            'input_address'        => 'nullable|string|max:500',

            'input_sku'            => 'nullable|string|max:255',
            'input_brand_type'     => 'nullable|string|max:255',
            'input_part_number'    => 'nullable|string|max:255',
            'input_serial_number'  => 'nullable|string|max:255',
            
            'input_warranty'       => 'nullable|integer|exists:warranty,id',

            'input_desc'           => 'nullable|string|max:1000',
            'input_problem'        => 'nullable|string|max:1000',
            'input_pre_diagnostic' => 'nullable|string|max:1000',
            'input_add_on'         => 'nullable|string|max:1000',
        ];
    }

    protected function messages()
    {
        return [
            'input_invoice_date.date'    => 'The Invoice Date must be a valid date.',
            'input_email.required'       => 'The Email field is required.',
            'input_email.email'          => 'The Email must be a valid email address.',
            'input_mobile_number.required' => 'The Mobile Number field is required.',
            'input_mobile_number.regex'  => 'The Mobile Number format is invalid.',
            'input_warranty.integer'     => 'The Warranty selection must be a valid number.',
            'input_warranty.exists'      => 'The selected Warranty is invalid.',
        ];
    }


    public function editCustomerData(): void{
        $this->validate();
        
        if($this->input_warranty == null){
            $this->input_warranty = $this->warrantyOptions()->find($this->sl->warranty_status)?->id;
        }

        // dd([
        //     'id'               => $this->id,
        //     'invoice_date'     => $this->input_invoice_date,
        //     'so'               => $this->input_so,
        //     'email'            => $this->input_email,
        //     'contact_person'   => $this->input_contact_person,
        //     'mobile_number'    => $this->input_mobile_number,
        //     'address'          => $this->input_address,
        //     'sku'              => $this->input_sku,
        //     'brand_type'       => $this->input_brand_type,
        //     'part_number'      => $this->input_part_number,
        //     'serial_number'    => $this->input_serial_number,
        //     'warranty'         => $this->input_warranty,
        //     'desc'             => $this->input_desc,
        //     'problem'          => $this->input_problem,
        //     'pre_diagnostic'   => $this->input_pre_diagnostic,
        //     'add_on'           => $this->input_add_on,
        // ]);

        $techlogUpdate = Service_logsModel::find($this->id)->update([
            'alamat' => $this->input_address,
            'mobile_number' => $this->input_mobile_number,
            'email' => $this->input_email,
            'contact_person' => $this->input_contact_person,

            'serial_number' => $this->input_serial_number,
            'part_number' => $this->input_part_number,
            'SKU' => $this->input_sku,
            'brand_type' => $this->input_brand_type,

            'description_product' => $this->input_desc,
            'problem' => $this->input_problem,
            'pre_diagnostic' => $this->input_pre_diagnostic,
            'add_on' => $this->input_add_on,

            'sales_order' => $this->input_so,
            'invoice_date' => $this->input_invoice_date,
            'warranty_status' => $this->input_warranty,
        ]);
        if($techlogUpdate) {
            session()->flash('success', 'Update Berhasil!.');

        }
        else{
            session()->flash('error', 'Register Tidak Berhasil!.');
        }   
        $this->dispatch('open-edit-techlog');
        $this->dispatch('note-crud-done');
        $this->reset('input_warranty');
    }

    public function createNote(){
        // Using find() is more efficient for single record retrieval by primary key.
        $tl_for_create_note = Service_logsModel::find($this->id);

        if (!$tl_for_create_note) {
            session()->flash('error', 'Service log not found.');
            $this->dispatch('close-modal');
            return;
        }

        $noteCreate = NotesModel::create([
            'service_logs_id' => $tl_for_create_note->techlog_id,
            'teknisi_id' => session('user_id'),
            'note_content' => $this->note_specific_update
        ]);
        
        if($noteCreate) {
            session()->flash('success', 'Note created successfully.');
            $this->reset('note_specific_update'); // Reset the note input field
            $this->dispatch('close-modal');
            // Dispatching the event without a payload is more efficient.
            $this->dispatch('note-crud-done');
        } else {
            session()->flash('error', 'Failed to create note.');
        }
    }

    #[On(event: 'note-crud-done')]
    public function noteRefresh()
    {
        // dd($sl);
        // This method can be empty, as the component will re-render
        // and fetch the updated data from the computed properties.
    }

    // Use a computed property for the main service log.
    // This will only run the query once per request.
    #[Computed]
    public function sl()
    {
        return Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')->find($this->id);
    }
    
    // Use a computed property for status update logs with pagination.
    #[Computed]
    public function statusLog()
    {
        if ($this->sl) {
            return Status_updatelogModel::with('status', 'technician')
                ->where('service_logs_id', '=', $this->sl->techlog_id)
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
        if ($this->sl) {
            return NotesModel::with('technician')
                ->where('service_logs_id', '=', $this->sl->techlog_id)
                ->paginate(10);
        }
        // return null;
        return new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
    }

        #[Computed]
    public function warrantyOptions()
    {
        return WarrantyModel::all();
    }

    public function mount(){
    }

    public function render()
    {
        // The render method is now very clean and only passes data from
        // the computed properties to the view.
        
        return view('livewire.ticket-page', [
            'sl' => $this->sl,
            'warranty_ddl' => $this->warrantyOptions,
            'notes' => $this->notes,
            'statusLog' => $this->statusLog
        ])->extends('specific')->section('ticketContent');
    }
}