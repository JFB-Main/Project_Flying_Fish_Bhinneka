<div x-data class="">
    <div class="h-fit px-10 flex flex-col gap-10">
        <div class="flex flex-col bg-white shadow-md rounded-lg">
            <div class="flex flex-col gap-10 p-10 mb-10 border-b-2 border-blue-900/20">
                <div class="flex flex-col gap-2">
                    <h1 x-data x-on:click="$dispatch('filter-close')" class=" text-2xl text-[#3385b7] hover:text-[#67d1e4] font-bold cursor-pointer">
                        Pencarian
                    </h1>
                    <div class="flex flex-row gap-2">
                        <div class="w-1 bg-[#3385b7]"></div>
                        <p x-data x-on:click="$dispatch('filter-close')" class="text-gray-500 hover:text-gray-800 cursor-pointer">
                            Klik disini untuk memunculkan kolom pencarian 
                            <span x-data = "{ show : true}" x-show = "show" x-on:filter-close.window = "show = !show" class="text-[#3385b7]">▽</span>
                            <span x-data = "{ show : false}" x-show = "show" x-on:filter-close.window = "show = !show" class="text-[#3385b7]">▲</span>
                        </p>
                    </div>
                </div>
                <div
                    x-data = "{ show : false}"
                    x-show = "show"
                    x-on:filter-close.window = "show = !show"
                    id="filter1" class="flex flex-wrap justify-around w-full gap-15 pl-5 pr-5 [&>*]:w-5/12 [&>*]:max-h-fit max-lg:pl-10 max-lg:pr-10">
                    <div class="flex flex-col ">
                        <label for="searchN">
                            Nama Pelanggan 
                        </label>
                        <input wire:model.live.debounce.200ms="namaSearch" type="text" name="" id="searchN" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    </div>
                    <div class="flex flex-col">
                        <label for="searchMN">
                            Nomor Telepon 
                        </label>
                        <input wire:model.live.debounce.200ms="teleponSearch" type="text" name="" id="searchMN" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="flex flex-col">
                        <label for="searchE">
                            Email 
                        </label>
                        <input wire:model.live.debounce.200ms="emailSearch" type="text" name="" id="searchE" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div class="flex flex-col">
                        <label for="searchAL">
                            Alamat 
                        </label>
                        <input wire:model.live.debounce.200ms="alamatSearch" type="text" name="" id="searchAL" placeholder="Search..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col py-10 gap-3 bg-white shadow-md rounded-lg">
            <div class="flex flex-row px-10 pb-5 justify-between shadow-lg">
                <div class="flex flex-row gap-2">
                    <div class="flex justify-center items-center size-[25px] bg-cyan-600 rounded-full ">
                        <div class="border-4 border-white rounded-full size-[18px]"></div>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-bold text-xl text-cyan-600">
                            LIST PELANGGAN 
                        </h1>
                    </div>
                </div>
                <div class="flex flex-row self-end w-fit gap-5">
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
                    <a href="{{ route('pelanggan-dps') }}" class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                        + Tambah
                    </a>
                </div>
            </div>
            <div class="flex flex-col mx-10 pt-5 overflow-x-scroll max-md:ml-3 max-md:mr-3">
                <table class=" w-full table-auto min-w-screen max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px] max-md:[&_tbody_tr_td]:text-xs">
                    <thead class="bg-blue-100/70">
                        <tr class="">
                            <th class="text-left p-2">Nama</th>
                            <th class="text-left p-2">Email</th>
                            <th class="text-left p-2">Telepon</th>
                            <th class="text-left p-2">Alamat</th>
                            @if (session('role') == 1)
                                <th class="text-center p-2 text-red-500 ">Danger Zone</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($query_pelanggan as $qp)
                            <tr class="border-t hover:bg-blue-50 max-xl:[&>*]:text-[12px] max-lg:[&>*]:text-[10px]">
                                <td class="p-5 pr-10">
                                    <a href="{{ route('detail-pelanggan-dps', ['id' => $qp->id]) }}" class="cursor-pointer text-indigo-500 underline hover:text-indigo-700">
                                        {{ $qp->nama }}
                                    </a>
                                </td>
                                <td class="min-w-40 p-2 pr-25">{{ $qp->email }}</td>
                                <td class="min-w-40 p-2 pr-25">{{ $qp->nomor_telepon }}</td>
                                <td class="p-2 max-md:min-w-30">{{ $qp->alamat }}</td>
                                @if (session(key: 'role') == 1)
                                    <td class="text-center p-2 text-red-500">d</td>
                                @endif
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
                {{ $query_pelanggan->links('vendor.livewire.tailwind') }}
            </div>
        </div>
    </div>

    <script>
        function showFilter1() {
            var x = document.getElementById("filter1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</div>
