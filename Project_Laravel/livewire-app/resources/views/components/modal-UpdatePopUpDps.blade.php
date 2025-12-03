@props(['name', 'title'])

<div
    id="pop-up"
    x-data = "{ show : false, name : '{{$name}}'}"
    x-show = "show"
    x-on:open-modal-alamat-add-dps.window = "show = ($event.detail.name === name)"
    x-on:close-modal-alamat-add-dps.window = "show = false"
    x-on:keydown.escape.window = "show = false"

    style="display: none;"
    x-transition.duration

    class="fixed z-50 inset-0 ">
    <div x-on:click="show = false; $dispatch('close-modal-alamat-add-dps')" class="fixed inset-0 bg-[#030D26] opacity-50"></div>
    <div class="max-w-[45%] bg-white rounded-b-lg rounded-r-lg rounded-l-lg m-auto fixed inset-0 mb-auto mt-auto h-5/6 max-h-fit overflow-y-scroll shadow-xs shadow-blue-500 border-t-4 border-[#132c53] 
                max-md:overflow-x-scroll max-md:max-w-[90%]" 
        style="">
        {{-- @if (isset($title))
            <div>
                {{$title}}
            </div>
        @endif --}}
        <div class="">
            {{ $body }}
            {{-- @livewire('dashboard') --}}
        </div>
    </div>
</div>