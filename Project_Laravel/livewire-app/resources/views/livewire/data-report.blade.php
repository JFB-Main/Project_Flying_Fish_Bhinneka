<div class="flex flex-col w-auto pl-10 pr-10 pb-10 gap-10">
    {{-- <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 pl-5 pr-5">
        <h1>Service Log Status History Report</h1>

        @if (empty($reportData))
            <p>No data to display for the report.</p>
        @else
            <table class="border w-full table-auto max-w-full">
                <thead class="bg-gray-100 w-full">
                    <tr class="bg-gray-100 w-full">
                        Dynamically generate headers from the first row's keys
                        @foreach (array_keys($reportData[0]) as $header)
                            <th class="bg-gray-100 p-3" style="width: 300px">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportData as $row)
                        <tr>
                            @foreach ($row as $value)
                                @if ($value)
                                    <td>{{ $value }}</td>
                                @else
                                <td>no data</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div> --}}

    {{-- <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 pl-5 pr-5">
        <div class="flex flex-col ml-10 mr-10 overflow-x-scroll rounded-2xl">
            <table class="border w-full table-auto  max-w-full">
                <thead class="bg-gray-100 ">
                    <tr class="text-black font-bold h-10">
                        <th class="text-center md:p-4 p-0 md:w-32 w-10 border-r">Techlog ID</th>
                        <th class="text-center md:p-4 p-0 md:w-96 w-none border-r">Date IN</th>
                        <th class="text-center md:p-4 p-0 md:w-96 w-none border-r">Customer Name</th>
                        <th class="text-center md:p-4 p-0 md:w-96 w-none border-r">Brand Type</th>
                        <th class="text-center md:p-4 p-0 md:w-96 w-none ">Serial Number</th>
                        <th colSpan="2" class="text-center p-4 border border-t-0">On-Progress</th>
                        <th colSpan="2" class="text-center p-4 border border-t-0">Pending</th>
                        <th colSpan="2" class="text-center p-4 border border-t-0">RMA to Vendor</th>
                        <th colSpan="2" class="text-center p-4 border border-t-0">On-QC</th>
                        <th colSpan="2" class="text-center md:p-4 p-0 md:w-32 w-10 border-r">Complete</th>
                        <th colSpan="2" class="text-center md:p-4 p-0 md:w-32 w-10 border-r">Return to Client</th>
                    </tr>
                    <tr class="border-b font-bold h-10 text-black">
                        <th class="text-center p-4 border-r"></th>
                        <th class="text-center p-4 border-r"></th>
                        <th class="text-center p-4 border-r"></th>
                        <th class="text-center p-4 border-r"></th>
                        <th class="text-center p-4 border-r"></th>
                        
                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>

                                                
                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>

                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>

                                                
                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>

                                                
                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>

                                                
                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50 text-center border-b-0 border-b-none h-10">
                        <td class="p-0 border-l border-r">001</td>
                        <td class="p-0 border-l border-r">English 1</td>
                        <td class="p-0 border-l border-r">40</td>
                        <td class="p-0 border-l border-r">40</td>
                        <td class="p-0 border-l border-r">50</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>
                        
                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>
                    </tr>
                    <tr class="hover:bg-gray-50 text-center border-b-0 border-b-none h-10">
                        <td class="p-0 border-l border-r">001</td>
                        <td class="p-0 border-l border-r">English 1</td>
                        <td class="p-0 border-l border-r">40</td>
                        <td class="p-0 border-l border-r">40</td>
                        <td class="p-0 border-l border-r">50</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>
                        
                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>

                        <td class="p-0 border-l border-r">total</td>
                        <td class="p-0 border-l border-r">grade</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}

    <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10 ">
        <div class="flex flex-col pl-10 pr-10 gap-5">
            <div class="flex flex-col gap-5">
                <h1 class="text-3xl text-[#F8971A] tracking-widest font-medium">
                    Date In Filter:
                </h1>
                <div class="flex flex-row gap-10">
                    <div class="flex flex-col justify-center w-3/12">
                        <label for="datetimeFrom">
                            Date In From
                        </label>
                        <input wire:model.live.debounce.200ms="searchFromDateIn" type="date" name="datetimeFrom" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        {{-- <x-datepicker>
                        </x-datepicker> --}}
                    </div>
                    <div class="flex flex-col justify-center w-3/12">
                        <label for="datetimeTo">
                            Date In To
                        </label>
                        <input wire:model.live.debounce.200ms="searchToDateIn" type="date" name="datetimeTo" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        {{-- <x-datepicker>
                        </x-datepicker> --}}
                    </div>
                </div>
            </div>
            <hr>
            <div class="flex flex-col gap-5">
                <h1 class="text-3xl text-[#F8971A] tracking-widest font-medium">
                    Completed Date Filter:
                </h1>
                <div class="flex flex-row gap-10">
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
            </div>
        </div>
        <div class="bg-[#F8971A]" style="height: 64px"></div>
        <div class="flex flex-col ml-10 mr-10 overflow-x-auto rounded-2xl"> {{-- Changed to overflow-x-auto for better handling --}}
            <table class="border w-full table-auto max-w-full">
                <thead class="bg-gray-100">
                    <tr class="text-black font-bold h-10">
                        {{-- Basic columns with rowspan=2 --}}
                        <th rowspan="2" class="text-center md:p-4 p-0 md:w-32 w-10 border-r">Techlog ID</th>
                        <th rowspan="2" class="text-center md:p-4 p-0 md:w-96 w-none border-r">Date IN</th>
                        <th rowspan="2" class="text-center md:p-4 p-0 md:w-96 w-none border-r">Customer Name</th>
                        <th rowspan="2" class="text-center md:p-4 p-0 md:w-96 w-none border-r">Brand Type</th>
                        <th rowspan="2" class="text-center md:p-4 p-0 md:w-96 w-none border-r">Serial Number</th>

                        {{-- Status columns with colspan, based on the image structure --}}
                        <th colSpan="2" class="text-center p-4 border">On-Progress</th>
                        <th colSpan="6" class="text-center p-4 border">Pending</th> {{-- 3 iterations * 2 columns = 6 --}}
                        <th colSpan="6" class="text-center p-4 border">RMA to Vendor</th> {{-- 3 iterations * 2 columns = 6 --}}
                        <th colSpan="6" class="text-center p-4 border">On-QC</th> {{-- 3 iterations * 2 columns = 6 --}}
                        <th colSpan="2" class="text-center md:p-4 p-0 md:w-32 w-10 border-r">Complete</th>
                        <th colSpan="2" class="text-center md:p-4 p-0 md:w-32 w-10 border-r">Return to Client</th>
                    </tr>
                    <tr class="border-b font-bold h-10 text-black">
                        {{-- Sub-headers for "User" and "Date" --}}
                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>

                        @for ($i = 1; $i <= 3; $i++)
                            <th class="text-center p-4 border">User {{ $i }}</th> {{-- Added iteration number for clarity --}}
                            <th class="text-center p-4 border">Date {{ $i }}</th>
                        @endfor

                        @for ($i = 1; $i <= 3; $i++)
                            <th class="text-center p-4 border">User {{ $i }}</th>
                            <th class="text-center p-4 border">Date {{ $i }}</th>
                        @endfor

                        @for ($i = 1; $i <= 3; $i++)
                            <th class="text-center p-4 border">User {{ $i }}</th>
                            <th class="text-center p-4 border">Date {{ $i }}</th>
                        @endfor

                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>

                        <th class="text-center p-4 border">User</th>
                        <th class="text-center p-4 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reportData as $row)
                        <tr class="hover:bg-gray-50 text-center border-b h-10">
                            {{-- Directly access the keys from your $reportData structure --}}
                            <td class="p-0 border-l border-r">{{ $row['Techlog ID'] }}</td>
                            <td class="p-0 border-l border-r">{{ $row['Date In'] }}</td>
                            <td class="p-0 border-l border-r">{{ $row['Customer Name'] }}</td>
                            <td class="p-0 border-l border-r">{{ $row['Brand Type'] }}</td>
                            <td class="p-0 border-l border-r">{{ $row['Serial Number'] }}</td>

                            <td class="p-0 border-l border-r">{{ $row['On-Progress User'] }}</td>
                            <td class="p-0 border-l border-r">{{ $row['On-Progress Date'] }}</td>

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-0 border-l border-r">{{ $row['Pending ' . $i . ' User'] }}</td>
                                <td class="p-0 border-l border-r">{{ $row['Pending ' . $i . ' Date'] }}</td>
                            @endfor

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-0 border-l border-r">{{ $row['RMA to Vendor ' . $i . ' User'] }}</td>
                                <td class="p-0 border-l border-r">{{ $row['RMA to Vendor ' . $i . ' Date'] }}</td>
                            @endfor

                            @for ($i = 1; $i <= 3; $i++)
                                <td class="p-0 border-l border-r">{{ $row['On-QC ' . $i . ' User'] }}</td>
                                <td class="p-0 border-l border-r">{{ $row['On-QC ' . $i . ' Date'] }}</td>
                            @endfor

                            <td class="p-0 border-l border-r">{{ $row['Complete User'] }}</td>
                            <td class="p-0 border-l border-r">{{ $row['Complete Date'] }}</td>

                            <td class="p-0 border-l border-r">{{ $row['Return to Client User'] }}</td>
                            <td class="p-0 border-l border-r">{{ $row['Return to Client Date'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="27" class="text-center p-4">No service log data available for this report.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
