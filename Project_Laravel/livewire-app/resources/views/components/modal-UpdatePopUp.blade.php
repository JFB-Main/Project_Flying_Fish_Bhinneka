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
    <div class="bg-white rounded-b rounded-r rounded-l m-auto fixed inset-0 max-w-xl mb-auto mt-auto h-5/6 max-h-fit shadow-xs shadow-yellow-500 border-t-4 border-[#F8971A]" >
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