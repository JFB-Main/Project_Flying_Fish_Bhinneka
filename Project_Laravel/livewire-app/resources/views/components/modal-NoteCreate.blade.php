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
    <div class="bg-white rounded-b rounded-r rounded-l m-auto fixed inset-0 max-w-xl mb-auto mt-auto h-5/6 max-h-fit overflow-y-scroll shadow-xs shadow-yellow-500 border-t-4 border-[#F8971A]" >

        <form wire:submit.prevent="createNote" class="flex flex-col items-center pt-5 pb-5">
            <div class="flex flex-col gap-2 items-center w-full">
                <div>
                    <h1 class="text-3xl text-[#F18D0B] font-bold self-center">
                        Create Note
                    </h1>
                </div>
                <div class="bg-amber-300 border-gray-100 border-t w-full" style="height: 2px;"></div>
                <div class="flex flex-col gap-2 w-full p-5">
                    <label for="new_status_value" class="ml-2 block text font-bold text-[#302714]">
                        Note:
                    </label>
                    <textarea
                        type="textarea"
                        id="new_status_value"
                        style="min-height: 300px"
                        wire:model="note_specific_update" 
                        class="w-full bg-gray-50 border overflow-y-scroll border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 p-2.5"
                        {{-- wire:model="someFieldToUpdate" Example: bind to a Livewire property for input --}}
                    >
                    </textarea>
                </div>
            </div>
            <div class="flex flex-row justify-between pl-5 pr-5 w-full gap-5">
                <button type="button" wire:click="$dispatch('close-modal')" class="cursor-pointer px-4 py-2 border rounded-2xl bg-amber-500 border-gray-200 hover:opacity-60 text-white">
                    Close
                </button>
                <button type="submit" class="cursor-pointer px-4 py-2 border rounded-2xl bg-indigo-600 border-gray-200 hover:opacity-60 text-white">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>