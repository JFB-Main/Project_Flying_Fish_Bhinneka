<div class="flex flex-col px-15 py-2 gap-10">
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. DASHBOARDDDDDDDDDDDDDDDD DPS --}}
    <div class="flex flex-row gap-5 pr-15 w-full">
        <p class="text-xl font-bold w-fit self-center">DATE FILTIER:</p>
        <div class="flex flex-row gap-5">
            <div class="flex flex-col justify-center min-xl:min-w-[200px] max-xl:w-5/12">
                <label for="datetimeFrom" class="text-sm text-gray-600 pl-1">
                    Datetime From
                </label>
                <input wire:model.live.debounce.200ms="overviewSearchFromDateIn" type="date" name="datetimeFrom" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="flex flex-col justify-center min-xl:min-w-[200px] max-xl:w-5/12">
                <label for="datetimeTo" class="text-sm text-gray-600 pl-1">
                    Datetime To
                </label>
                <input wire:model.live.debounce.200ms="overviewSearchToDateIn" type="date" name="datetimeTo" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
        </div>
    </div>
    <div class="flex flex-col w-[50%] bg-white shadow-md rounded-lg px-10 py-7 gap-10">
        <div class="flex flex-col gap-5 w-full">
            <h1 class="pl-1 text-6xl text-cyan-600">{{ $this->ServiceLogCountTotal }}</h1>
            <p class="font-semibold ">TOTAL SERVIS</p>
        </div>
        <div class="flex flex-row gap-3 justify-end w-full">
            <a href="{{ route('data-servis-dps') }}" class="font-bold text-cyan-600">LIHAT SEMUA</a>
            <p>></p>
        </div>
    </div>
    <div class="flex flex-col w-full bg-white shadow-md rounded-lg px-10 py-7 gap-10">
        <div class="">
            <h2 class="font-semibold text-xl">Jadwal Servis</h2>
        </div>
        <div class="flex flex-row justify-center">
            @foreach($this->statusTypeCounts as $statusName => $amount)
            <div class="border-x-4 w-full border-blue-100">
                <div class="flex flex-row items-center px-2 pr-10 gap-2">
                    <h1 class="pl-1 text-3xl font-bold text-cyan-600">{{$amount}}</h1>
                    <p class="font-medium max-w-[100px]">{{ $statusName }}</p>
                </div>
            </div>
            @endforeach
            {{-- <div class="border-x-4 border-blue-100">
                <div class="flex flex-row items-center px-2 pr-10 gap-2">
                    <h1 class="pl-1 text-3xl font-bold text-cyan-600">0</h1>
                    <p class="font-medium"> Menunggu Pengerjaan</p>
                </div>
            </div>
            <div class="border-x-4 border-blue-100">
                <div class="flex flex-row items-center px-2 pr-10 gap-2">
                    <h1 class="pl-1 text-3xl font-bold text-cyan-600">0</h1>
                    <p class="font-medium"> Dalam Penugasan</p>
                </div>
            </div>
            <div class="border-x-4 border-blue-100">
                <div class="flex flex-row items-center px-2 pr-10 gap-2">
                    <h1 class="pl-1 text-3xl font-bold text-cyan-600">0</h1>
                    <p class="font-medium"> Pekerjaan Selesai</p>
                </div>
            </div>
            <div class="border-x-4 border-blue-100">
                <div class="flex flex-row items-center px-2 pr-10 gap-2">
                    <h1 class="pl-1 text-3xl font-bold text-cyan-600">0</h1>
                    <p class="font-medium"> Pekerjaan Dibatalkan</p>
                </div>
            </div> --}}
        </div>
    </div>
</div>
