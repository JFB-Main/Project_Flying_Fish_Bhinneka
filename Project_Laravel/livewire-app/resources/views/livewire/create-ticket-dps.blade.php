<div x-data wire:submit.prevent="createServis" class="min-h-screen flex flex-col overflow-hidden px-10 pb-20 pt-0 gap-10">
    <form wire:submit.prevent="createServis" class="flex flex-col gap-10">
        <div class="flex flex-col bg-white shadow-md rounded-lg pb-10">
            <div class="flex flex-row p-3 border-b shadow-md border-blue-400/80 gap-2">
                <div class="flex justify-center items-center size-[25px] bg-cyan-600 rounded-full ">
                    <div class="border-4 border-white rounded-full size-[18px]"></div>
                </div>
                <div class="flex flex-col">
                    <h1 class="font-bold text-cyan-600">
                        PELANGGAN 
                    </h1>
                    <p class="text-cyan-600 text-sm">
                        Informasi Pelanggan
                    </p>
                </div>
            </div>
            <div class="flex flex-col gap-10 py-10
                        [&_div_div_label,_div_h1]:min-w-[200px]">
                <div class="flex flex-col gap-10 px-48">
                    <div class="flex flex-row">
                        <h1 class="font-bold">
                            Informasi Pelanggan
                        </h1>
                        <p>
                            Pilih pelanggan yang akan melakukan servis
                        </p>
                    </div>
                    <div class="flex flex-row">
                        <label for="namaPelanggan" class="">
                            Pelanggan<span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col w-full">
                            <select wire:model.live.debounce.50ms="inputPelanggan" name="selS" id="ddl" class="w-full min-xl:min-w-[200px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5
                                    @error('inputPelanggan') border-red-500 @enderror">
                                <option value="" selected>-- Pilih Pelanggan --</option>
                                @foreach($pelangganData as $ped)
                                    <option value="{{ $ped->id }}">{{ $ped->nama }}</option>
                                @endforeach
                            </select>
                            @error('inputPelanggan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-10 px-48 border-y-[2px] border-gray-200 py-10">
                    <div class="flex flex-row">
                        <h1 class="font-bold">
                            Informasi Servis
                        </h1>
                        <p>
                            Pilih alamat dan produk yang di servis
                        </p>
                    </div>
                    <div class="flex flex-row">
                        <label for="namaPelanggan" class="">
                            Pilih Produk<span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col w-full">
                            <select wire:model.live="inputProduk" x-bind:disable="!$wire.inputPelanggan" name="selS" id="ddl" class="w-full min-xl:min-w-[200px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5
                                    @error('inputProduk') border-red-500 @enderror">
                                <option value="" selected>-- Pilih Produk --</option>
                                @foreach($this->produkData as $prd)
                                    <option value="{{ $prd->id }}">{{ $prd->nama_produk }}</option>
                                @endforeach
                            </select>
                            @error('inputProduk')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <label for="NamaAlamat" class="">
                            Alamat Servis
                        </label>
                        <div class="flex flex-col w-full">
                            <p>
                                @if ($ASfetch && $ASfetch->alamatServis_dps)
                                    {{ $ASfetch->alamatServis_dps->nama_alamat }} 
                                @else
                                    -
                                @endif         
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <label for="NamaEmail" class="">
                            Tipe Servis<span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col w-full">
                            <select wire:model.live.debounce.50ms="inputTipeServis" x-bind:disabled="!$wire.inputPelanggan"  name="selS" id="ddl" class="w-full min-xl:min-w-[200px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5
                                   @error('inputTipeServis') border-red-500 @enderror">
                                <option value="" selected>-- Pilih Tipe --</option>
                                @foreach($Tipe as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_tipe_service }}</option>
                                @endforeach
                            </select>
                            @error('inputTipeServis')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <label for="NamaTelepon" class="">
                            Permasalahan<span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col w-full">
                            <textarea wire:model="inputPermasalahan" x-bind:disabled="!$wire.inputPelanggan"  name="preDiagnostic" id="NamaAlamat" class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('inputPermasalahan') border-red-500 @enderror"></textarea>
                            @error('inputPermasalahan')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-10 px-48">
                    <div class="flex flex-row">
                        <h1 class="font-bold">
                            Informasi Teknisi
                        </h1>
                        <p>
                            Pilih teknisi dan tentukan jadwal kunjungan
                        </p>
                    </div>
                    <div class="flex flex-row">
                        <label for="namaPelanggan" class="">
                            Jadwal Kunjungan
                            {{-- <span class="text-red-500">*</span> --}}
                        </label>
                        <div class="flex flex-col w-full">
                            <input wire:model="inputJadwalKunjungan" type="date" name="namaPelanggan" id="namaPelanggan" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('inputJadwalKunjungan') border-red-500 @enderror">
                                @error('inputJadwalKunjungan')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <label for="namaPelanggan" class="">
                            Teknisi Ditugaskan<span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col w-full">
                            <select wire:model.live.debounce.50ms="inputPilihTeknisi" name="selS" id="ddl" class="w-full min-xl:min-w-[200px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 
                            @error('inputTipeServis') border-red-500 @enderror">
                                <option value="" selected>-- Pilih Teknisi --</option>
                                @foreach($this->teknisi as $s)
                                    <option value="{{ $s->id }}">{{ $s->username }}</option>
                                @endforeach
                            </select>
                                @error('inputPilihTeknisi')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row w-full justify-end">
            <button class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-xl text-white font-medium p-1 pl-3 pr-3 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                Submit
            </button>
        </div>
        <div class="flex flex-col pl-10 pr-10 gap-10 items-center">
            {{-- General Session Messages (Success/Error from form submission) --}}
            @if (session()->has('success'))
                <div class="w-full pl-10 pr-10" role="alert">
                    <p class="bg-green-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-green-400">
                    Success: <span class="text-green-600 text-lg font-medium">{{ session('success') }}</span>
                    </p>
                </div>
            @endif

            {{-- Display error message if it exists (e.g., from try-catch) --}}
            @if (session()->has('error'))
                <div class="w-full pl-10 pr-10" role="alert">
                    <p class="bg-red-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-red-400">
                        Error: <span class="text-red-600 text-lg font-medium">{{ session('error') }}</span>
                    </p>
                </div>
            @endif
        </div>
    </form>
</div>
