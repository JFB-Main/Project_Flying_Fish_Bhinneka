<div class="flex flex-col px-24 gap-10 w-full">
    @php
        // 1. Parse the timestamps into Carbon objects
        $start = \Carbon\Carbon::parse($serviceData->waktu_selesai);
        $end = \Carbon\Carbon::parse($serviceData->waktu_mulai);
        
        // 2. Calculate the total difference in seconds (the base unit)
        $totalSeconds = $end->diffInSeconds($start);
        
        // 3. Calculate Hours, Minutes, and remaining Seconds
        $hours = floor($totalSeconds / 3600); // 3600 seconds in an hour
        $minutes = floor(($totalSeconds % 3600) / 60); // Remaining seconds divided by 60
        $seconds = $totalSeconds % 60; // Remaining seconds
        
        // 4. Format the output with leading zeros (HH:MM:SS)
        $formattedDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    @endphp

    <div class="flex flex-col items-center gap-1">
        <h1 class="text-xl font-bold tracking-widest">
            SERVICE REPORT
        </h1>
        <p class="text-lg">
            #{{ $serviceData->nomor_service }}
        </p>
    </div>
    <div class="flex flex-col gap-20">
        <div class="flex flex-col gap-10">
            <div class="flex flex-row
                        [&_div_div_h1,_div_h2]:font-semibold [&_div_div_h1]:text-xs 
                        [&_div_h2]:tracking-widest
                        [&_div_div_p]:text-gray-600 [&_div_div_p]:font-medium [&_div_div_p,_div_h2]:text-[10px]">
                <div class="flex flex-col gap-3 min-w-[225px] max-w-[225px]">
                    <h2 class="">
                        UNIT INFO:
                    </h2>
                    <div class="flex flex-col gap-1">
                        <h1 class="">
                            {{ $serviceData->produk_dps->nama_produk }}
                        </h1>
                        <p class="">
                            SERIAL NUMBER: {{ $serviceData->produk_dps->serial_number }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-row gap-10">
                    <div class="flex flex-col gap-3">
                        <h2 class="">
                            CUSTOMER INFO:
                        </h2>
                        <div class="flex flex-col gap-1 max-w-[175px]">
                            <h1 class="">
                                {{ $serviceData->pelanggan_dps->nama }}
                            </h1>
                            <p class="">
                                {{ $serviceData->produk_dps?->alamatServis_dps?->nama_alamat }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        <h2 class="">
                            TECHNICIAN:
                        </h2>
                        <div class="flex flex-col gap-1 max-w-[175px]">
                            <h1 class="">
                                {{ $serviceData->teknisi_dps->username }}
                            </h1>
                            <p class="">
                                Scheduled on {{ $serviceData->jadwal_kunjungan }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="flex flex-col gap-2 w-full border-b-3 border-gray-200 pb-2">
                <h1 class="font-semibold text-xs">WARRATY END:</h1>
                <p class="text-xs text-gray-600">1 DECEMBER 2025</p>
            </div> --}}
            <div class="w-full h-[3px] bg-gray-200"></div>
            <div class="flex flex-row
                        [&_div_div_h1,_div_h2]:font-semibold [&_div_div_h1]:text-xs 
                        [&_div_h2]:tracking-widest
                        [&_div_div_p]:text-gray-600 [&_div_div_p]:font-medium [&_div_div_p,_div_h2]:text-[10px]">
                <div class="flex flex-col gap-3 min-w-[225px] max-w-[225px]">
                    <h2 class="">
                        REQUEST DATE:
                    </h2>
                    <div class="flex flex-col gap-1">
                        <h1 class="">
                            {{ \Carbon\Carbon::parse($serviceData->waktu_mulai)->format('d M Y') }} 
                        </h1>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <h2 class="">
                        PROBLEM INFO:
                    </h2>
                    <div class="flex flex-col gap-1 max-w-[175px]">
                        <h1 class="">
                            {{ $serviceData->permasalahan }}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="flex flex-row
                        [&_div_div_h1,_div_h2]:font-semibold [&_div_div_h1]:text-xs 
                        [&_div_h2]:tracking-widest
                        [&_div_div_p]:text-gray-600 [&_div_div_p]:font-medium [&_div_div_p,_div_h2]:text-[10px]">
                <div class="flex flex-col gap-3 min-w-[225px] max-w-[225px]">
                    <h2 class="">
                        ACTIVITY:
                    </h2>
                    <div class="flex flex-col gap-1">
                        <h1 class="">
                            {{ \Carbon\Carbon::parse($serviceData->waktu_mulai)->format('d M Y') }} 
                            - 
                            {{ \Carbon\Carbon::parse($serviceData->waktu_selesai)->format('d M Y') }}
                        </h1>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <h2 class="">
                        TOTAL HOURS:
                    </h2>
                    <div class="flex flex-col gap-1 max-w-[175px]">
                        <h1 class="">
                            {{$formattedDuration}}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <table class="">
                <thead class="border border-t-2 border-gray-300">
                    <th class="bg-gray-100 w-[200px] text-gray-700 text-left text-sm p-2">
                        Date
                    </th>
                    <th class="text-left text-gray-700 p-2 text-sm">
                        Note
                    </th>
                </thead>
                <tbody>
                    @forelse($note as $n)
                        <tr class=" border border-gray-300">
                            <td class="bg-gray-50 pl-2 pt-2 align-top font-light text-gray-600 text-xs">{{$n->created_at}}</td>
                            <td class="p-2 font-light text-gray-600 text-[10px]">{{$n->note_content}}</td>
                        </tr>
                    @empty
                        <tr class=" border border-gray-300">
                            <td colspan="9" class="p-2 font-light text-gray-600 text-[10px]">Tidak ada log aktivitas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- START OF NEW PAGE CONTENT --}}
    {{-- Add the break-before-page class or the custom CSS utility here --}}
    <div class="flex flex-col gap-20 break-before-page print:break-before-page ">
        <div class="flex flex-col gap-40">
            <h1 class="text-gray-600 text-[10px] font-semibold">
                APPROVED BY
            </h1>
            <p class="text-gray-600 font-semibold text-sm">
                BHINNEKA MENTARIDIMENS, PT.
            </p>
        </div>
        <div class="flex flex-col gap-5 w-[150px]
                    [&_div_p]:text-gray-600 [&_div_h1]:text-gray-700 [&_div_h1,_div_p]:text-[10px] [&_div_h1]:font-semibold">
            <div class="flex flex-col gap-1">
                <h1 class="">
                    BANK ACCOUNT
                </h1>
                <p class="">
                    PT. Bhinneka Mentaridimensi BCA 0017403790
                </p>
            </div>
            <div class="flex flex-col gap-1">
                <h1 class="">
                    SERVICE ADDRESS
                </h1>
                <p class="">
                   Jl. Danau Sunter Selatan Blok O4, Kav.30-31 No.12B, Sunter Jaya Jakarta 14350
                </p>
            </div>
            <div class="flex flex-col gap-1">
                <h1 class="">
                    CALL CENTER
                </h1>
                <p class="">
                    +62 811-1705-312
                </p>
            </div>
        </div>
    </div>
    {{-- Stop trying to control. {{ $serviceData->id }} --}}

    {{-- <div class="flex flex-col gap-15">
        <div>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </div>
        <div>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </div>
        <div>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </div>
        <div>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </div>
        <div>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </div>
        <div>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </div>
        <div>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </div>
    </div> --}}
</div>
