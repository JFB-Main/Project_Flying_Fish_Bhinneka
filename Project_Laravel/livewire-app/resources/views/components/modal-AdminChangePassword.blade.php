@props(['name', 'title'])

<div
    id="pop-up"
    x-data = "{ show : false, name : '{{$name}}', userId: null }"
    x-show = "show"
    x-on:open-modal.window = "
        show = ($event.detail.name === name);
        if (show) { userId = $event.detail.userId; }
    "
    x-on:close-modal.window = "show = false; userId = null"
    x-on:keydown.escape.window = "show = false; userId = null"

    style="display: none;"
    x-transition.duration

    class="fixed z-50 inset-0 ">
    <div x-on:click="show = false; $dispatch('close-modal');  { $wire.resetAdminchangePassword(); }" class="fixed inset-0 bg-[#030D26] opacity-50"></div>
    <div class="bg-white rounded-b rounded-r rounded-l m-auto fixed inset-0 max-w-xl mb-auto mt-auto h-5/6 max-h-fit overflow-y-scroll shadow-xs shadow-yellow-500 border-t-4 border-[#F8971A]" >

        <form wire:submit.prevent="adminChangePassword(userId)" class="flex flex-col items-center pt-5 pb-5 gap-10">
            <div class="flex flex-col gap-2 items-center w-full">
                <div>
                    <h1 class="text-3xl text-[#F18D0B] font-bold self-center">
                        Change Password
                    </h1>
                </div>
                <div class="bg-amber-300 border-gray-100 border-t w-full" style="height: 2px;"></div>
                <div class="flex flex-col gap-2 w-full p-5">
                    <label for="new_status_value" class="ml-2 block text font-bold text-[#302714]">
                        Password:
                    </label>
                    <div class="flex flex-row">
                        <input
                            type="password"
                            x-ref="pwChange" 
                            wire:model="pw_for_change" 
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-2xl focus:ring-blue-500 focus:border-blue-500 p-2.5 @error('pw_for_change') border-red-500 @enderror"
                            {{-- wire:model="someFieldToUpdate" Example: bind to a Livewire property for input --}}
                        >
                        </input>
                        <button type="button" class="flex border border-gray-200 w-fit pl-2 pr-2 items-center hover:shadow"
                                x-data="{ isActive: false }"
                                x-on:click="(isActive = !isActive); $refs.pwChange.type = isActive ? 'text' : 'password'"
                                :class="{ 'bg-blue-100 rounded-r-2xl text-white': isActive, 'bg-gray-100 rounded-r-2xl text-gray-800': !isActive }" 
                        >
                            <img src="icon_SLOverview\show_icon_password.svg" alt="" style="width: 25px">
                        </button>
                    </div>
                    @error('pw_for_change')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 w-full p-5">
                    <label for="new_status_value" class="ml-2 block text font-bold text-[#302714]">
                        Confirm Password:
                    </label>
                    <input
                        type="password"
                        id="confirmpw"
                        wire:model="confirm_pw_for_change" 
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 p-2.5 @error('confirm_pw_for_change') border-red-500 @enderror"
                        {{-- wire:model="someFieldToUpdate" Example: bind to a Livewire property for input --}}
                    >
                    </input>
                    @error('confirm_pw_for_change')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex flex-row justify-between pl-5 pr-5 w-full gap-5 border-t border-t-amber-400 pt-5">
                <button type="button"
                         wire:click="resetAdminchangePassword" 
                        class="cursor-pointer px-4 py-2 border rounded-2xl bg-amber-500 border-gray-200 hover:opacity-60 text-white">
                    Close
                </button>
                <button type="submit" class="cursor-pointer px-4 py-2 border rounded-2xl bg-indigo-600 border-gray-200 hover:opacity-60 text-white">
                    Change
                </button>
            </div>
        </form>
    </div>

    {{-- <script>
        function showPwOnModalChange() {
            var x = document.getElementById("pwChange");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script> --}}
</div>