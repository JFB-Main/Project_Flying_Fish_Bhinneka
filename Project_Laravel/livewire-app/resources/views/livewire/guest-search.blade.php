@php
    
    if ($service_log) {
        $statusMainCol = match($service_log->status_id) {
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

        $statusMainLabel = match($service_log->status_id) {
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

<div class="flex flex-col w-auto pl-10 pr-10 pb-10 gap-15 max-md:px-5">
    
    <style>
        /* Define the animation for the background */
        @keyframes gradient-rotate {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* @keyframes rotateAnimation {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        } */

        #animated-gradient-text {
            /* bg-gradient-to-t from-amber-300 via-[#ff8c00] to-purple-600 text-transparent bg-clip-text */

            background-image: linear-gradient(to right, #fcd34d, #ff8c00, #9333ea, #fcd34d);
            background-size: 200% 100%;
            

            -webkit-background-clip: text;
            background-clip: text;
            
            
            color: transparent;

            animation: gradient-rotate 8s ease infinite;
        }
    </style>


    <div class="flex flex-col border min-h-screen border-amber-300 bg-white py-15 px-10 rounded-4xl gap-10 shadow-lg
                max-md:px-5">
        <div class="flex flex-col gap-7 shadow-md -mx-10 pb-10 max-md:-mx-5">
            <p class="w-fit h-fit py-2 self-center text-6xl font-semibold bg-gradient-to-t from-orange-400 to-gray-900 text-transparent bg-clip-text text-center max-w-[60%]
                max-xl:text-5xl max-lg:text-4xl max-md:text-2xl">
                A Robust Service Team CRM & Techlog Management Website
            </p>
            <p id="animated-gradient-text" class="self-center text-center px-5 text-xl text-gray-600
                max-xl:text-base max-lg:text-sm">
                Quick, Dynamic, and Reliable system to help search your desired data
            </p>
            <form wire:submit.prevent="search" class="justify-center items-center flex flex-row gap-5 pt-5 w-full max-md:flex-col">
                <div class="flex flex-col min-w-[40%]">
                    <label for="searchN">
                        Search the techlog ID here: 
                    </label>
                    <input wire:model.defer="TechlogIdSearch" 
                        type="text" name="" 
                        id="searchN" 
                        placeholder="Search..." 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('TechlogIdSearch') border-red-500 @enderror"
                    >
                    @error('TechlogIdSearch')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"class="max-h-fit text-white cursor-pointer px-4 py-2 self-end rounded-2xl bg-[#F8971A] hover:opacity-60 max-md:text-xl max-md:self-center">
                    Search 
                </button>
            </form>
        </div>
        <div class="bg-amber-400 h-[1px] w-full self-center hidden max-md:inline"></div>
        {{-- <div class="flex flex-col overflow-x-scroll rounded-2xl">
            <table class="w-full table-auto min-w-screen max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px]">
                <thead class="bg-gray-200 border-t border-gray-200 pl-3">
                    <tr class="gap-3">
                        <th class="text-left p-2">Techlog ID</th>
                        <th class="text-left p-2">Status</th>
                        <th class="text-left p-2">Date In</th>
                        <th class="text-left p-2">Service Type</th>
                        <th class="text-left p-2">Received From</th>
                        <th class="text-left p-2">Contact</th>
                        <th class="text-left p-2">Phone</th>
                        <th class="text-left p-2">SN</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($service_log && ($tl_hide != '' || $tl_hide != null))
                        <tr class="border-t hover:bg-blue-50 max-xl:[&>*]:text-[12px] max-lg:[&>*]:text-[10px]">
                            <td class="min-w-25 p-2">
                                {{ $service_log->techlog_id }}
                            </td>
                            <td class="p-2 min-w-50 max-md:min-w-35">
                                @php
                                    $statusType = $service_log->status ? $service_log->status->status_type : 'N/A';
                                    $statusClass = $color_map_label[$service_log->status_id] ?? 'bg-gray-500';
                                @endphp
                                <span class="{{ $statusClass }} text-white p-1 pl-2 pr-2 rounded-4xl">
                                    {{ $statusType }}
                                </span>
                            </td>
                            <td class="min-w-25 p-2">{{ $service_log->date_in }}</td>
                            <td class="min-w-25 p-2">{{ $service_log->serviceId ? $service_log->serviceId->service_type_name : 'N/A' }}</td>
                            <td class="p-2 max-md:min-w-30">{{ $service_log->received_from }}</td>
                            <td class="p-2 max-md:min-w-30">{{ $service_log->contact_person }}</td>
                            <td class="p-2">{{ $service_log->mobile_number }}</td>
                            <td class="p-2">{{ $service_log->serial_number }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-500">
                                No results found for the given Techlog ID.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div> --}}

        @if ($service_log && ($tl_hide != '' || $tl_hide != null))

            <div class="flex flex-row gap-1">
                <div class="flex flex-row w-full gap-3 justify-center max-xl:[&_div_*]:text-2xl max-lg:[&_div_*]:text-xl max-md:flex-col max-md:items-center">
                    <div class="flex flex-row gap-2">
                        <h1 class="text-3xl text-[#302714] font-bold">
                            TECHLOG:&nbsp;
                        </h1>
                        <h1 class="text-[#302714] text-3xl">{{$service_log->techlog_id}}</h1>
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

            <div class="flex flex-col gap-7 max-xl:[&_div_div]:w-full max-xl:[&_div_div]:text-[12px] max-xl:[&_div_div_h1]:text-lg 
                        max-lg:[&_div_div_h1]:text-base max-lg:[&_div_div_p]:text-[10px]
                        max-md:[&_div]:flex-wrap max-md:[&_div_div]:justify-start max-md:overflow-x-scroll">

                <div class="bg-amber-400 pl-5 pr-5 w-full h-[2px]"></div>
                
                <div class="flex flex-col gap-10 py-5 rounded-b-2xl bg-gradient-to-t from-orange-100/10 to-white shadow-md">
                    <div class="flex flex-row w-full gap-1 pl-5">
                        <div class="bg-[#F8971A]" style="width: 4px"></div>
                        <div class="flex flex-row gap-2">
                            <h1 class="text-2xl text-[#302714] font-bold">
                                Techlog Property
                            </h1>
                        </div>
                    </div>

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
                                {{$service_log->date_in}}
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
                                {{$service_log->invoice_date}}
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
                                {{$service_log->completed_date}}
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
                                {{$service_log->return_date}}
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
                                {{$service_log->serviceId ? $service_log->serviceId->service_type_name: 'N/A'}}
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
                                {{ucwords($service_log->create_by ? $service_log->user->username: 'N/A')}}
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
                                {{$service_log->sales_order}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-amber-400 pl-5 pr-5 w-full h-[2px]"></div>

                <div class="flex flex-col gap-10 py-5 rounded-b-2xl shadow-md bg-gradient-to-t from-orange-100/10">
                    <div class="flex flex-row w-full gap-1 pl-5">
                        <div class="bg-[#F8971A]" style="width: 4px"></div>
                        <div class="flex flex-row gap-2">
                            <h1 class="text-2xl text-[#302714] font-bold">
                                Customer Property
                            </h1>
                        </div>
                    </div>

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
                                {{$service_log->received_from}}
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
                                {{$service_log->email}}
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
                            {{$service_log->contact_person}}
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
                                {{$service_log->mobile_number}}
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
                                {{$service_log->alamat}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-amber-400 pl-5 pr-5 w-full h-[2px]"></div>

                <div class="flex flex-col gap-10 py-5 rounded-b-2xl shadow-md bg-gradient-to-t from-orange-100/10">
                    <div class="flex flex-row w-full gap-1 pl-5">
                        <div class="bg-[#F8971A]" style="width: 4px"></div>
                        <div class="flex flex-row gap-2">
                            <h1 class="text-2xl text-[#302714] font-bold">
                                Item Property
                            </h1>
                        </div>
                    </div>

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
                                {{$service_log->SKU}}
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
                                {{$service_log->brand_type}}
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
                                {{$service_log->part_number}}
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
                                {{$service_log->serial_number}}
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
                                {{$service_log->warranty_bind ? $service_log->warranty_bind->warranty_status: 'N/A'}}
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
                                {{$service_log->part_ready}}
                            </div>
                        </div>
                    </div>

                    <div x-data = "{ show: false }"
                        x-on:open-edit-techlog.window="show = !show"
                        :class="{ 'hidden': show }"
                        class="flex flex-col w-full gap-7 pl-5 pr-5"
                        >
                        <div class="bg-orange-700/10 pl-5 pr-5 w-full" style="height: 1px"></div>
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
                                    {{$service_log->description_product}}
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
                                    {{$service_log->problem}}
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
                                    {{$service_log->pre_diagnostic}}
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
                                    {{$service_log->add_on}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col border justify-center border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 w-full pl-5 pr-5 shadow-md">
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
                                {{-- <th class="text-left p-2" style="width: 50px;">ID</th> --}}
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
                                    {{-- <td class="p-2 pt-5 pb-5 ">{{ $s->id }}</td> --}}
                                    {{-- <td class="p-2 ">{{ $s->service_logs_id }}</td> --}}
                                    <td class="p-2 pt-5 pb-5 min-w-30">
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
                                    <td class="p-2 min-w-50">{{ $s->created_at }}</td>
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


            <div class="flex flex-col border justify-center border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 w-full pl-5 pr-5 shadow-md">
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
                </div>
                <div class="flex flex-col overflow-x-scroll rounded-b-2xl">
                    <table class="w-full table-auto min-w-screen max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px]">
                        <thead class="bg-gray-200 border-t border-gray-200 pl-3">
                            <tr class="gap-3">
                                {{-- <th class="text-left p-2" style="width: 50px;">ID</th> --}}
                                {{-- <th class="text-left p-2" style="width: 10%;">Techlog ID</th> --}}
                                <th class="text-left p-2" style="width: 10%;">Created By</th>
                                <th class="text-left p-2" style="width: 10%;">Created At</th>
                                <th class="text-left p-2" style="max-width: 100px">Note Content</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notes as $n)
                                <tr class="border-t">
                                    {{-- <td class="p-2 pt-5 pb-5 ">{{ $n->id }}</td> --}}
                                    {{-- <td class="p-2 ">{{ $n->service_logs_id }}</td> --}}
                                    <td class="p-2 min-w-10">{{ $n->teknisi_id ? $n->technician->username : 'N/A' }}</td>
                                    <td class="p-2 min-w-50">{{ $n->created_at }}</td>
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
                <div class="p-10">
                    {{$notes->links('vendor.livewire.tailwind')}}
                </div>
            </div>
        @elseif(!$service_log &&( $tl_hide != null ||$tl_hide != '' ))
            <div class="flex flex-col gap-2 self-center h-full items-center justify-center opacity-40
                    max-xl:[&>p]:text-4xl max-xl:[&>i]:text-sm max-xl:gap-1
                    max-lg:[&>p]:text-2xl max-lg:[&>i]:text-[8px] max-lg:gap-0">
                <p class="text-5xl text-gray-600">
                    <span class="font-bold">Techlog</span> does not exist
                </p>
                <i class="text-xl text-gray-600">
                    Make sure the <span class="font-bold">Techlog</span> you have typed is correct
                </i>
            </div>
        @else
            <div class="flex flex-col gap-2 self-center h-full items-center justify-center opacity-40
                    max-xl:[&>p]:text-4xl max-xl:[&>i]:text-sm max-xl:gap-1
                    max-lg:[&>p]:text-2xl max-lg:[&>i]:text-[8px] max-lg:gap-0">
                <p class="text-5xl text-gray-600">
                    Your <span class="font-bold">Techlog</span> will be shown here 
                </p>
                <i class="text-xl text-gray-600">
                    please input the techlog first
                </i>
            </div>
        @endif
    </div>
</div>
