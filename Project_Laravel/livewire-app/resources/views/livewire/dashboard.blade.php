@php
    $statusNames = [
        1 => 'Open',
        2 => 'On Progress',
        3 => 'Pending',
        4 => 'RMA to Vendor',
        5 => 'On-QC',
        6 => 'Completed',
        7 => 'Cancelled',
        8 => 'Returned to Client',
    ];

    $color_map_main = [
        1 => 'bg-[#AEAAAA]',
        2 => 'bg-[#FFB55B]',
        3 => 'bg-[#DA56B8]',
        4 => 'bg-[#D094F6]',
        5 => 'bg-[#68B0FF]',
        6 => 'bg-[#6EBA5C]',
        7 => 'bg-[#DA5658]',
        8 => 'bg-[#5993FF]',
    ];

    $color_map_label = [
        1 => 'bg-[#888080]',
        2 => 'bg-[#FF9F17]',
        3 => 'bg-[#D516A4]',
        4 => 'bg-[#C547F6]',
        5 => 'bg-[#1A96FF]',
        6 => 'bg-[#1CA717]',
        7 => 'bg-[#D40000]',
        8 => 'bg-[#1657FF]',
    ];

    $icon_map = [
        1 => 'icon_SLOverview/icon_Open.svg',
        2 => 'icon_SLOverview/icon_On_Progrss.svg',
        3 => 'icon_SLOverview/icon_Pending.svg',
        4 => 'icon_SLOverview/icon_RMA_to_Vendor.svg',
        5 => 'icon_SLOverview/icon_QC.svg',
        6 => 'icon_SLOverview/icon_completed.svg',
        7 => 'icon_SLOverview/icon_Cancel.svg',
        8 => 'icon_SLOverview/icon_Returned_to_client.svg',
    ];
@endphp

