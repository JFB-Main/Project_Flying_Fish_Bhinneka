<div x-data="scrollSections()" class="min-h-screen flex flex-col overflow-hidden px-10 pt-0 gap-10 [&_section]:border-b-3 [&_section]:border-blue-900/10 [&_section]:pb-10">
    <form wire:submit.prevent="addPelanggan">
        <section id="section-1" class="h-fit px-2 flex flex-col gap-10">
            <div class="flex flex-col bg-white shadow-md rounded-lg">
                <div class="flex flex-row p-3 border-b border-blue-400/80 gap-2">
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
                <div class="flex flex-col gap-10 px-48 py-10
                            [&_div_div_label,_div_h1]:min-w-[160px]">
                    <div class="flex flex-row">
                        <h1 class="font-bold">
                            Informasi Dasar
                        </h1>
                        <p>
                            Masukkan Informasi Pelanggan
                        </p>
                    </div>
                    <div class="flex flex-col gap-10">
                        <div class="flex flex-row">
                            <label for="namaPelanggan" class="">
                                Nama Pelanggan<span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col w-full">
                                <input wire:model="namaPelanggan" type="text" name="namaPelanggan" id="namaPelanggan" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('namaPelanggan') border-red-500 @enderror">
                                    @error('namaPelanggan')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <label for="NamaEmail" class="">
                                Email<span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col w-full">
                                <input wire:model="email" type="text" name="NamaEmail" id="NamaEmail" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <label for="NamaTelepon" class="">
                                Telepon<span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col w-full">
                                <input wire:model="telepon" type="text" name="NamaTelepon" id="NamaTelepon" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('telepon') border-red-500 @enderror">
                                @error('telepon')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <label for="NamaAlamat" class="">
                                Alamat<span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col w-full">
                                <textarea wire:model="alamatPelanggan" name="preDiagnostic" id="NamaAlamat" class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('alamatPelanggan') border-red-500 @enderror"></textarea>
                                @error('alamatPelanggan')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="flex justify-end">
                <button @click="scrollSections('section-1', 'next')"  class="bg-[#132c53] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-1 pl-3 pr-3 rounded-lg hover:bg-[#0f387a] cursor-pointer">
                    Selanjutnya
                </button>
            </div> --}}
        </section>
        <section id="section-2" class="h-fit px-2 pt-10 flex flex-col gap-10">
            <div class="flex flex-col bg-white shadow-md rounded-lg">
                <div class="flex flex-row p-3 border-b border-blue-400/80 gap-2">
                    <div class="flex justify-center items-center size-[25px] bg-cyan-600 rounded-full ">
                        <div class="border-4 border-white rounded-full size-[18px]"></div>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-bold text-cyan-600">
                            ALAMAT SERVIS 
                        </h1>
                        <p class="text-cyan-600 text-sm">
                            Informasi Alamat Servis
                        </p>
                    </div>
                </div>
                <div class="flex flex-col gap-10 px-48 py-10
                            [&_div_div_label,_div_h1]:min-w-[160px]">
                    <div class="flex flex-row">
                        <h1 class="font-bold">
                            Alamat Servis
                        </h1>
                        <p>
                            Masukkan Informasi Alamat Servis
                        </p>
                    </div>
                    <div class="flex flex-col gap-10 ">
                        <div class="flex flex-row">
                            <label for="namaPelanggan" class="">
                                
                            </label>
                            <div class="flex flex-row gap-3 items-center">
                                <input wire:model="isAddressSame" type="checkbox" name="isAddressSame" id="isAddressSame" class="size-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 @error('') border-red-500 @enderror">
                                <p>Sama dengan alamat pelanggan</p>
                            </div>
                            @error('')
                                <span class="text-red-500 text-sm">{{ 'isi' }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-row">
                            <label for="NamaAlamatServis" class="">
                                Alamat<span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col w-full">
                                <textarea wire:model="alamatServis" name="preDiagnostic" id="NamaAlamatServis" class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('alamatServis') border-red-500 @enderror"
                                        x-bind:disabled="$wire.isAddressSame"></textarea>
                                @error('alamatServis')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="flex flex-row justify-end gap-5">
                <button @click="scrollSections('section-1', 'previous')"  class="bg-white border border-blue-900/50 max-w-fit max-h-fit text-[#132c53] font-medium p-1 pl-3 pr-3 rounded-lg hover:bg-[#0f387a] hover:text-white cursor-pointer">
                    Sebelumnya
                </button>
                <button @click="scrollSections('section-2', 'next')"  class="bg-[#132c53] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-1 pl-3 pr-3 rounded-lg hover:bg-[#0f387a] cursor-pointer">
                    Selanjutnya
                </button>
            </div> --}}
        </section>
        <section id="section-3" class="h-fit pt-10 px-2 flex flex-col gap-10">
            <div class="flex flex-col bg-white shadow-md rounded-lg">
                <div class="flex flex-row p-3 border-b border-blue-400/80 gap-2">
                    <div class="flex justify-center items-center size-[25px] bg-cyan-600 rounded-full ">
                        <div class="border-4 border-white rounded-full size-[18px]"></div>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-bold text-cyan-600">
                            PRODUK 
                        </h1>
                        <p class="text-cyan-600 text-sm">
                            Informasi Produk Di Servis
                        </p>
                    </div>
                </div>
                <div class="flex flex-col gap-10 px-48 py-10
                            [&_div_div_label,_div_h1]:min-w-[160px]">
                    <div class="flex flex-row">
                        <h1 class="font-bold">
                            Info Produk
                        </h1>
                        <p>
                            Masukkan informasi produk yang akan di servis
                        </p>
                    </div>
                    <div class="flex flex-col gap-10 ">
                        <div class="flex flex-row">
                            <label for="namaPelanggan" class="">
                                
                            </label>
                            <div class="flex flex-row gap-3 items-center">
                                <input wire:model="isNoProduct" type="checkbox" name="isNoProduct" id="isNoProduct" class="size-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 @error('') border-red-500 @enderror">
                                <p>Tidak ada produk yang ingin di input</p>
                            </div>
                            @error('')
                                <span class="text-red-500 text-sm"></span>
                            @enderror
                        </div>
                        <div class="flex flex-row">
                            <label for="namaProduk" class="">
                                Nama Produk<span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col w-full">
                                <input x-bind:disabled="$wire.isNoProduct"
                                        wire:model="namaProduk" type="text" name="namaProduk" id="namaProduk" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('namaProduk') border-red-500 @enderror">
                                @error('namaProduk')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <label for="serialNumber" class="">
                                Serial Number<span class="text-red-500">*</span>
                            </label>
                            <div class="flex flex-col w-full">
                                <input x-bind:disabled="$wire.isNoProduct"
                                        wire:model="serialNumber" type="text" name="serialNumber" id="serialNumber" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('serialNumber') border-red-500 @enderror">
                                @error('serialNumber')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <label for="skuProduk" class="">
                                SKU Produk
                            </label>
                            <div class="flex flex-col w-full">
                                <input x-bind:disabled="$wire.isNoProduct"
                                        wire:model="skuProduk" type="text" name="skuProduk" id="skuProduk" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('skuProduk') border-red-500 @enderror">
                                @error('skuProduk')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <label for="nomorInvoice" class="">
                                Nomor Invoice
                            </label>
                            <div class="flex flex-col w-full">
                                <input x-bind:disabled="$wire.isNoProduct"
                                        wire:model="nomorInvoice" type="text" name="nomorInvoice" id="nomorInvoice" placeholder="Atau nomor sales order" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nomorInvoice') border-red-500 @enderror">
                                @error('nomorInvoice')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <label for="namaPelanggan" class="">
                            </label>
                            <div class="flex flex-row gap-3 items-center">
                                <input wire:model="isBhinnekaProduct" type="checkbox" name="isBhinnekaProduct" id="isBhinnekaProduct" class="size-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 @error('') border-red-500 @enderror">
                                <p>Produk Bhinneka</p>
                            </div>
                            @error('')
                                <span class="text-red-500 text-sm">{{ 'isi' }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-row justify-end gap-5">
                {{-- <button @click="scrollSections('section-3', 'previous')"  class="bg-white border border-blue-900/50 max-w-fit max-h-fit text-[#132c53] font-medium p-1 pl-3 pr-3 rounded-lg hover:bg-[#0f387a] hover:text-white cursor-pointer">
                    Sebelumnya
                </button> --}}
                <button class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-1 pl-3 pr-3 rounded-lg hover:bg-[#0b4095] cursor-pointer">
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
        </section>
    </form>

    <script>
        function scrollSections() {
            return {
                // 1. MUST DEFINE the array of IDs used by the function
                sectionIds: ['section-1', 'section-2', 'section-3'],

                // 2. The method itself
                scrollSections(currentSectionId, direction = 'next') {
                    const currentIndex = this.sectionIds.indexOf(currentSectionId);
                    let targetIndex = currentIndex;

                    if (direction === 'next') {
                        targetIndex = currentIndex + 1;

                        // Check if we've reached the last section
                        if (targetIndex >= this.sectionIds.length) {
                            // Scroll to the top of the page
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            return;
                        }
                    } else if (direction === 'previous') {
                        targetIndex = currentIndex - 1;

                        // Check if we've reached the first section
                        if (targetIndex < 0) {
                            // Stop at the first section
                            return; 
                        }
                    } else {
                        return; // Invalid direction
                    }

                    // Scroll to the defined section
                    const targetSectionId = this.sectionIds[targetIndex];
                    const targetElement = document.getElementById(targetSectionId);

                    if (targetElement) {
                        targetElement.scrollIntoView({ 
                            behavior: 'smooth'
                        });
                    }
                }
            }
        }
    </script>
</div>
