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
@endphp

<div class="flex flex-col w-auto pl-10 pr-10 pb-10 gap-15 max-md:px-5">
    <div class="flex flex-col border min-h-screen border-amber-300 bg-white py-10 px-10 rounded-4xl gap-10 shadow-lg">
        <p class="self-center">
            If you look to others for fulfillment, you will never truly be fulfilled.
        </p>
        <div>
            <div class="flex flex-col ">
                <label for="searchN">
                    Techlog ID 
                </label>
                <input wire:model.live.debounce.200ms="TechlogIDSearch" 
                    type="text" name="" 
                    id="searchN" 
                    placeholder="Search..." 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
            </div>
        </div>
        <div class="bg-amber-400 h-[1px] w-full self-center hidden max-md:inline"></div>
        <div class="flex flex-col overflow-x-scroll rounded-2xl">
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
        </div>
    </div>
</div>
