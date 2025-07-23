    @php
    
     if ($sl) {

        $statusMainCol = ''; // Default empty class
        $statusMainLabel = '';
        switch ($sl->status_id) {
            case 1:
                $statusMainCol = 'bg-[#888080]'; // Darker Grey for Open
                $statusMainLabel = 'Open';
                $toCol = 'text-[#888080]';
                break;
            case 2:
                $statusMainCol = 'bg-[#FF9F17]'; // Darker Yellow for On Progress
                $statusMainLabel = 'On Progress';
                $toCol = 'text-[#FF9F17]';
                break;
            case 3:
                $statusMainCol = 'bg-[#D516A4]'; // Darker Purple for Pending
                $statusMainLabel = 'Pending';
                $toCol = 'text-[#D516A4]';
                break;
            case 4:
                $statusMainCol = 'bg-[#C547F6]'; // Darker Red for RMA
                $statusMainLabel = 'RMA To Vendor';
                $toCol = 'text-[#C547F6]';
                break;
            case 5:
                $statusMainCol = 'bg-[#1A96FF]'; // Darker Indigo for On-QC
                $statusMainLabel = 'On-QC';
                $toCol = 'text-[#1A96FF]';
                break;
            case 6:
                $statusMainCol = 'bg-[#1CA717]'; // Darker Green for Completed
                $statusMainLabel = 'Completed';
                $toCol = 'text-[#1CA717]';
                break;
            case 7:
                $statusMainCol = 'bg-[#D40000]'; // Darker Gray for Canceled
                $statusMainLabel = 'Canceled';
                $toCol = 'text-[#D40000]';
                break;
            case 8:
                $statusMainCol = 'bg-[#1657FF]'; // Darker Orange for Returned
                $statusMainLabel = 'Returned';
                $toCol = 'text-[#1657FF]';
                break;
            default:
                $statusMainCol = 'bg-gray-400'; // Default for 'N/A' or unknown statuses
                $statusMainLabel = 'N/A';
                $toCol = 'text-gray-400';
                break;
        }
    }
@endphp

<div class="flex flex-col w-auto pl-10 pr-10 gap-15">
    adad {{$id}}
    <div class="flex flex-col border justify-center border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 pl-5 pr-5 w-full">
        @if ($sl)
            <div class="flex flex-row gap-1">
                <div class="flex flex-row w-full gap-3 justify-center">
                    <div class="flex flex-row gap-2">
                        <h1 class="text-3xl text-[#302714] font-bold">
                            TECHLOG:&nbsp;
                        </h1>
                        <h1 class="text-[#302714] text-3xl">{{$sl->techlog_id}}</h1>
                         {{-- <div class="bg-[#F8971A]" style="width: 2px;"></div> --}}
                    </div>
                    <div class="bg-[#F8971A]" style="width: 2px"></div>
                    <div class="flex flex-row items-center gap-2">
                        <div class="flex justify-center text-white p-1 pl-2 pr-2 rounded-4xl {{$statusMainCol}}">
                            <p>{{$statusMainLabel}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-amber-400 pl-5 pr-5 w-full" style="height: 1px"></div>
            <div class="flex flex-col gap-7">
                <div class="flex flex-col gap-10">
                    <div class="flex flex-row w-full gap-1 pl-5">
                        <div class="bg-[#F8971A]" style="width: 4px"></div>
                        <div class="flex flex-row gap-2">
                            <h1 class="text-2xl text-[#302714] font-bold">
                                Techlog Property
                            </h1>
                        </div>
                    </div>
                    <div class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:flex-row [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5">
                        {{-- <div class="gap-3 flex flex-col">
                            <div class="[&>*]:font-semibold flex flex-row w-full justify-between gap-2" style="max-width: 25%">
                                <p class="" style=>
                                    Status
                                </p>
                                <p>
                                    :
                                </p>
                            </div>
                            <div class="flex flex-row items-center gap-2">
                                <div class="flex justify-center text-white p-1 pl-2 pr-2 rounded-4xl {{$statusMainCol}}">
                                    <p>{{$statusMainLabel}}</p>
                                </div>
                            </div>
                        </div> --}}
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
                    <div class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:flex-row [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5">
                        <div class="gap-3 flex flex-row">
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
                            <div class="w-full">
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
                    <div class="flex flex-wrap w-full gap-7 [&>*]:text-md [&>*]:justify-start [&>*]:flex [&>*]:w-2/5 [&>*]:pl-5 [&>*]:pr-5">
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
                                {{$sl->received_from}}
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
                                {{$sl->email}}
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
                                {{$sl->contact_person}}
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
                                {{$sl->mobile_number}}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full gap-7 pl-5 pr-5">
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
                                {{$sl->description_product}}
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
                                {{$sl->problem}}
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
                                {{$sl->pre_diagnostic}}
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
                                {{$sl->add_on}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">

                </div>
            </div>
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

</div>
