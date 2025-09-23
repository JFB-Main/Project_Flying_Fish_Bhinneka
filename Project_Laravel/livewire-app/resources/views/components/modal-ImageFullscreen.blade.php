@props(['name', 'title'])

<div
    id="pop-up"
    x-data = "{ show : false, name : '{{$name}}', imagePath: '', imageTitle: '' }"
    x-show = "show"
    x-on:open-modal.window = "show = ($event.detail.name === name); imagePath = $event.detail.fullscreen_path; imageTitle = $event.detail.image_title;"
    x-on:close-modal.window = "show = false"
    x-on:keydown.escape.window = "show = false"

    style="display: none;"
    x-transition.duration

    class="fixed z-50 inset-0 ">
    <div x-on:click="show = false; $dispatch('close-modal')" class="fixed inset-0 bg-[#030D26] opacity-20"></div>
    <div class="m-auto fixed flex inset-0 w-fit max-w-7xl mb-auto mt-auto max-h-fit overflow-hidden justify-center">
       <img :src="imagePath" alt="Full-screen image" class="max-w-full max-h-full" />
        
        <!-- Corrected to use x-text on the Alpine variable -->
        {{-- <p x-text="imageTitle"></p> --}}
    </div>
</div>