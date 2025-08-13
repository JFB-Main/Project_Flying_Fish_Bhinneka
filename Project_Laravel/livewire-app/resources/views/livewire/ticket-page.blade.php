@php
    
    if ($sl) {
        $statusMainCol = match($sl->status_id) {
            1 => 'bg-[#888080]', 
            2 => 'bg-[#FF9F17]', 
            3 => 'bg-[#D516A4]', 
            4 => 'bg-[#C547F6]', 
            5 => 'bg-[#1A96FF]', 
            6 => 'bg-[#1CA717]', 
            7 => 'bg-[#D40000]', 
            8 => 'bg-[#1657FF]', 
            default => 'bg-gray-400', 
        };

        $statusMainLabel = match($sl->status_id) {
            1 => 'Open',
            2 => 'On Progress',
            3 => 'Pending',
            4 => 'RMA To Vendor',
            5 => 'On-QC',
            6 => 'Completed',
            7 => 'Canceled',
            8 => 'Returned',
            default => 'N/A',
        };
    }
@endphp

<div class="flex flex-col w-auto pl-10 pr-10 pb-10 gap-10 max-md:px-5">
    {{-- @forelse ($notes as $n)
    {{$n->id}}     {{$n->note_conte}}
    @empty
    no data
    @endforelse --}}
    {{-- adad {{$id}} --}}
    <div class="flex flex-col border justify-center border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 pl-5 pr-5 w-full">
        @if ($sl)
            <div class="flex flex-row gap-1">
                <div class="flex flex-row w-full gap-3 justify-center max-xl:[&_div_*]:text-2xl max-lg:[&_div_*]:text-xl max-md:flex-col max-md:items-center">
                    <div class="flex flex-row gap-2">
                        <h1 class="text-3xl text-[#302714] font-bold">
                            TECHLOG:&nbsp;
                        </h1>
                        <h1 class="text-[#302714] text-3xl">{{$sl->techlog_id}}</h1>
                         {{-- <div class="bg-[#F8971A]" style="width: 2px;"></div> --}}
                    </div>
                    <div class="bg-[#F8971A] w-[2px] max-md:w-full"></div>
                    <div class="flex flex-row items-center gap-2">
                        <div class="flex justify-center text-white p-1 pl-2 pr-2 rounded-4xl {{$statusMainCol}}">
                            <p>{{$statusMainLabel}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-amber-400 pl-5 pr-5 w-full" style="height: 1px"></div>
            <form wire:submit.prevent="editCustomerData()"
                    class="flex flex-col">
                <div class="flex flex-col gap-7 max-xl:[&_div_div]:w-full max-xl:[&_div_div]:text-[12px] max-xl:[&_div_div_h1]:text-lg max-lg:[&_div_div_h1]:text-base max-lg:[&_div_div_p]:text-[10px]
                            max-md:[&_div]:flex-wrap max-md:[&_div_div]:justify-start max-md:overflow-x-scroll">
                    <div class="flex flex-col gap-10 ">
                        <div class="flex flex-row w-full gap-1 pl-5">
                            <div class="bg-[#F8971A]" style="width: 4px"></div>
                            <div class="flex flex-row gap-2">
                                <h1 class="text-2xl text-[#302714] font-bold">
                                    Techlog Property
                                </h1>
                                    @if (session('role') == 1 || session('role') == 2 )
                                        <div class="bg-[#F8971A]" style="width: 2px;"></div>
                                        <button x-data = "{ show: false }"
                                            x-on:open-edit-techlog.window="show = !show"
                                            type="submit"
                                            class="hidden max-w-fit text-white font-bold cursor-pointer px-4 py-1 rounded-2xl hover:opacity-60 bg-[#F8971A]"
                                            :class="{ 'bg-[#F8971A] inline': show }">
                                        Done
                                        </button>
                                        <button x-data = "{ show: false }"
                                                x-on:open-edit-techlog.window="show = !show"
                                                x-on:click="$dispatch('open-edit-techlog')"
                                                type="button"
                                                class="max-w-fit text-white font-bold cursor-pointer px-4 py-1 rounded-2xl hover:opacity-60 bg-[#F8971A]"
                                                :class="{ 'bg-red-600': show }"
                                                x-text="show ? 'Cancel' : 'Edit Data'">
                                        </button>
                                        @if (session()->has('success'))
                                                <p class="font-semibold text-base">
                                                Success: <span class="text-green-600 text-lg font-medium">{{ session('success') }}</span>
                                                </p>
                                        @endif

                                        @if (session()->has('error'))
                                                <p class="font-semibold text-base">
                                                    Error: <span class="text-red-600 text-lg font-medium">{{ session('error') }}</span>
                                                </p>
                                        @endif
                                    @endif
                            </div>
                        </div>

                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        <div x-data = "{ show: false }"
                            x-on:open-edit-techlog.window="show = !show"
                            class="hidden w-full"
                            :class="{ 'inline-flex': show }">
                            <div class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:flex-row [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5 ">
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Date In
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{$sl->date_in}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <label for="input-invoice_date" class="" style=>
                                            Invoice Date<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-invoice_date">
                                            :
                                        </label>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <input id="input-invoice_date"
                                                wire:model.fill="input_invoice_date"
                                                type="date" 
                                                value="{{$sl->invoice_date}}"
                                                class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2 @error('input_invoice_date') border-red-500 @enderror"
                                                >
                                        </input>
                                        @error('input_invoice_date')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Completed Date
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{$sl->completed_date}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Return Date
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{$sl->return_date}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Service Type
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{$sl->serviceId ? $sl->serviceId->service_type_name: 'N/A'}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Created By
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{ucwords($sl->create_by ? $sl->user->username: 'N/A')}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <label for="input-SO" class="" style=>
                                            Sales order<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-so">
                                            :
                                        </label>
                                    </div>
                                    <input id="input-SO"
                                            wire:model.fill="input_so"
                                            type="text" 
                                            class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2" 
                                            value="{{$sl->sales_order}}">
                                    </input>
                                </div>
                            </div>
                        </div>
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}

                        <div x-data = "{ show: false }"
                            x-on:open-edit-techlog.window="show = !show"
                            class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:flex-row [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5 "
                            :class="{ 'hidden': show }">
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Date In
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->date_in}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Invoice Date
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->invoice_date}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Completed Date
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->completed_date}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Return Date
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->return_date}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Service Type
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->serviceId ? $sl->serviceId->service_type_name: 'N/A'}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Created By
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{ucwords($sl->create_by ? $sl->user->username: 'N/A')}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Sales order
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->sales_order}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-400 pl-5 pr-5 w-full" style="height: 1px"></div>
                        <div class="flex flex-col gap-10">
                            <div class="flex flex-row w-full gap-1 pl-5">
                                <div class="bg-[#F8971A]" style="width: 4px"></div>
                                <div class="flex flex-row gap-2">
                                    <h1 class="text-2xl text-[#302714] font-bold">
                                        Customer Property
                                    </h1>
                                </div>
                            </div>

                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                            <div x-data = "{ show: false }"
                                x-on:open-edit-techlog.window="show = !show"
                                class="hidden w-full"
                                :class="{ 'inline-flex': show }">
                                <div class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:flex-row [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5">
                                    <div class="gap-3 flex flex-row max-md:flex-col">
                                        <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                            <p class="" for="input-received_from">
                                                Received From
                                            </p>
                                            <p>
                                                :
                                            </p>
                                        </div>
                                        <p class="w-full">
                                            {{$sl->received_from}}
                                        </p>
                                    </div>
                                    <div class="gap-3 flex flex-row">
                                        <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                            <label class="" for="input-email">
                                                Email<span class="text-amber-500">*</span>
                                            </label>
                                            <label for="input-email">
                                                :
                                            </label>
                                        </div>
                                        <div class="flex flex-col w-full">
                                            <input id="input-email"
                                                    wire:model.fill="input_email"
                                                    type="email" 
                                                    class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2 @error('input_email') border-red-500 @enderror" 
                                                    value="{{$sl->email}}">
                                            </input>
                                            @error('input_email')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="gap-3 flex flex-row">
                                        <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                            <label class="" for="input-contact_person">
                                                Contact Person<span class="text-amber-500">*</span>
                                            </label>
                                            <label for="input-contact_person">
                                                :
                                            </label>
                                        </div>
                                        <input id="input-contact_person" 
                                                wire:model.fill="input_contact_person"
                                                class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2" 
                                                value="{{$sl->contact_person}}">
                                        </input>
                                    </div>
                                    <div class="gap-3 flex flex-row">
                                        <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                            <label class="" for="input-mobile_number">
                                                Mobile Number<span class="text-amber-500">*</span>
                                            </label>
                                            <label for="input-mobile_number">
                                                :
                                            </label>
                                        </div>
                                        <div class="flex flex-col w-full">
                                            <input id="input-mobile_number" 
                                                    wire:model.fill="input_mobile_number"
                                                    class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2 @error('input_mobile_number') border-red-500 @enderror" 
                                                    value="{{$sl->mobile_number}}">
                                            </input>
                                            @error('input_mobile_number')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="gap-3 flex flex-row">
                                        <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                            <label class="" for="input-address">
                                                Address<span class="text-amber-500">*</span>
                                            </label>
                                            <label for="input-address">
                                                :
                                            </label>
                                        </div>
                                        <textarea wire:model.fill="input_address" id="input-address" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2">{{$sl->alamat}}</textarea>
                                    </div>
                                </div>
                            </div>
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}

                            <div x-data = "{ show: false }"
                                x-on:open-edit-techlog.window="show = !show"
                                class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:flex-row [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5"
                                :class="{ 'hidden': show }">
                                <div class="gap-3 flex flex-row max-md:flex-col">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Received From
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{$sl->received_from}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Email
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{$sl->email}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Contact Person
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                    {{$sl->contact_person}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Mobile Number
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{$sl->mobile_number}}
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Address
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="content-baseline w-full">
                                        {{$sl->alamat}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="bg-gray-400 pl-5 pr-5 w-full" style="height: 1px"></div>

                    <div class="flex flex-col gap-10">
                        <div class="flex flex-row w-full gap-1 pl-5">
                            <div class="bg-[#F8971A]" style="width: 4px"></div>
                            <div class="flex flex-row gap-2">
                                <h1 class="text-2xl text-[#302714] font-bold">
                                    Item Property
                                </h1>
                            </div>
                        </div>

                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        <div x-data = "{ show: false }"
                            x-on:open-edit-techlog.window="show = !show"
                            class="hidden w-full"
                            :class="{ 'inline-flex': show }"
                            >
                            <div class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5">
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <label for="input-sku" class="" for="input-contact_person">
                                            SKU<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-contact_person">
                                            :
                                        </label>
                                    </div>
                                    <input id="input-sku" 
                                        wire:model.fill="input_sku"
                                        class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2" 
                                        value="{{$sl->SKU}}">
                                    </input>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <label for="input-brand_type" class="" for="input-contact_person">
                                            Brand Type<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-brand_type">
                                            :
                                        </label>
                                    </div>
                                    <input id="input-brand_type" 
                                        wire:model.fill="input_brand_type"
                                        class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2" 
                                        value="{{$sl->brand_type}}">
                                    </input>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <label for="input-part_number" class="" for="input-contact_person">
                                            Part Number<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-part_number">
                                            :
                                        </label>
                                    </div>
                                    <input id="input-part_number" 
                                        wire:model.fill="input_part_number"
                                        class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2" 
                                        value="{{$sl->part_number}}">
                                    </input>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <label for="input-serial_number" class="" for="input-contact_person">
                                            Serial Number<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-serial_number">
                                            :
                                        </label>
                                    </div>
                                    <input id="input-serial_number" 
                                        wire:model.fill="input_serial_number"
                                        class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2" 
                                        value="{{$sl->serial_number}}">
                                    </input>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <label for="input-warranty" class="" for="input-contact_person">
                                            Warranty Status<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-warranty">
                                            :
                                        </label>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <select wire:model.fill="input_warranty" name="warrantyStatus" id="warrantyStatus" 
                                                class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_warranty') border-red-500 @enderror">
                                            <option value="" selected>-- Click To Change --</option>
                                            @foreach($warranty_ddl as $w)
                                                <option value="{{$w->id}}">{{$w->warranty_status}}</option>
                                            @endforeach
                                        </select>
                                        @error('input_warranty')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                        <p class="" style=>
                                            Part Ready
                                        </p>
                                        <p>
                                            :
                                        </p>
                                    </div>
                                    <div class="w-full">
                                        {{$sl->part_ready}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}

                        <div x-data = "{ show: false }"
                            x-on:open-edit-techlog.window="show = !show"
                            :class="{ 'hidden': show }"
                            class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5">
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        SKU
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->SKU}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Brand Type
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->brand_type}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Part Number
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->part_number}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Serial Number
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->serial_number}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Warranty Status
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->warranty_bind ? $sl->warranty_bind->warranty_status: 'N/A'}}
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-full justify-between" style="max-width: 100%">
                                    <p class="" style=>
                                        Part Ready
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full">
                                    {{$sl->part_ready}}
                                </div>
                            </div>
                        </div>

                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- BELOW IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        <div x-data = "{ show: false }"
                            x-on:open-edit-techlog.window="show = !show"
                            class="hidden w-full"
                            :class="{ 'inline-flex': show }"
                            >
                            <div class="flex flex-col w-full gap-7 pl-5 pr-5">
                                <div class="bg-gray-400 pl-5 pr-5 w-full" style="height: 1px"></div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-1/5 justify-between" >
                                        <label for="input-desc" class="" style=>
                                            Description Product<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-desc">
                                            :
                                        </label>
                                    </div>
                                    <textarea id="input-desc" wire:model.fill="input_desc" class="w-full border focus:min-h-50 bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">{{$sl->description_product}}</textarea>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-1/5 justify-between" >
                                        <label for="problem" class="" style=>
                                            Problem<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="problem">
                                            :
                                        </label>
                                    </div>
                                    <textarea id="input-problem" wire:model.fill="input_problem" class="w-full border focus:min-h-50 bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">{{$sl->problem}}</textarea>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-1/5 justify-between" >
                                        <label for="diagnostic" class="" style=>
                                            Pre-diagnostic<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="diagnostic">
                                            :
                                        </label>
                                    </div>
                                    <textarea id="input-diagnostic" wire:model.fill="input_pre_diagnostic" class="w-full border focus:min-h-50 bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">{{$sl->pre_diagnostic}}</textarea>
                                </div>
                                <div class="gap-3 flex flex-row">
                                    <div class="[&>*]:font-semibold flex flex-row w-1/5 justify-between" >
                                        <label for="input-add_on" class="" style=>
                                            Add-on<span class="text-amber-500">*</span>
                                        </label>
                                        <label for="input-add_on" >
                                            :
                                        </label>
                                    </div>
                                    <textarea id="input-add_on" wire:model.fill="input_add_on" class="w-full border focus:min-h-50 bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">{{$sl->add_on}}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}
                        {{-- ABOVE IS RESERVED FOR TECHLOG DATA EDIT FORM SUBMISSION --}}

                        <div x-data = "{ show: false }"
                            x-on:open-edit-techlog.window="show = !show"
                            :class="{ 'hidden': show }"
                            class="flex flex-col w-full gap-7 pl-5 pr-5"
                            >
                            <div class="bg-gray-400 pl-5 pr-5 w-full" style="height: 1px"></div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-1/5 justify-between" >
                                    <p class="" style=>
                                        Description Product
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                                    <p>
                                        {{$sl->description_product}}
                                    </p>
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-1/5 justify-between">
                                    <p class="" style=>
                                        Problem
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                                    <p>
                                        {{$sl->problem}}
                                    </p>
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-1/5 justify-between">
                                    <p class="" style=>
                                        Pre-diagnostic
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                                    <p>
                                        {{$sl->pre_diagnostic}}
                                    </p>
                                </div>
                            </div>
                            <div class="gap-3 flex flex-row">
                                <div class="[&>*]:font-semibold flex flex-row w-1/5 justify-between">
                                    <p class="" style=>
                                        Add-on
                                    </p>
                                    <p>
                                        :
                                    </p>
                                </div>
                                <div class="w-full border bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                                    <p>
                                        {{$sl->add_on}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col">

                    </div>
                </div>
            </form>
        @endif
    </div>
    <div>
    </div>
    {{-- <table class="w-full table-auto min-w-screen max-w-full">
        <thead class="bg-gray-100 ">
            <tr class="">
                <th class="text-left p-2">Techlog ID</th>
                <th class="text-left p-2">Status</th>
                <th class="text-left p-2">Date In</th>
                <th class="text-left p-2">Service Type</th>
                <th class="text-left p-2">Received From</th>
                <th class="text-left p-2">Contact</th>
                <th class="text-left p-2">Phone</th>
                <th class="text-left p-2">SN</th>
                <th class="text-center p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($sl)
                <tr class="border-t">
                    <td class="p-2">
                        <a class="cursor-pointer text-indigo-500 underline hover:text-indigo-700">
                        {{ $sl->techlog_id }}
                        </a>
                    </td>

                    <td class="p-2">
                        @php
                            $statusType = $sl->status ? $sl->status->status_type : 'N/A';
                            $statusClass = '';
                            $color_map = [
                                'Open' => 'bg-[#AEAAAA]',
                                'On Progress' => 'bg-[#FFB55B]',
                                'Pending' => 'bg-[#DA56B8]',
                                'RMA to Vendor' => 'bg-[#D094F6]',
                                'On-QC' => 'bg-[#68B0FF]',
                                'Completed' => 'bg-[#6EBA5C]',
                                'Canceled' => 'bg-[#DA5658]',
                                'Returned to Client' => 'bg-[#5993FF]',
                                
                                ];

                            $statusClass = $color_map[$statusType] ?? 'bg-gray-500-italic';
                        @endphp
                        <span class="{{ $statusClass }} text-white p-1 pl-2 pr-2 rounded-4xl">
                            {{ $statusType }}
                        </span>
                    </td>
                    <td class="p-2">{{ $sl->date_in }}</td>
                    <td class="p-2">{{ $sl->serviceId ? $sl->serviceId->service_type_name : 'N/A' }}</td>
        
                    <td class="p-2">{{ $sl->received_from }}</td>
                    <td class="p-2">{{ $sl->contact_person }}</td>
                    <td class="p-2">{{ $sl->mobile_number }}</td>
                    <td class="p-2">{{ $sl->serial_number }}</td>
                </tr>
            @endif
        </tbody>
    </table>     --}}
    <div class="flex flex-col border justify-center border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 w-full pl-5 pr-5">
        <div class="flex flex-row w-full gap-1 pl-5">
            <div class="bg-[#F8971A]" style="width: 4px"></div>
            <div class="flex flex-row gap-2">
                <h1 class="text-2xl max-xl:text-xl max-lg:text-lg text-[#302714] font-bold">
                    Status Update Log
                </h1>
            </div>
        </div>
        <div class="flex flex-col overflow-x-scroll rounded-b-2xl">
            <table class="w-full table-auto min-w-screen max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px]">
                <thead class="bg-gray-200 border-t border-gray-200 pl-3">
                    <tr class="gap-3">
                        <th class="text-left p-2" style="width: 50px;">ID</th>
                        {{-- <th class="text-left p-2" style="width: 10%;">Techlog ID</th> --}}
                        <th class="text-left p-2" style="width: 200px;">Status</th>
                        <th class="text-left p-2" style="width: 10%;">Created By</th>
                        <th class="text-left p-2" style="width: 10%;">Created At</th>
                        <th class="text-left p-2" style="max-width: 100px">Note Content</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($statusLog as $s)
                        <tr class="border-t">
                            <td class="p-2 pt-5 pb-5 ">{{ $s->id }}</td>
                            {{-- <td class="p-2 ">{{ $s->service_logs_id }}</td> --}}
                            <td class="p-2 pt-5 pb-5 ">
                                @php
                                    $statusType = $s->status ? $s->status->status_type : 'N/A';
                                    $statusClass = ''; // Default empty class
                                    $color_map = [
                                        'Open' => 'bg-[#AEAAAA]',
                                        'On Progress' => 'bg-[#FFB55B]',
                                        'Pending' => 'bg-[#DA56B8]',
                                        'RMA to Vendor' => 'bg-[#D094F6]',
                                        'On-QC' => 'bg-[#68B0FF]',
                                        'Completed' => 'bg-[#6EBA5C]',
                                        'Canceled' => 'bg-[#DA5658]',
                                        'Returned to Client' => 'bg-[#5993FF]',
                                        
                                        //....
                                        ];

                                    $statusClass = $color_map[$statusType] ?? 'bg-gray-500-italic';
                                @endphp
                                
                                <span class="{{ $statusClass }} text-white p-1 pl-2 pr-2 rounded-4xl">
                                     {{ $s->status_id  ? $s->status->status_type : 'N/A'}}
                                </span>
                            </td>
                            <td class="p-2 ">{{ $s->teknisi_id ? $s->technician->username : 'N/A' }}</td>
                            <td class="p-2 ">{{ $s->created_at }}</td>
                            <td class="p-2 ">{{ $s->status_note }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">No notes found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-10">
            {{$statusLog->links('vendor.livewire.tailwind')}}
        </div>
    </div>


    <div class="flex flex-col border justify-center border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 w-full pl-5 pr-5">
        <div class="flex flex-row w-full gap-3 pl-5 
                    max-xl:items-center max-xl:[&>*]:text-[12px] max-xl:[&>button]:py-1 max-xl:[&_div_button]:py-1 max-lg:[&>button]:text-[10px] max-lg:[&_div_button]:text-[10px]">
            <div class="flex flex-row w-fit gap-1">
                <div class="bg-[#F8971A]" style="width: 4px"></div>
                <div class="flex flex-row gap-2">
                    <h1 class="text-2xl max-xl:text-xl max-lg:text-lg text-[#302714] font-bold">
                        Notes
                    </h1>
                </div>
            </div>
            <button type="button" x-on:click="$dispatch('open-modal', {name: 'note+'})" class="max-h-fit bg-[#F8971A] hover:opacity-60 w-fit text-white font-medium p-1 pl-3 pr-3 rounded-4xl">
                New Notes +
            </button>
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="flex flex-col overflow-x-scroll rounded-b-2xl">
            <table class="w-full table-auto min-w-screen max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px]">
                <thead class="bg-gray-200 border-t border-gray-200 pl-3">
                    <tr class="gap-3">
                        <th class="text-left p-2" style="width: 50px;">ID</th>
                        {{-- <th class="text-left p-2" style="width: 10%;">Techlog ID</th> --}}
                        <th class="text-left p-2" style="width: 10%;">Created By</th>
                        <th class="text-left p-2" style="width: 10%;">Created At</th>
                        <th class="text-left p-2" style="max-width: 100px">Note Content</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notes as $n)
                        <tr class="border-t">
                            <td class="p-2 pt-5 pb-5 ">{{ $n->id }}</td>
                            {{-- <td class="p-2 ">{{ $n->service_logs_id }}</td> --}}
                            <td class="p-2 ">{{ $n->teknisi_id ? $n->technician->username : 'N/A' }}</td>
                            <td class="p-2 ">{{ $n->created_at }}</td>
                            <td class="p-2 ">{{ $n->note_content }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">No notes found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-modal-NoteCreate name="note+" title="Test">
        </x-modal-NoteCreate>
        <div class="p-10">
            {{$notes->links('vendor.livewire.tailwind')}}
        </div>
    </div>
</div>
