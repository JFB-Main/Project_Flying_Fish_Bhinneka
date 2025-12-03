@props(['name', 'title'])

<div
    id="pop-up"
    x-data = "{ show : false, name : '{{$name}}'}"
    x-show = "show"
    x-on:open-modal.window = "show = ($event.detail.name === name)"
    x-on:close-modal.window = "show = false"
    x-on:keydown.escape.window = "show = false"

    style="display: none;"
    x-transition.duration

    class="fixed z-50 inset-0 ">
    <div x-on:click="show = false; $dispatch('close-modal')" class="fixed inset-0 bg-[#030D26] opacity-50"></div>
    <div class="bg-white rounded-b rounded-r rounded-l m-auto fixed inset-0 max-w-xl mb-auto mt-auto h-5/6 max-h-fit shadow-xs shadow-[#132c53] border-t-4 border-[#0f387a]" >

        <form wire:submit.prevent="createNoteDps" class="flex flex-col items-center pt-5 pb-5">
            <div class="flex flex-col gap-2 items-center w-full">
                <div>
                    <h1 class="text-3xl text-text-cyan-600 font-bold self-center">
                        Tambahkan Note
                    </h1>
                </div>
                <div class="bg-[#0f387a] border-gray-100 border-t w-full" style="height: 2px;"></div>
                <div class="flex flex-col gap-2 w-full p-5">
                    <label for="new_status_value" class="ml-2 block text font-bold text-[#302714]">
                        Note:
                    </label>
                    <textarea
                        type="textarea"
                        id="new_status_value"
                        style="min-height: 300px"
                        wire:model="notedps_specific_update" 
                        class="w-full bg-gray-50 border overflow-y-scroll border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 p-2.5 @error('note_specific_update') border-red-500 @enderror"
                        {{-- wire:model="someFieldToUpdate" Example: bind to a Livewire property for input --}}
                    >
                    </textarea>
                    @error('notedps_specific_update')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
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