<div class="flex flex-col w-auto pl-10 pr-10 pb-10 gap-15 max-md:px-5">
    <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 pl-5 pr-5 shadow-lg"
        x-data
        x-on:open-modal.window="toggleScroll()" 
        x-on:close-modal.window="toggleScroll()"
        x-on:keydown.escape.window="toggleKeydownScroll()"
    >
        <div class="flex flex-row max-w-fit gap-1 pl-5">
            <div class="bg-[#F8971A]" style="width: 4px"></div>
            <h3 class="text-2xl text-[#302714] tracking-widest font-medium max-xl:text-xl">
                Service Log Status Overview
            </h3>
        </div>
        <div class="flex justify-center w-full">
            <div class="flex flex-wrap w-full gap-7 justify-center max-lg:justify-start max-lg:flex-row max-lg:flex-nowrap max-lg:pb-2 max-lg:overflow-x-scroll">
                @foreach($this->statusCounts as $statusId => $count)
                    @php
                        $statusMainCol = $color_map_main[$statusId] ?? 'bg-gray-300';
                        $statusLabelCol = $color_map_label[$statusId] ?? 'bg-gray-400';
                        $statusIcon = $icon_map[$statusId] ?? 'N/A';
                    @endphp
                    <div class="flex flex-col [&>*]:text-white w-[21%] max-xl:w-[20%] max-lg:min-w-[30%] max-lg:w-full max-md:min-w-50">
                        <div class="relative {{ $statusMainCol }} rounded-t-3xl p-7 max-xl:p-5">
                            <div class="flex flex-col">
                                <img src="{{ $statusIcon }}" alt="" class="absolute self-end w-[64px] max-xl:w-[48px] max-lg:w-[40px]">
                                <span class="badge bg-primary font-bold text-2xl max-xl:text-sm" style="z-index: 1">{{ $count }}</span>
                                <p style="z-index: 1" class="max-xl:text-xs">{{ $statusNames[$statusId] ?? 'Unknown Status' }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center {{ $statusLabelCol }} rounded-b-3xl p-5 pt-3 pb-3">
                            <p class="max-xl:text-xs max-xl:pr-0">
                                Total {{ $count }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 shadow-lg 
                max-xl:[&_div_div_div_label]:text-sm max-xl:[&_div_h1]:text-2xl 
                max-lg:[&_div_h1]:text-lg max-lg:[&_div_div_div_label]:text-[12px] max-lg:[&_div_div_div_input,_div_div_div_select]:text-[10px] max-lg:[&_div_div_div_input,_div_div_div_select]:p-1 
                max-md:[&_div_div_div,_div_div_div_select]:w-full max-md:[&_div_div_div_label]:text-base max-md:[&_div_div_div_input,_div_div_div_select]:text-sm max-md:[&_div_div_div_input,_div_div_div_select]:p-3">
        <div class="flex flex-col gap-10">
            <h1 class="text-center text-3xl text-[#F8971A] tracking-widest font-medium">
                CUSTOMER PROPERTY SEARCH
            </h1>
            <div class="flex flex-wrap justify-around w-full gap-15 pl-5 pr-5 [&>*]:w-5/12 [&>*]:max-h-fit max-lg:pl-10 max-lg:pr-10">
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
            <h1 class="text-center self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                ITEM PROPERTY SEARCH
            </h1>
            <div class="flex flex-wrap justify-around w-full gap-15 [&>*]:w-5/12 pl-5 pr-5 max-lg:pl-10 max-lg:pr-10">
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
            <h1 class="text-center self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                TECHLOG PROPERTY SEARCH
            </h1>
            <div class="flex flex-wrap justify-between items-end pl-15 pr-15 gap-15 w-full">
                <div class="flex flex-col justify-center w-3/12 gap-15 [&>*]:max-h-fit max-xl:w-full">
                    <div class="flex flex-col">
                        <label for="searchTL">
                            Techlog ID 
                        </label>
                        <input wire:model.live.debounce.200ms="TechlogIDSearch" type="text" name="" id="searchTL" placeholder="Search..." class="max-xl:w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>
                <div class="flex flex-col justify-center w-3/12 max-xl:w-5/12">
                    <label for="datetimeFrom">
                        Datetime From
                    </label>
                    <input wire:model.live.debounce.200ms="searchFromDateIn" type="date" name="datetimeFrom" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex flex-col justify-center w-3/12 max-xl:w-5/12">
                    <label for="datetimeTo">
                        Datetime To
                    </label>
                    <input wire:model.live.debounce.200ms="searchToDateIn" type="date" name="datetimeTo" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex flex-col justify-center w-3/12 max-xl:w-5/12">
                    <label for="datetimeFrom">
                        Completed From
                    </label>
                    <input wire:model.live.debounce.200ms="searchFromCompleted" type="date" name="datetimeFrom" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex flex-col justify-center w-3/12 max-xl:w-5/12">
                    <label for="datetimeTo">
                        Completed To
                    </label>
                    <input wire:model.live.debounce.200ms="searchToCompleted" type="date" name="datetimeTo" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="flex flex-col justify-center w-3/12 max-xl:hidden">
                </div>
                <hr class="text-gray-300" style="width: 100%">
            </div>
            <div class="flex flex-wrap justify-between w-full gap-15 [&>*]:w-3/12 [&>*]:max-h-fit pl-15 pr-15 max-lg:flex-row max-lg:items-center max-lg:gap-5 max-lg:[&_div_select]:w-30 max-md:flex-col max-md:items-center max-md:gap-10">
                <div class="flex flex-col ">
                    <label for="selS">
                        Status
                    </label>
                    <select wire:model.live.debounce.50ms="statusDDL" name="selS" id="ddl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="" selected>-- All Selected --</option>
                        @foreach($this->allStatuses as $s)
                            <option value="{{ $s->id }}">{{ $s->status_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col ">
                    <label for="selST">
                        Service Type 
                    </label>
                    <select wire:model.live.debounce.50ms="serviceTypeDDL" name="selST" id="ddl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="" selected>-- All Selected --</option>
                        @foreach($this->allServiceTypes as $st)
                            <option value="{{ $st->id }}">{{ $st->service_type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="selCB">
                        Create By 
                    </label>
                    <select wire:model.live.debounce.50ms="createByDDL" name="selCB" id="ddl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <option value="" selected>-- All Selected --</option>
                        @foreach($this->allUsers as $u)
                            <option value="{{ $u->id }}">{{ $u->username }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="bg-[#F8971A]" style="height: 64px"></div>
        <div class="flex flex-col ml-10 mr-10 overflow-x-scroll rounded-2xl max-md:ml-3 max-md:mr-3">
            <table class="w-full table-auto min-w-screen max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px] max-md:[&_tbody_tr_td]:text-xs">
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
                        <th class="text-center p-2 max-w-fit">Action | Print</th>
                        @if (session('role') == 1)
                            <th class="text-center p-2 text-red-500 ">Danger Zone</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->serviceLogs as $sl)
                        <tr class="border-t hover:bg-blue-50 max-xl:[&>*]:text-[12px] max-lg:[&>*]:text-[10px]">
                            <td class="p-2">
                                <a wire:click="ticketPageLink({{ $sl->id }})" class="cursor-pointer text-indigo-500 underline hover:text-indigo-700">
                                    {{ $sl->techlog_id }}
                                </a>
                            </td>
                            <td class="p-2 min-w-50 max-md:min-w-35">
                                @php
                                    $statusType = $sl->status ? $sl->status->status_type : 'N/A';
                                    $color_map_status = [
                                        'Open' => 'bg-[#888080]',
                                        'On Progress' => 'bg-[#FF9F17]',
                                        'Pending' => 'bg-[#D516A4]',
                                        'RMA to Vendor' => 'bg-[#C547F6]',
                                        'On-QC' => 'bg-[#1A96FF]',
                                        'Completed' => 'bg-[#1CA717]',
                                        'Canceled' => 'bg-[#DA5658]',
                                        'Returned to Client' => 'bg-[#5993FF]',
                                    ];
                                    $statusClass = $color_map_status[$statusType] ?? 'bg-gray-500';
                                @endphp
                                <span class="{{ $statusClass }} text-white p-1 pl-2 pr-2 rounded-4xl">
                                    {{ $statusType }}
                                </span>
                            </td>
                            <td class="min-w-25 p-2">{{ $sl->date_in }}</td>
                            <td class="min-w-25 p-2">{{ $sl->serviceId ? $sl->serviceId->service_type_name : 'N/A' }}</td>
                            <td class="p-2 max-md:min-w-30">{{ $sl->received_from }}</td>
                            <td class="p-2 max-md:min-w-30">{{ $sl->contact_person }}</td>
                            <td class="p-2">{{ $sl->mobile_number }}</td>
                            <td class="p-2">{{ $sl->serial_number }}</td>
                            <td class="flex items-start justify-end gap-4 p-6 min-w-80 max-xl:[&>*]:text-[12px] max-xl:[&>button]:py-1 max-xl:[&_div_button]:py-1 max-lg:[&>button]:text-[10px] max-lg:[&_div_button]:text-[10px] 
                                            max-md:[&_div_button]:text-sm max-md:[&_div_button,_button]:py-2 max-md:[&>button]:text-sm max-md:[&>button]:py-2
                                            ">
                                <div class="flex flex-col gap-3 items-end">
                                    @if ($sl->status_id < 7)
                                        <button x-data x-on:click="$dispatch('open-modal', { name: 'test', slId_For_UpdateStatusId: {{ $sl->id }} })" type="button" class="max-w-fit text-white cursor-pointer px-4 py-2 rounded-2xl hover:opacity-60 bg-indigo-600">
                                            Update
                                        </button>
                                    @elseif($sl->status_id === 8)
                                        <button type="button" class="max-w-fit text-[#302714] px-4 py-2 rounded-2xl border border-indigo-600" style="opacity: 0.6; cursor: not-allowed;">
                                            Closed
                                        </button>
                                    @elseif($sl->status_id === 7)
                                        <button type="button" class="max-w-fit text-[#302714] px-4 py-2 rounded-2xl border border-red-600" style="opacity: 0.6; cursor: not-allowed;">
                                            Cancelled
                                        </button>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-3">
                                    <button type="button"
                                        x-on:click="window.open('{{ route('receiptForm', ['id' => $sl->id]) }}', '_blank', 'noopener,noreferrer')"
                                        class="text-white cursor-pointer px-4 py-2 rounded-2xl bg-[#F8971A] hover:opacity-60">
                                        Receipt Form
                                    </button>
                                    <button type="button"
                                        x-on:click="window.open('{{ route('jobOrder', ['id' => $sl->id]) }}', '_blank', 'noopener,noreferrer')"
                                        class="text-white cursor-pointer px-4 py-2 rounded-2xl bg-amber-400 hover:opacity-60">
                                        Job Order
                                    </button>
                                </div>
                            </td>
                            @if (session(key: 'role') == 1)
                            <td class="bg-red-100 content-baseline justify-end p-6 min-w-fit max-xl:[&>*]:text-[12px] max-xl:[&>button]:py-1 max-xl:[&_div_button]:py-1 max-lg:[&>button]:text-[10px] max-lg:[&_div_button]:text-[10px] 
                                            max-md:[&_div_button]:text-sm max-md:[&_div_button,_button]:py-2 max-md:[&>button]:text-sm max-md:[&>button]:py-2
                                            ">
                                    <button x-data
                                            x-on:click="if (confirm('Are you sure you want to DELETE this techlog?')) { $wire.deleteTechlog({{ $sl->id }}); }"
                                            type="button" 
                                            class="max-w-fit text-white font-bold cursor-pointer px-4 py-2 rounded-2xl hover:opacity-60 bg-red-600">
                                        Delete
                                    </button>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="p-4 text-center text-gray-500">No Service Log found.</td>
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
            {{ $this->serviceLogs->links('vendor.livewire.tailwind') }}
        </div>
    </div>
    <x-modal-UpdatePopUp name="test" title="Test">
        @slot('body')
            <livewire:modal-update/>
        @endslot
    </x-modal-UpdatePopUp>
</div>