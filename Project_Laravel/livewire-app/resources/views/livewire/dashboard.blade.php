@php
    $statusNames = [
        1 => 'Open Techlog',
        2 => 'On Progress',
        3 => 'Pending',
        4 => 'RMA to Vendor',
        5 => 'On-QC',
        6 => 'Completed',
        7 => 'Cancelled',
        8 => 'Returned to Client',
    ];
@endphp

<div class="flex flex-col w-auto pl-10 pr-10 pb-10 gap-15">
    <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 pl-5 pr-5"
        x-data
        x-on:open-modal.window = "toggleScroll()"    
        x-on:close-modal.window = "toggleScroll()"
        x-on:keydown.escape.window = "toggleKeydownScroll()"
    >

        <div class="flex flex-row max-w-fit gap-1 pl-5">
            <div class="bg-[#F8971A]" style="width: 4px"></div>
            <h3 class=" text-2xl text-[#302714] tracking-widest font-medium">
                Service Log Status Overview
            </h3>
        </div>
        <div class="flex justify-center w-full">
            <div class="flex flex-wrap w-full gap-7 justify-center">
                @foreach($statusCount as $statusId => $count)
                    @php
                        $statusMainCol= ''; // Default empty class
                        $statusLabelCol= ''; // Default empty class

                        $color_map = [
                            1=> 'bg-[#AEAAAA]',
                            2 => 'bg-[#FFB55B]',
                            3 => 'bg-[#DA56B8]',
                            4 => 'bg-[#D094F6]',
                            5 => 'bg-[#68B0FF]',
                            6 => 'bg-[#6EBA5C]',
                            7 => 'bg-[#DA5658]',
                            8 => 'bg-[#5993FF]',
                            
                            //....
                            ];

                        $label_map = [
                            1 => 'bg-[#888080]',
                            2 => 'bg-[#FF9F17]',
                            3 => 'bg-[#D516A4]',
                            4 => 'bg-[#C547F6]',
                            5 => 'bg-[#1A96FF]',
                            6 => 'bg-[#1CA717]',
                            7 => 'bg-[#D40000]',
                            8 => 'bg-[#1657FF]',
                            
                            //....
                            ];

                        $statusMainCol = $color_map[$statusId] ?? 'bg-gray-300';
                        $statusLabelCol = $label_map[$statusId] ?? 'bg-gray-400';
                        // switch ($statusId) {
                        //     case '1':
                        //         $statusMainCol = 'bg-[#AEAAAA]'; // Grey for Open
                        //         $statusLabelCol = 'bg-[#888080]'; // Grey for Open
                        //         break;
                        //     case '2':
                        //         $statusMainCol = 'bg-[#FFB55B]'; // Example: yellow for On Progress
                        //         $statusLabelCol = 'bg-[#FF9F17]'; // Grey for Open
                        //         break;
                        //     case '3':
                        //         $statusMainCol = 'bg-[#DA56B8]'; // Example: purple for Pending
                        //         $statusLabelCol = 'bg-[#D516A4]'; // Grey for Open
                        //         break;
                        //     case '4':
                        //         $statusMainCol = 'bg-[#D094F6]'; // Example: red for RMA
                        //         $statusLabelCol = 'bg-[#C547F6]'; // Grey for Open
                        //         break;
                        //     case '5':
                        //         $statusMainCol = 'bg-[#68B0FF]'; // Example: indigo for On-QC
                        //         $statusLabelCol = 'bg-[#1A96FF]'; // Grey for Open
                        //         break;
                        //     case '6':
                        //         $statusMainCol = 'bg-[#6EBA5C]'; // Example: green for Completed
                        //         $statusLabelCol = 'bg-[#1CA717]'; // Grey for Open
                        //         break;
                        //     case '7':
                        //         $statusMainCol = 'bg-[#DA5658]'; // Example: gray for Canceled
                        //         $statusLabelCol = 'bg-[#D40000]'; // Grey for Open
                        //         break;
                        //     case '8':
                        //         $statusMainCol = 'bg-[#5993FF]'; // Example: orange for Returned
                        //         $statusLabelCol = 'bg-[#1657FF]'; // Grey for Open
                        //         break;
                        //     default:
                        //         $statusMainCol = 'bg-gray-300'; // For 'N/A' or unknown statuses
                        //         $statusLabelCol = 'bg-gray-400'; // Grey for Open
                        //         break;
                        // }
                    @endphp
                    <div class="flex flex-col [&>*]:text-white" style="width: 23%">
                        <div class=" {{$statusMainCol}} rounded-t-3xl p-7">
                            <img src="" alt="">
                            <div class="flex flex-col">
                                <span class="badge bg-primary font-bold text-2xl">{{ $count }}</span>
                                <p>{{ $statusNames[$statusId] ?? 'Unknown Status' }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center {{$statusLabelCol}}  rounded-b-3xl p-5 pt-3 pb-3">
                            <p>
                                Total {{ $count }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10">
        <div class="flex flex-col gap-10">
            <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                CUSTOMER RELATED SEARCH
            </h1>
            <div class="flex flex-wrap justify-around w-full gap-15  pl-5 pr-5  [&>*]:w-5/12 [&>*]:max-h-fit">
                <div class="flex flex-col ">
                    <label for="searchN">
                        Customer Name 
                    </label>
                    <input wire:model.live.debounce.200ms="nameSearch" type="text" name="" id="searchN" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                </div>
                <div class="flex flex-col">
                    <label for="searchMN">
                        Mobile Number 
                    </label>
                    <input wire:model.live.debounce.200ms="mobileNumberSearch" type="text" name="" id="searchMN" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex flex-col">
                    <label for="searchE">
                        Email 
                    </label>
                    <input wire:model.live.debounce.200ms="emailSearch" type="text" name="" id="searchE" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex flex-col">
                    <label for="searchCOP">
                        Contact Person 
                    </label>
                    <input wire:model.live.debounce.200ms="contactPersonSearch" type="text" name="" id="searchCOP" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            </div>
            <hr class="text-[#FFF1C7] self-center" style="width: 90%;">
            <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                ITEM RELATED SEARCH
            </h1>
            <div class="flex flex-wrap justify-around w-full gap-15 [&>*]:w-5/12 pl-5 pr-5">
                <div class="flex flex-col ">
                    <label for="searchBT">
                        Brand Type 
                    </label>
                    <input wire:model.live.debounce.200ms="brandTypeSearch" type="text" name="" id="searchBT" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                </div>
                <div class="flex flex-col">
                    <label for="searchSN">
                        Serial Number 
                    </label>
                    <input wire:model.live.debounce.200ms="serialNumberSearch" type="text" name="" id="searchSN" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex flex-col">
                    <label for="searchSKU">
                        SKU 
                    </label>
                    <input wire:model.live.debounce.200ms="skuSearch" type="text" name="" id="searchSKU" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex flex-col">
                    <label for="searchSO">
                        Sales Orders 
                    </label>
                    <input wire:model.live.debounce.200ms="salesOrdersSearch" type="text" name="" id="searchSO" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            </div>
            <hr class="text-[#FFF1C7] self-center" style="width: 90%;">
            <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                TECHLOG PROPERTY SEARCH
            </h1>
            <div class="flex flex-wrap items-end pl-15 pr-15 gap-15 w-full">
                <div class="flex flex-col justify-center w-4/12 gap-15 [&>*]:max-h-fit">
                    <div class="flex flex-col">
                        <label for="searchTL">
                            Techlog ID 
                        </label>
                        <input wire:model.live.debounce.200ms="TechlogIDSearch" type="text" name="" id="searchTL" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>
                <div class="flex flex-col justify-center w-3/12">
                    <label for="datetimeFrom">
                        Datetime From
                    </label>
                    <input wire:model.live.debounce.200ms="searchFromDateIn" type="date" name="datetimeFrom" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    {{-- <x-datepicker>
                    </x-datepicker> --}}
                </div>
                <div class="flex flex-col justify-center w-3/12">
                    <label for="datetimeTo">
                        Datetime To
                    </label>
                    <input wire:model.live.debounce.200ms="searchToDateIn" type="date" name="datetimeTo" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    {{-- <x-datepicker>
                    </x-datepicker> --}}
                </div>
                <div class="flex flex-col justify-center w-3/12">
                    <label for="datetimeFrom">
                        Completed From
                    </label>
                    <input wire:model.live.debounce.200ms="searchFromCompleted" type="date" name="datetimeFrom" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    {{-- <x-datepicker>
                    </x-datepicker> --}}
                </div>
                <div class="flex flex-col justify-center w-3/12">
                    <label for="datetimeTo">
                        Completed To
                    </label>
                    <input wire:model.live.debounce.200ms="searchToCompleted" type="date" name="datetimeTo" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    {{-- <x-datepicker>
                    </x-datepicker> --}}
                </div>
            </div>
            <hr class="text-[#FFF1C7] ml-15" style="width: 70%;">
            <div class="flex flex-wrap justify-between w-full gap-15 [&>*]:w-3/12 [&>*]:max-h-fit pl-15 pr-15">
                <div class="flex flex-col ">
                    <label for="selS">
                        Status
                    </label>
                    <select wire:model.live.debounce.50ms="statusDDL" name="selS" id="ddl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="" selected>-- All Selected --</option>
                        @foreach($Status_DDL_ArrayContain as $s)
                            <option value="{{$s->id}}">{{$s->status_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col ">
                    <label for="selST">
                        Service Type 
                    </label>
                    <select wire:model.live.debounce.50ms="serviceTypeDDL" name="selST" id="ddl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="" selected>-- All Selected --</option>
                        @foreach($ServiceType_DDL_ArrayContain as $st)
                            <option value="{{$st->id}}">{{$st->service_type_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="selCB">
                        Create By 
                    </label>
                    <select wire:model.live.debounce.50ms="createByDDL" name="selCB" id="ddl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="" selected>-- All Selected --</option>
                        @foreach($Users_DDL_ArrayContain as $u)
                            <option value="{{$u->id}}">{{$u->username}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="bg-[#F8971A]" style="height: 64px"></div>
        <div class="flex flex-col ml-10 mr-10 overflow-x-scroll rounded-2xl">
            <table class="w-full table-auto min-w-screen max-w-full">
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
                        <th class="text-center p-2">Action | Print</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($service_log as $sl)
                        <tr class="border-t">
                            <td class="p-2">
                                {{-- x-on:click="$dispatch('open-ticketPage', {id_selected: {{ $sl->id }} })"  --}}
                                <a wire:click="ticketPageLink({{$sl->id}})" class="cursor-pointer text-indigo-500 underline hover:text-indigo-700">
                                {{ $sl->techlog_id }}
                                </a>
                            </td>
                            {{-- <td class="p-2">{{ $sl->status ? $sl->status->status_type : 'N/A' }}</td> --}}
                            <td class="p-2">
                                @php
                                    $statusType = $sl->status ? $sl->status->status_type : 'N/A';
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
                                    // switch ($statusType) {
                                    //     case 'Open':
                                    //         $statusClass = 'bg-[#888080]'; // Darker Grey for Open
                                    //         break;
                                    //     case 'On Progress':
                                    //         $statusClass = 'bg-[#FF9F17]'; // Darker Yellow for On Progress
                                    //         break;
                                    //     case 'Pending':
                                    //         $statusClass = 'bg-[#D516A4]'; // Darker Purple for Pending
                                    //         break;
                                    //     case 'RMA to Vendor':
                                    //         $statusClass = 'bg-[#C547F6]'; // Darker Red for RMA
                                    //         break;
                                    //     case 'On-QC':
                                    //         $statusClass = 'bg-[#1A96FF]'; // Darker Indigo for On-QC
                                    //         break;
                                    //     case 'Completed':
                                    //         $statusClass = 'bg-[#1CA717]'; // Darker Green for Completed
                                    //         break;
                                    //     case 'Canceled':
                                    //         $statusClass = 'bg-[#D40000]'; // Darker Red for Canceled
                                    //         break;
                                    //     case 'Returned to Client':
                                    //         $statusClass = 'bg-[#1657FF]'; // Darker Orange for Returned
                                    //         break;
                                    //     default:
                                    //         $statusClass = 'bg-gray-500 italic'; // Darker Grey for 'N/A' or unknown statuses (adjusted from 400 for consistency)
                                    //         break;
                                    // }
                                @endphp
                                <span class="{{ $statusClass }} text-white p-1 pl-2 pr-2 rounded-4xl">
                                    {{ $statusType }}
                                </span>
                            </td>
                            <td class="p-2">{{ $sl->date_in }}</td>
                            <td class="p-2">{{ $sl->serviceId ? $sl->serviceId->service_type_name : 'N/A' }}</td>
                            {{-- <td class="p-2">{{$sl->serviceId === 1 ? 'a' : ($sl->serviceId === 2 ? 'b' : 'N/A') }}</td> --}}
                            {{-- <td class="p-2">
                                @if (($p = $sl->service_id) == 1)  
                                    a
                                @elseif (($p = $sl->service_id) == 2)
                                    b
                                @else
                                    N/A
                                @endif
                            </td> --}}
                            <td class="p-2">{{ $sl->received_from }}</td>
                            <td class="p-2">{{ $sl->contact_person }}</td>
                            <td class="p-2">{{ $sl->mobile_number }}</td>
                            <td class="p-2">{{ $sl->serial_number }}</td>
                            <td class="flex items-start justify-end gap-4 p-6">
                                <!-- Update Button Form updateId=""-->
                                    {{-- <input type="hidden" name="id" value="{{ $u->id }}"> --}}
                                    @if ($sl->status_id < 7)
                                        <button  x-data x-on:click="$dispatch('open-modal', { name: 'test', slId_For_UpdateStatusId: {{ $sl->id }} })" type="submit" class="max-w-fit text-white cursor-pointer px-4 py-2 rounded-2xl hover:opacity-60 bg-indigo-600" style="">
                                            Update
                                        </button>
                                    @elseif($sl->status_id >= 8)
                                        <button  x-data x-on:click="" type="submit" class="max-w-fit text-[#302714] px-4 py-2 rounded-2xl border border-indigo-600 " style="opacity: 0.6; cursor: not-allowed;">
                                            Closed
                                        </button>
                                    @elseif($sl->status_id = 7)
                                        <button  x-data x-on:click="" type="submit" class="max-w-fit text-[#302714] px-4 py-2 rounded-2xl border border-red-600 " style="opacity: 0.6; cursor: not-allowed;">
                                            Cancelled
                                        </button>
                                    @endif
                                <!-- Delete Button Form -->
                                <div class="flex flex-col gap-3">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this Category?')" class="text-white cursor-pointer px-4 py-2 rounded-2xl bg-[#F8971A] hover:opacity-60">
                                            Receipt Form
                                        </button>
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this Category?')" class="text-white cursor-pointer px-4 py-2 rounded-2xl bg-amber-400 hover:opacity-60">
                                            Job Order
                                        </button>
                                    {{-- <form method="POST" action="">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">No Category found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        @if (session()->has('success'))
            <div class="w-full pl-10 pr-10" role="alert">
                <p class="bg-gray-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-amber-200">
                Success: <span class="text-green-500 text-lg font-medium">{{ session('success') }}</span>
                </p>
            </div>
        @else
            <div class="w-full pl-10 pr-10" role="alert">
                <p class="bg-gray-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-amber-200">
                    <span class="text-red-500 text-lg font-medium">{{ session('error') }}</span>
                </p>
            </div>
        @endif
        <div class="p-10">
            {{$service_log->links('vendor.livewire.tailwind')}}
        </div>
    </div>

    <x-modal-UpdatePopUp name="test" title="Test">
        @slot('body')
            <livewire:modal-update/>
        @endslot
    </x-modal-UpdatePopUp>


    {{-- @if (session('success'))
        <span>
            {{session('success')}}
        </span>
    @endif --}}

    {{-- this button below led to its own function --}}
    {{-- <button wire:click="logout">
        logout
    </button> --}}

        {{-- this button below led to the web routing file that cast /logout on the browser which lead to livewire.auth.logout --}}
    {{-- <form action="{{route('auth.logout')}}">
        <button class="text-base active:bg-red-100">
        Logout
        </button>
    </form> --}}
    
    {{-- <hr> --}}
    {{-- @foreach ($service_log as $sl)
        <h3>
            {{$u->username}}
        </h3>
    @endforeach --}}

</div>
