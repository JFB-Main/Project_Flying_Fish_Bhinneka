<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Service_logsModel;
use App\Models\Service_typeModel;
use App\Models\WarrantyModel;


class CreateTechlog extends Component
{
    #[Validate] 
    public $input_dateIn = null;
    public $input_salesOrder = '';
    public $input_invoiceDate = null;
    public $input_serviceType = ''; 
    public $input_customerName = '';
    public $input_mobileNumber = '';
    public $input_email = '';
    public $input_contactPerson = '';
    public $input_address = '';
    public $input_sku = '';
    public $input_brandType = '';
    public $input_partNumber = '';
    public $input_serialNumber = '';
    public $input_warrantyStatus = ''; 
    public $input_problem = '';
    public $input_descriptionProduct = '';
    public $input_preDiagnostic = '';
    public $input_addOn = '';

    protected function rules()
    {
        return [
            // 'input_dateIn' => 'required|date',
            'input_salesOrder' => 'nullable|string|max:255',
            'input_invoiceDate' => 'nullable|date', 
            'input_serviceType' => 'required|integer|exists:service_type,id',

            'input_customerName' => 'required|string|max:255',
            'input_mobileNumber' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9()+\-]+$/'
            ],
            'input_email' => 'nullable|email|max:255',
            'input_contactPerson' => 'nullable|string|max:255',
            'input_address' => 'nullable|string|max:500',

            'input_sku' => 'nullable|string|max:255',
            'input_brandType' => 'nullable|string|max:255',
            'input_partNumber' => 'nullable|string|max:255',
            // 'input_serialNumber' => 'nullable|string|max:255|unique:service_logs,serial_number',
            'input_serialNumber' => 'nullable|string|max:255',
            'input_warrantyStatus' => 'nullable|integer',
            
            'input_problem' => 'nullable|string|max:1000',
            'input_descriptionProduct' => 'nullable|string|max:1000',
            'input_preDiagnostic' => 'nullable|string|max:1000',
            'input_addOn' => 'nullable|string|max:1000',
        ];
    }

        protected function messages()
    {
        return [
            // 'input_dateIn.required' => 'The Date In field is required.',
            'input_dateIn.date' => 'The Date In must be a valid date.',
            'input_serviceType.required' => 'The Service Type is required.',
            'input_serviceType.integer' => 'The Service Type must be a valid selection.',
            'input_serviceType.exists' => 'The selected Service Type is invalid.',
            'input_customerName.required' => 'The Customer Name field is required.',
            'input_mobileNumber.required' => 'The Mobile Number field is required.',
            'input_email.email' => 'The Email must be a valid email address.',
            'input_serialNumber.unique' => 'This Serial Number already exists.',
            // Add more specific messages as needed
        ];
    }



    public function createTechlog(){
        $validatedData = $this->validate();
        

        // dd(
        //     'Date In:', $this->input_dateIn,
        //     'Sales Order:', $this->input_salesOrder,
        //     'Invoice Date:', $this->input_invoiceDate,
        //     'Service Type:', $this->input_serviceType,
        //     'Customer Name:', $this->input_customerName,
        //     'Mobile Number:', $this->input_mobileNumber,
        //     'Email:', $this->input_email,
        //     'Contact Person:', $this->input_contactPerson,
        //     'Address:', $this->input_address,
        //     'SKU:', $this->input_sku,
        //     'Brand Type:', $this->input_brandType,
        //     'Part Number:', $this->input_partNumber,
        //     'Serial Number:', $this->input_serialNumber,
        //     'Warranty Status:', $this->input_warrantyStatus,
        //     'Problem:', $this->input_problem,
        //     'Description Product:', $this->input_descriptionProduct,
        //     'Pre Diagnostic:', $this->input_preDiagnostic,
        //     'Add-on:', $this->input_addOn
        // );

        $this->input_dateIn = \Carbon\Carbon::now()->format('Y-m-d');

        $techlogCreate = Service_logsModel::create([
            'date_in' => $this->input_dateIn,
            'received_from' => $this->input_customerName,
            'alamat' => $this->input_address,
            'mobile_number' => $this->input_mobileNumber,
            'email' => $this->input_email,
            'contact_person' => $this->input_contactPerson,

            'serial_number' => $this->input_serialNumber,
            'part_number' => $this->input_partNumber,
            'SKU' => $this->input_sku,
            'brand_type' => $this->input_brandType,

            'description_product' => $this->input_descriptionProduct,
            'problem' => $this->input_problem,
            'pre_diagnostic' => $this->input_preDiagnostic,
            'add_on' => $this->input_addOn,

            'sales_order' => $this->input_salesOrder,
            'invoice_date' => $this->input_invoiceDate,
            'warranty_status' => $this->input_warrantyStatus,
            'service_type' => $this->input_serviceType,

            'create_by' => session('user_id'),

        ]);
        if($techlogCreate) {
            session()->flash('success', 'Register Berhasil!.');
            $this->dispatch('crud-done', $techlogCreate);
            
            // Dispatch event to open the ReceiptForm in a new tab
            $receiptUrl = route('receiptForm', ['id' => $techlogCreate->id]); // Use the newly created log's primary ID
            $this->dispatch('open-new-tab', url: $receiptUrl);
        }
        else{
            session()->flash('error', 'Register Tidak Berhasil!.');
        }   
    }

    public function render(){

        $warranty_ListDDL = WarrantyModel::all();
        $ServiceType_ListDDL = Service_typeModel::all();
        $now = \Carbon\Carbon::parse(now())->format('Y-m-d');

        return view('livewire.create-techlog',[
            'warranty_ddl' => $warranty_ListDDL,
            'serviceType_ddl' => $ServiceType_ListDDL,
            'now' => $now
        ])->extends('specific')->section('createContent');
    }
}
