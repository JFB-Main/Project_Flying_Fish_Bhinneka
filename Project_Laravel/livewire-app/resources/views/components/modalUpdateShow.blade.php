{{-- @props(['name', 'title'])

<div
    x-data = "{ show : false, name : '{{$name}}'}"
    x-show = "show"
    x-on:open-modal.window = "show = ($event.detail.name === name)"
    x-on:close-modal.window = "show = false"
    x-on:keydown.escape.window = "show = false"

    style="display: none;"
    x-transition.duration

    class="fixed z-50 inset-0">
    <div x-on:click="show = false" class="fixed inset-0 bg-[#030D26] opacity-50"></div>
    <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl mb-auto mt-auto h-4/5" >
        @if (isset($title))
            <div>
                {{$title}}
            </div>
        @endif
        <div class="flex flex-wrap max-w-fit overflow-x-auto">
            {{ $body }}
        </div>
    </div>
</div> --}}