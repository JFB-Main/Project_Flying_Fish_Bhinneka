<div class="min-h-screen flex flex-col overflow-hidden px-10 pb-20 pt-0 gap-10 [&_section]:border-b-3 [&_section]:border-blue-900/10 [&_section]:pb-10">
    <div class="flex flex-col bg-white shadow-md rounded-lg">
        <div class="flex flex-row p-5 border-b border-blue-400/80 gap-2">
            <div class="flex justify-center items-center size-[25px] bg-cyan-600 rounded-full ">
                <div class="border-4 border-white rounded-full size-[18px]"></div>
            </div>
            <div class="flex flex-col items-center">
                <h1 class="font-bold text-cyan-600 text-xl">
                    Profil Pelanggan 
                </h1>
            </div>
        </div>
        <div class="flex flex-col gap-10 px-48 py-10
                    [&_div_label,_div_div_p]:min-w-[160px]">
            <div class="flex flex-row">
                <label for="namaPelanggan" class="font-bold">
                    Nama Pelanggan
                </label>
                <div class="flex flex-col w-full">
                    <p class="text-justify">
                        {{ $qp->nama }}
                    </p>
                </div>
            </div>
            <div class="flex flex-row">
                <label for="NamaEmail" class="font-bold">
                    Alamat Email
                </label>
                <div class="flex flex-col w-full">
                    <p>
                        {{ $qp->email }}
                    </p>
                </div>
            </div>
            <div class="flex flex-row">
                <label for="NamaTelepon" class="font-bold">
                    Telepon
                </label>
                <div class="flex flex-col w-full">
                    <p>
                        {{ $qp->nomor_telepon }}
                    </p>
                </div>
            </div>
            <div class="flex flex-row">
                <label for="NamaAlamat" class="font-bold">
                    Alamat
                </label>
                <div class="flex flex-col w-full">
                    <p>
                        {{ $qp->alamat }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col bg-white shadow-md rounded-lg"
            x-data
            x-on:open-modal-alamat-add-dps.window="toggleScroll()" 
            x-on:close-modal-alamat-add-dps.window="toggleScroll()"
            x-on:keydown.escape.window="toggleKeydownScroll()">
        <div class="flex flex-row p-5 border-b shadow-lg items-center justify-between border-blue-400/80">
            <div class="flex flex-row gap-2 items-center">
                <div class="flex justify-center items-center size-[25px] bg-cyan-600 rounded-full ">
                    <div class="border-4 border-white rounded-full size-[18px]"></div>
                </div>
                <div class="flex flex-col">
                    <h1 class="font-bold text-cyan-600 text-xl">
                        Alamat Servis 
                    </h1>
                </div>
            </div>
            <a  x-data x-on:click="$dispatch('open-modal-alamat-add-dps', { name: 'test', slId_For_UpdateStatusId: {{ $qp->id }} })"  
                class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                + Tambah
            </a>
        </div>
        <div class="flex flex-col">
            @if ($qp)
                @foreach ($qp->alamatServis_dps as $alamatServis)
                    <div class="flex flex-col w-full gap-3 px-18 py-10 border border-gray-300 shadow-md
                                [&_div_label,_div_div_p]:min-w-[160px]">
                        <div class="flex flex-row bg-[#132c53] justify-between rounded-t-lg px-5 py-2 shadow-lg items-center">
                            <h1 class="font-bold w-fit text-white">{{ $alamatServis->nama_alamat }}</h1>
                            <div class="flex flex-row gap-5 w-fit min-w-60">
                                <button  x-data x-on:click="$dispatch('open-modal', {name: 'addproduct+', as_id: {{ $alamatServis->id }}})"  
                                    class="bg-white border border-[#132c53] max-w-fit max-h-fit text-sm font-medium p-2 pl-4 pr-4 rounded-lg hover:opacity-90 cursor-pointer">
                                    + Tambah Produk
                                </button>
                                <button  x-data x-on:click="$dispatch('open-modal', {name: 'editalamat+',  as_id: {{ $alamatServis->id }}})"  
                                    class="bg-white border border-[#132c53] max-w-fit max-h-fit text-sm font-medium p-2 pl-4 pr-4 rounded-lg hover:opacity-90 cursor-pointer">
                                    Edit Alamat
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col overflow-x-scroll rounded-lg max-md:ml-3 max-md:mr-3">
                            <table class="w-full table-auto max-w-full max-xl:text-sm max-lg:text-[10px] max-lg:[&_tbody_tr_td]:text-[10px] max-md:[&_tbody_tr_td]:text-xs">
                                <thead class="bg-gray-100 shadow-md">
                                    <tr class="">
                                        <th class="text-left p-2">Nama Produk</th>
                                        <th class="text-left p-2">Serial Number</th>
                                        <th class="text-left p-2">SKU Produk</th>
                                        <th class="text-left p-2">Nomor Invoice</th>
                                        <th class="text-left p-2">Produk Bhinneka</th>
                                        <th class="text-left p-2">Action</th>
                                        @if (session('role') == 1)
                                            <th class="text-center p-2 text-red-500 ">Danger Zone</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($alamatServis->produks_dps as $p)
                                        <tr class="border-t hover:bg-blue-50 max-xl:[&>*]:text-[12px] max-lg:[&>*]:text-[10px]">
                                            <td class="min-w-25 p-4 py-8">{{ $p->nama_produk }}</td>
                                            <td class="min-w-25 p-4">{{ $p->serial_number }}</td>
                                            <td class="min-w-25 p-4">{{ $p->sku_produk }}</td>
                                            <td class="min-w-25 p-4">{{ $p->nomor_invoice_so }}</td>
                                            <td>
                                                @if ($p->produk_bhinneka == true)
                                                    <div class="text-white w-fit px-2 py-1 rounded-lg font-bold bg-green-500/90">
                                                        Produk Bhinneka
                                                    </div>
                                                @else
                                                    <div class="text-white w-fit px-2 py-1 rounded-lg font-bold bg-red-500/80">
                                                        Bukan Produk
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <button  x-data x-on:click="$dispatch('open-modal', {
                                                    name: 'editproduct+',  
                                                    as_id: {{ $p->id }},
                                                    product_name: '{{ $p->nama_produk }}'
                                                    })"  
                                                    class="text-white w-fit px-4 py-1 rounded-lg font-bold bg-yellow-400 hover:opacity-60 cursor-pointer">
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="p-4 text-center italic font-semibold text-gray-400">Tidak Ada Produk Untuk Alamat Servis Ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Pelanggan tidak ditemukan.</p>
            @endif
        </div>
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
    <x-modal-UpdatePopUpDps name="test" title="Test">
        @slot('body')
            <livewire:add-alamat-servis/>
        @endslot
    </x-modal-UpdatePopUpDps>
    <x-modal-AddProdukDps name="addproduct+" title="Test">
    </x-modal-AddProdukDps>
    <x-modal-EditProdukDps name="editproduct+" title="Test">
    </x-modal-EditProdukDps>
    <x-modal-EditAlamatDps name="editalamat+" title="Test">
    </x-modal-EditAlamatDps>
</div>
