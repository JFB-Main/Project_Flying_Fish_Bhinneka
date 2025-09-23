<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Service_logsModel;
use App\Models\Service_typeModel;
use App\Models\WarrantyModel;
use App\Models\NotesModel;
// use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Carbon\Carbon;
use Illuminate\Support\Str;

// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\JpegEncoder;
// use Intervention\Image\Laravel\Facades\Image;

use Livewire\WithFileUploads;


class CreateTechlog extends Component
{
    use WithFileUploads;

    #[Validate] 

    public $input_file;
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
            'input_file' => 'nullable|image|mimes:jpeg,png,jpg|max:4096', 
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
            'input_email' => 'required|email|max:255',
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
            'input_email.required' => 'The Email must be a valid email address.',
            'input_serialNumber.unique' => 'This Serial Number already exists.',
            // Add more specific messages as needed

            // 'input_file.required' => 'Please select a file to upload.',
            'input_file.image' => 'The file must be an image.',
            'input_file.mimes' => 'Only JPEG, JPG, and PNG images are allowed.',
            'input_file.max' => 'The file must be smaller than 2MB.',

        ];
    }

    #[Computed]
    public function warrantyOptions()
    {
        return WarrantyModel::all();
    }

    /**
     * Computed property to get all service types.
     * This data is only fetched once per request.
     */
    #[Computed]
    public function serviceTypeOptions()
    {
        return Service_typeModel::all();
    }


    public function createTechlog(){
        $this->validate();
        

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

        // $this->input_dateIn = \Carbon\Carbon::now()->format('Y-m-d');

        $invoiceDateValue = !empty($this->input_invoice_date) ? $this->input_invoice_date : null;


        $techlogCreate = Service_logsModel::create([
            'date_in' => Carbon::now()->format('Y-m-d'),
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
            'invoice_date' => $invoiceDateValue,
            'warranty_status' => $this->input_warrantyStatus,
            'service_type' => $this->input_serviceType,

            'create_by' => session('user_id'),

        ]);
        if($techlogCreate) {
            // //File Image upload
            // if ($this->input_file) {
            //     // Store the file in the 'uploads' directory on the 'public' disk
            //     $tl_id = Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')->find($techlogCreate->id); 
            //     // dd($tl_id->techlog_id);

            //     // Get the original file extension
            //     $extension = $this->input_file->getClientOriginalExtension();

            //     // Generate a unique, random filename to prevent collisions
            //     $newFileName = Str::uuid() . '.' . $extension;

            //     $this->input_file->storeAs('image_uploads', $newFileName, 'public');

            //     $path = $this->input_file->storeAs('image_uploads', $newFileName, 'public');
            //     // dd($path);
                
            //     NotesModel::create([
            //     'service_logs_id' => $tl_id->techlog_id,
            //     'teknisi_id' => session('user_id'),
            //     'note_content' => 'FILE YANG TERUPLOAD PADA PEMBUATAN TECHLOG',
            //     'image_path' => $path
            //      ]);
                
            // }

            // if ($this->input_file) {
            //     // Get the uploaded file instance
            //     $imageFile = $this->input_file;

            //     // Get the original file's mime type and extension
            //     $mimeType = $imageFile->getMimeType();
            //     $extension = $imageFile->getClientOriginalExtension();

            //     // Generate a unique, random filename
            //     $newFileName = Str::uuid() . '.' . $extension;

            //     // Use Intervention Image to process the file
            //     $img = Image::make($imageFile);

            //     // Determine the path and initial quality
            //     $path = 'public/image_uploads/' . $newFileName;
            //     $quality = 90;

            //     // --- Compression Logic based on File Type ---
            //     if ($mimeType == 'image/jpeg' || $extension == 'jpg') {
            //         // For JPEGs, use the quality loop to optimize size
            //         Storage::put($path, $img->encode('jpg', $quality));

            //         while (Storage::size($path) > 200 * 1024 && $quality > 10) {
            //             $quality -= 5;
            //             Storage::put($path, $img->encode('jpg', $quality));
            //         }
            //     } elseif ($mimeType == 'image/png' || $extension == 'png') {
            //         // For PNGs, use a different compression method. 
            //         // Intervention Image's `encode('png', ...)` uses a compression level (0-9)
            //         // instead of a quality setting.
            //         $compressionLevel = 8;
            //         Storage::put($path, $img->encode('png', $compressionLevel));

            //         while (Storage::size($path) > 200 * 1024 && $compressionLevel < 9) {
            //             $compressionLevel++;
            //             Storage::put($path, $img->encode('png', $compressionLevel));
            //         }
            //     } else {
            //         // Fallback for other file types
            //         $img->save(storage_path('app/' . $path));
            //     }

            //     // --- Database Entry (unmodified) ---
            //     $tl_id = Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')->find($techlogCreate->id); 

            //     NotesModel::create([
            //         'service_logs_id' => $tl_id->techlog_id,
            //         'teknisi_id' => session('user_id'),
            //         'note_content' => 'FILE YANG TERUPLOAD PADA PEMBUATAN TECHLOG',
            //         'image_path' => $path
            //     ]);
            // }


            if ($this->input_file) {
                $imageFile = $this->input_file;
                $extension = $imageFile->getClientOriginalExtension();
                $newFileName = Str::uuid() . '.' . $extension;
                $relativePath = 'image_uploads/' . $newFileName;
                $targetSizeKB = 200; //200KB

                $currentScale = 1.0; // Start with 100% of the original size
                $step = 0.05; // Decrease the scale by 5% in each iteration
                $loopCounter = 0; // A counter to prevent an infinite loop

                $manager = new ImageManager(new Driver());
                $img = $manager->read($imageFile->getRealPath());

                switch (strtolower($extension)) {
                    // This syntax requires Intervention/Image v3.x and its Laravel v3.x package
                    case 'jpeg':
                    case 'jpg':
                        $quality = 90;
                        do {
                            // This syntax is for the JPG/JPEG version
                            $encodedImage = $img->toJpeg(quality: $quality);
                            Storage::disk('public')->put($relativePath, $encodedImage);
                            $quality -= 5;
                        } while (Storage::disk('public')->size($relativePath) > $targetSizeKB * 1024 && $quality > 10);
                        break;

                    case 'png':
                        $originalWidth = $img->width();
                        $originalHeight = $img->height();

                        $colors = 256; 
                        $currentScale = 1.0;
                        $step_resize = 0.05; // Decrease the scale by 5% in each iteration
                        $step = 16; // The number of colors to remove in each iteration
                        $loopCounter = 0; // A counter to prevent an infinite loop
                        // $compressionLevel = 8;   
                        // do {
                        //     // This syntax is for the PNG version
                        //     $encodedImage = $img->encode(new PngEncoder());
                        //     Storage::disk('public')->put($relativePath, $encodedImage);
                        //     $compressionLevel++;
                        // } while (Storage::disk('public')->size($relativePath) > $targetSizeKB * 1024 && $compressionLevel <= 9);

                        do {
                            // Resize the image.
                            $img->resize($originalWidth * $currentScale, $originalHeight * $currentScale);

                            $img->reduceColors($colors);

                            // Encode the resized image to PNG and get its byte data
                            $encodedImage  = $img->toPng();

                            // Check the size of the encoded data
                            $fileSize = strlen($encodedImage);

                            // Decrease the scale for the next iteration
                            $colors -= $step;
                            $currentScale -= $step_resize;
                            $loopCounter++;

                            // Add a condition to prevent an infinite loop
                            if ($loopCounter > 15 || $colors <= 2 || $currentScale < 0.1) {
                                break;
                            }
                        } while ($fileSize > ($targetSizeKB*1024));

                        Storage::disk('public')->put($relativePath, $encodedImage);

                        break;

                    default:
                        $encodedImage = $img->encode();
                        Storage::disk('public')->put($relativePath, $encodedImage);
                        break;
                }


                    $tl_id = Service_logsModel::with('user', 'status', 'serviceId', 'warranty_bind')->find($techlogCreate->id); 
                    NotesModel::create([
                        'service_logs_id' => $tl_id->techlog_id,
                        'teknisi_id' => session('user_id'),
                        'note_content' => 'FILE YANG TERUPLOAD PADA PEMBUATAN TECHLOG',
                        'image_path' => $relativePath
                    ]);
                }

            session()->flash('success', 'Register Berhasil!.');
            $this->dispatch('crud-done');
            
            // Dispatch event to open the ReceiptForm in a new tab
            $receiptUrl = route('receiptForm', ['id' => $techlogCreate->id]); // Use the newly created log's primary ID
            $this->dispatch('open-new-tab', url: $receiptUrl);

            $this->reset('input_file'); 
            $this->reset(); 
        }
        else{
            session()->flash('error', 'Register Tidak Berhasil!.');
        }   
    }

    public function render(){



        return view('livewire.create-techlog',[
            'warranty_ddl' => $this->warrantyOptions,
            'serviceType_ddl' => $this->serviceTypeOptions,
            'now' => Carbon::now()->format('Y-m-d')
        ])->extends('specific')->section('createContent');
    }
}
