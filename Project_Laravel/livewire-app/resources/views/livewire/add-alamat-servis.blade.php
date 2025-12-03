<div>
    {{-- Success is as dangerous as failure. {{ $this->selectedId }} --}}
    {{-- <form wire:submit.prevent="addAlamatServis">
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
                    <label for="NamaAlamatServis" class="">
                        Alamat<span class="text-red-500">*</span>
                    </label>
                    <div class="flex flex-col w-full">
                        <textarea wire:model="inputAlamat" name="preDiagnostic" id="NamaAlamatServis" 
                                class="min-h-32 bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('inputAlamat') border-red-500 @enderror"></textarea>
                        @error('inputAlamat')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <button>
            submit
        </button>
    </form> --}}

    <form wire:submit.prevent="addAlamatServis" class="flex flex-col items-center pt-5 pb-5">
        <div class="flex flex-col gap-2 items-center w-full">
            <div>
                <h1 class="text-3xl text-cyan-600 font-bold self-center">
                    Add Alamat Servis
                </h1>
            </div>
            <div class="bg-cyan-600 border-gray-100 border-t w-full" style="height: 2px;"></div>
            <div class="flex flex-col gap-2 w-full p-5">
                <label for="NamaAlamatServis" class="ml-2 block text font-bold text-[#302714]">
                    Alamat Servis:
                </label>
                <textarea
                    type="textarea"
                    id="NamaAlamatServis"
                    style="min-height: 300px"
                    wire:model="inputAlamat" 
                    class="w-full bg-gray-50 border overflow-y-auto border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 p-2.5 @error('inputAlamat') border-red-500 @enderror"
                    {{-- wire:model="someFieldToUpdate" Example: bind to a Livewire property for input --}}
                >
                </textarea>
                @error('inputAlamat')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <div class="flex flex-row justify-between pl-5 pr-5 w-full gap-5">
            <button type="button" wire:click="$dispatch('close-modal-alamat-add-dps')" class="bg-red-500/80 max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg hover:opacity-60 cursor-pointer">
                Close
            </button>
            <button type="submit" class="bg-[#0f387a] border border-[#132c53] max-w-fit max-h-fit text-white font-medium p-2 pl-4 pr-4 rounded-lg hover:bg-[#0b4095] cursor-pointer">
                Create
            </button>
        </div>
    </form>
</div>
