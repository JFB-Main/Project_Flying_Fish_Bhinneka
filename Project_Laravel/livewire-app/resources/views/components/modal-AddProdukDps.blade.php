@props(['name', 'title'])

<div
    id="pop-up"
    x-data = "{ show : false, name : '{{$name}}', modalData: { as_id: null }}"
    x-show = "show"
    x-on:open-modal.window = "show = ($event.detail.name === name); modalData = $event.detail"
    x-on:close-modal.window = "show = false"
    x-on:keydown.escape.window = "show = false"

    style="display: none;"
    x-transition.duration

    class="fixed z-50 inset-0 ">
    <div x-on:click="show = false; $dispatch('close-modal')" class="fixed inset-0 bg-[#030D26] opacity-50"></div>
    <div class="bg-white rounded-b rounded-r rounded-l m-auto fixed inset-0 max-w-xl mb-auto mt-auto h-5/6 max-h-fit shadow-xs shadow-yellow-500 border-t-4 border-[#F8971A]" >

        <form x-data @submit.prevent="$wire.call('addProduk', modalData.as_id)" class="flex flex-col items-center pt-5 pb-5">
            <div class="flex flex-col gap-2 items-center w-full">
                <div>
                    <h1 class="text-3xl text-cyan-600 font-bold self-center">
                        Tambah Product 
                        {{-- <span x-text="modalData.as_id ? '(AS ID: ' + modalData.as_id + ')' : 'afdwdwa'"></span> --}}
                    </h1>
                </div>
                <div class="bg-cyan-600 border-gray-100 border-t w-full" style="height: 2px;"></div>
                <div class="flex flex-col gap-10 ">
                    <div class="flex flex-row">
                        <label for="namaProduk" class="">
                            Nama Produk<span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col w-full">
                            <input wire:model="namaProduk" type="text" name="namaProduk" id="namaProduk" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('namaProduk') border-red-500 @enderror">
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
                            <input wire:model="serialNumber" type="text" name="serialNumber" id="serialNumber" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('serialNumber') border-red-500 @enderror">
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
                            <input wire:model="skuProduk" type="text" name="skuProduk" id="skuProduk" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('skuProduk') border-red-500 @enderror">
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
                            <input wire:model="nomorInvoice" type="text" name="nomorInvoice" id="nomorInvoice" placeholder="Atau nomor sales order" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nomorInvoice') border-red-500 @enderror">
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
            <div class="flex flex-row justify-between pl-5 pr-5 w-full gap-5">
                <button type="button" wire:click="$dispatch('close-modal')" class="bg-red-500/80 max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg hover:opacity-60 cursor-pointer">
                    Close
                </button>
                <button type="submit" class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>