<div class="flex flex-col w-auto pl-10 pr-10 pb-20 gap-15">
    <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10">
        {{-- Add wire:submit to your form to trigger the createTechlog method --}}
        <form wire:submit.prevent="createTechlog" class="flex flex-col gap-20">
            <div class="flex flex-col gap-10">
                <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                    TECHLOG PROPERTY DATA
                </h1>
                <div class="flex flex-wrap justify-around w-full gap-15 pl-5 pr-5 [&>*]:w-5/12 [&>*]:max-h-fit">
                    <div class="flex flex-col ">
                        <label for="dateIn">
                            Date In
                        </label>
                        <input type="" readonly name="datetimeTo" id="dateIn" value="{{$now}}" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_dateIn') border-red-500 @enderror">
                        @error('input_dateIn')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="salesOrder">
                            Sales Order 
                        </label>
                        <input wire:model="input_salesOrder" type="text" name="salesOrder" id="salesOrder" placeholder="Enter Sales Order..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_salesOrder') border-red-500 @enderror">
                        @error('input_salesOrder')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="invoiceDate">
                            Invoice Date 
                        </label>
                        <input wire:model="input_invoiceDate" type="date" name="invoiceDate" id="invoiceDate" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_invoiceDate') border-red-500 @enderror">
                        @error('input_invoiceDate')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col ">
                        <label for="serviceType">
                            Service Type 
                        </label>
                        <select wire:model="input_serviceType" name="serviceType" id="serviceType" class="w-full bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('input_serviceType') border-red-500 @enderror">
                            <option value="" selected>-- Select Service Type --</option>
                            @foreach($serviceType_ddl as $type)
                                <option value="{{$type->id}}">{{$type->service_type_name}}</option>
                            @endforeach
                        </select>
                        @error('input_serviceType')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <hr class="text-[#FFF1C7] self-center" style="width: 90%;">
                <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                    CUSTOMER DATA
                </h1>
                <div class="flex flex-wrap justify-around w-full gap-15  pl-5 pr-5  [&>*]:w-5/12 [&>*]:max-h-fit">
                    <div class="flex flex-col ">
                        <label for="customerName">
                            Customer Name / Received From
                        </label>
                        <input wire:model="input_customerName" type="text" name="customerName" id="customerName" placeholder="Enter Customer Name..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('input_customerName') border-red-500 @enderror">
                        @error('input_customerName')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="mobileNumber">
                            Mobile Number 
                        </label>
                        <input wire:model="input_mobileNumber" type="text" name="mobileNumber" id="mobileNumber" placeholder="Enter Mobile Number..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_mobileNumber') border-red-500 @enderror">
                        @error('input_mobileNumber')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="email">
                            Email 
                        </label>
                        <input wire:model="input_email" type="text" name="email" id="email" placeholder="Enter Email..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_email') border-red-500 @enderror">
                        @error('input_email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="contactPerson">
                            Contact Person 
                        </label>
                        <input wire:model="input_contactPerson" type="text" name="contactPerson" id="contactPerson" placeholder="Enter Contact Person..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_contactPerson') border-red-500 @enderror">
                        @error('input_contactPerson')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="address">
                            Address 
                        </label>
                        <input wire:model="input_address" type="text" name="address" id="address" placeholder="Enter Address..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_address') border-red-500 @enderror">
                        @error('input_address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <hr class="text-[#FFF1C7] self-center" style="width: 90%;">
                <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                    ITEM DATA
                </h1>
                <div class="flex flex-wrap justify-around w-full gap-15 [&>*]:w-5/12 pl-5 pr-5">
                    <div class="flex flex-col">
                        <label for="sku">
                            SKU 
                        </label>
                        <input wire:model="input_sku" type="text" name="sku" id="sku" placeholder="Enter SKU..." class="bg-gray-50 border  text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_sku') border-red-500 @enderror">
                        @error('input_sku')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col ">
                        <label for="brandType">
                            Brand Type 
                        </label>
                        <input wire:model="input_brandType" type="text" name="brandType" id="brandType" placeholder="Enter Brand Type..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('input_brandType') border-red-500 @enderror">
                        @error('input_brandType')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="partNumber">
                            Part Number 
                        </label>
                        <input wire:model="input_partNumber" type="text" name="partNumber" id="partNumber" placeholder="Enter Part Number..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_partNumber') border-red-500 @enderror">
                        @error('input_partNumber')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="serialNumber">
                            Serial Number 
                        </label>
                        <input wire:model="input_serialNumber" type="text" name="serialNumber" id="serialNumber" placeholder="Enter Serial Number..." class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_serialNumber') border-red-500 @enderror">
                        @error('input_serialNumber')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="warrantyStatus">
                            Waranty Status 
                        </label>
                        <select wire:model="input_warrantyStatus" name="warrantyStatus" id="warrantyStatus" class="w-full bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('input_warrantyStatus') border-red-500 @enderror">
                            <option value="" selected>-- Select Warranty Status --</option>
                            @foreach($warranty_ddl as $w)
                                <option value="{{$w->id}}">{{$w->warranty_status}}</option>
                            @endforeach
                        </select>
                        @error('input_warrantyStatus')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="bg-gray-400 pl-5 pr-5 w-11/12 self-center" style="height: 1px"></div>
                <div class="flex flex-col justify-around w-full gap-15 pl-10 pr-10">
                    <div class="flex flex-col">
                        <label for="problem" class="font-bold">
                            Problem:
                        </label>
                        <textarea wire:model="input_problem" name="problem" id="problem" placeholder="Describe the problem..." class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_problem') border-red-500 @enderror"></textarea>
                        @error('input_problem')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="descriptionProduct" class="font-bold">
                            Description Product: 
                        </label>
                        <textarea wire:model="input_descriptionProduct" name="descriptionProduct" id="descriptionProduct" placeholder="Describe the product..." class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_descriptionProduct') border-red-500 @enderror"></textarea>
                        @error('input_descriptionProduct')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="preDiagnostic" class="font-bold">
                            Pre Diagnostic: 
                        </label>
                        <textarea wire:model="input_preDiagnostic" name="preDiagnostic" id="preDiagnostic" placeholder="Enter pre-diagnostic notes..." class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_preDiagnostic') border-red-500 @enderror"></textarea>
                        @error('input_preDiagnostic')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="addOn" class="font-bold">
                            Add-on: 
                        </label>
                        <textarea wire:model="input_addOn" name="addOn" id="addOn" placeholder="Enter add-on notes..." class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_addOn') border-red-500 @enderror"></textarea>
                        @error('input_addOn')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-col pl-10 pr-10 gap-10 items-center">
                {{-- General Session Messages (Success/Error from form submission) --}}
                @if (session()->has('success'))
                    <div class="w-full pl-10 pr-10" role="alert">
                        <p class="bg-green-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-green-400">
                        Success: <span class="text-green-600 text-lg font-medium">{{ session('success') }}</span>
                        </p>
                    </div>
                @endif

                {{-- Display error message if it exists (e.g., from try-catch) --}}
                @if (session()->has('error'))
                    <div class="w-full pl-10 pr-10" role="alert">
                        <p class="bg-red-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-red-400">
                            Error: <span class="text-red-600 text-lg font-medium">{{ session('error') }}</span>
                        </p>
                    </div>
                @endif

                <button type="submit" class="max-h-fit bg-[#F8971A] hover:opacity-60 w-fit text-white font-medium p-2 pl-10 pr-10 rounded-4xl text-2xl">
                    Confirm
                </button>
            </div>
        </form>
    </div>    

    @script
    <script>
        Livewire.on('open-new-tab', (data) => {
            window.open(data.url, '_blank', 'noopener,noreferrer');
        });
    </script>
    @endscript
</div>