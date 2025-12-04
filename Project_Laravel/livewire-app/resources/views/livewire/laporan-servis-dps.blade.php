<div x-data class="">
    <div class="h-fit px-10 flex flex-col gap-10">
        <div class="flex flex-col bg-white shadow-md rounded-lg">
            <div class="flex flex-col gap-10 p-10 mb-10 border-b-2 border-blue-900/20">
                <div class="flex flex-col gap-2">
                    <h1 x-data x-on:click="$dispatch('filter-close')" class=" text-2xl text-[#3385b7] hover:text-[#67d1e4] font-bold cursor-pointer">
                        Pencarian Mendetail
                    </h1>
                    <div class="flex flex-row gap-2">
                        <div class="w-1 bg-[#3385b7]"></div>
                        <p x-data x-on:click="$dispatch('filter-close')" class="text-gray-500 hover:text-gray-800 cursor-pointer">
                            Klik disini untuk memunculkan kolom pencarian & filter
                            <span x-data = "{ show : true}" x-show = "show" x-on:filter-close.window = "show = !show" class="text-[#3385b7]">▽</span>
                            <span x-data = "{ show : false}" x-show = "show" x-on:filter-close.window = "show = !show" class="text-[#3385b7]">▲</span>
                        </p>
                    </div>
                </div>
                <div
                    x-data = "{ show : false}"
                    x-show = "show"
                    x-on:filter-close.window = "show = !show"
                    id="filter1" class="flex flex-wrap justify-around  w-full gap-15 pl-5 pr-5 [&>*]:w-5/12 [&>*]:max-h-fit max-lg:pl-10 max-lg:pr-10">
                    <div class="flex flex-col ">
                        <label for="searchN">
                            Nomor Servis 
                        </label>
                        <input wire:model.live.debounce.200ms="inputNomorServis" type="text" name="" id="searchN" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    </div>
                    <div class="flex flex-col">
                        <label for="searchMN">
                            Nomor Seri (SN) 
                        </label>
                        <input wire:model.live.debounce.200ms="inputNomorSeri" type="text" name="" id="searchMN" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="flex flex-col">
                        <label for="searchE">
                            Nama Produk 
                        </label>
                        <input wire:model.live.debounce.200ms="inputProduk" type="text" name="" id="searchE" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="flex flex-col">
                        <label for="searchAL">
                            Pelanggan 
                        </label>
                        <select wire:model.live.debounce.50ms="inputPelanggan" name="selS" id="ddl" class="w-full min-xl:min-w-[200px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            <option value="" selected>-- Pilih Pelanggan --</option>
                            @foreach($this->allPelanggan as $s)
                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="searchAL">
                            Teknisi 
                        </label>
                        <select wire:model.live.debounce.50ms="inputTeknisi" name="selS" id="ddl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            <option value="" selected>-- Pilih Teknisi --</option>
                            @foreach($this->allUsers as $s)
                                <option value="{{ $s->id }}">{{ $s->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col py-10 gap-3 bg-white shadow-md rounded-lg">
            <div class="flex flex-col gap-3 shadow-lg">
                <div class="flex flex-row px-10 justify-between">
                    <div class="flex flex-row gap-2">
                        <div class="flex justify-center items-center size-[25px] bg-cyan-600 rounded-full ">
                            <div class="border-4 border-white rounded-full size-[18px]"></div>
                        </div>
                        <div class="flex flex-col">
                            <h1 class="font-bold text-xl text-cyan-600">
                                LIST TIKET LAPORAN SERVIS 
                            </h1>
                        </div>
                    </div>
                    <div class="flex flex-row self-end w-fit gap-5">
                        {{-- <a href="{{ route('pelanggan-dps') }}" class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                            Ekspor ▼ --}}
                        {{-- </a> --}}
                        {{-- <a href="" class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                            + Export
                        </a> --}}
                        
                        {{-- wire:click. Defines the action to run --}}
                        {{-- wire:target Defines which action to monitor for loading feedback --}}
                        <button 
                            type="button"
                            wire:click="exportToExcel" 
                            class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg 
                                hover:bg-[#0b4095] cursor-pointer inline-flex items-center justify-center"
                                
                            wire:loading.attr="disabled"
                            wire:target="exportToExcel"
                        >
                            <span wire:loading wire:target="exportToExcel" class="flex items-center">
                                <i class="fas fa-spinner fa-spin mr-2"></i> Mempersiapkan Laporan...
                            </span>
                            <span wire:loading.remove wire:target="exportToExcel" class="flex items-center">
                                <i class="fas fa-file-excel mr-2"></i> Export ▼
                            </span>
                        </button>
                    </div>
                </div>
                <div class="flex flex-row shadow-md px-10 pb-5 gap-10">
                    <div class="flex flex-row gap-3">
                        <div class="flex flex-col justify-center max-xl:w-5/12">
                            <label for="datetimeFrom" class="text-gray-600 pl-1">
                                Rentang Waktu Awal
                            </label>
                            <input wire:model.live.debounce.200ms="inputWaktuAwal" type="date" name="datetimeFrom" value="" 
                                class="min-xl:min-w-[200px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                        <div class="flex flex-col justify-center max-xl:w-5/12">
                            <label for="datetimeTo" class="text-gray-600 pl-1">
                                Rentang Waktu Akhir
                            </label>
                            <input wire:model.live.debounce.200ms="inputWaktuAkhir" type="date" name="datetimeTo" value="" 
                                class="min-xl:min-w-[200px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col mx-10 pt-5 overflow-x-scroll max-md:ml-3 max-md:mr-3">
                <table class=" w-full table-auto min-w-screen max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px] max-md:[&_tbody_tr_td]:text-xs">
                    <thead class="bg-blue-100/70">
                        <tr class="">
                            <th class="text-left p-2">No. Servis</th>
                            <th class="text-left p-2">Status</th>
                            <th class="text-left p-2">Tanggal Permintaan</th>
                            <th class="text-left p-2">Nama Produk</th>
                            <th class="text-left p-2">Nomor Seri (SN)</th>
                            <th class="text-left p-2">Pelanggan</th>
                            <th class="text-left p-2">Teknisi</th>
                            {{-- <th class="text-left p-2">Danger Zone</th> --}}
                            {{-- @if (session('role') == 1)
                                <th class="text-center p-2 text-red-500 ">Danger Zone</th>
                            @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($serviceLogData as $sl)
                            <tr class="border-t hover:bg-blue-50 max-xl:[&>*]:text-[12px] max-lg:[&>*]:text-[10px]">
                                <td class="p-5 pr-10">
                                    <a href="{{ route('detail-servis-dps', ['id' => $sl->id]) }}" class="cursor-pointer text-indigo-500 underline hover:text-indigo-700">
                                        {{ $sl->nomor_service }}
                                    </a>
                                </td>
                                <td class="min-w-60 p-2 pr-3">
                                    @php
                                        $statusType = $sl->status ? $sl->status_dps->id : 'N/A';
                                        $color_map_status = [
                                            '1' => 'bg-gray-500',
                                            '2' => 'bg-green-700',
                                            '3' => 'bg-orange-700/80',
                                            '4' => 'bg-[#5993FF]',
                                        ];
                                        $statusClass = $color_map_status[$statusType] ?? 'bg-gray-500';
                                    @endphp
                                    <span class="{{ $statusClass }} text-white p-1 pl-2 pr-2 rounded-4xl">
                                        {{ $sl->status_dps->status_type }}
                                    </span>
                                </td>
                                <td class="min-w-40 p-2 pr-25">
                                    {{ $sl->waktu_mulai }}
                                </td>
                                <td class="min-w-40 p-2 pr-25">
                                    {{ $sl->produk_dps->nama_produk }}
                                </td>
                                <td class="min-w-40 p-2 pr-25">
                                    {{ $sl->produk_dps->serial_number }}
                                </td>
                                <td class="min-w-40 p-2 pr-25">
                                    {{ $sl->pelanggan_dps->nama }}
                                </td>
                                <td class="min-w-40 p-2 pr-25">
                                    {{ $sl->teknisi_dps->username }}
                                </td>
                                {{-- @if (session(key: 'role') == 2)
                                    <td class="text-center pr-5 text-red-500">
                                        <button x-data
                                                x-on:click="if (confirm('Are you sure you want to DELETE this techlog?')) { $wire.deleteTiketdps({{ $sl->id }}); }"
                                                type="button" 
                                                class="text-white w-fit px-2 py-1 rounded-lg font-bold bg-red-500/80 hover:opacity-60 cursor-pointer">
                                            Delete
                                        </button>
                                    </td>
                                @else
                                    <td>
                                        <i class="text-gray-400">Unavaible</i>
                                    </td>
                                @endif --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="p-4 text-center text-gray-500">Tidak ada data pelanggan yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-10">
                {{ $serviceLogData->links('vendor.livewire.tailwind') }}
            </div>
        </div>
    </div>
</div>
