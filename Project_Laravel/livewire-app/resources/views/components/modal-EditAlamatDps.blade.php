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

        <form x-data @submit.prevent="$wire.call('editAlamat', modalData.as_id)" class="flex flex-col items-center pt-5 pb-5">
            <div class="flex flex-col gap-2 items-center w-full">
                <div>
                    <h1 class="text-3xl text-cyan-600 font-bold self-center">
                        Edit Alamat 
                        {{-- <span x-text="modalData.as_id ? '(AS ID: ' + modalData.as_id + ')' : 'afdwdwa'"></span> --}}
                    </h1>
                </div>
                <div class="bg-cyan-600 border-gray-100 border-t w-full" style="height: 2px;"></div>
                <div class="flex flex-col gap-10 py-5 w-full px-5">
                    <div class="flex flex-col w-full">
                        <label for="namaProduk" class="">
                            Nama Alamat<span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-col w-full">
                            <textarea type="textarea" wire:model="editnamaAlamat"  id="editnamaAlamat" style="min-height: 300px" class="w-full bg-gray-50 border overflow-y-auto border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 p-2.5 @error('inputAlamat') border-red-500 @enderror"></textarea>
                            @error('editnamaAlamat')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
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