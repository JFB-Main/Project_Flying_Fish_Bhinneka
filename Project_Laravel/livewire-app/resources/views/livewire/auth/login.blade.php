<div class="container flex flex-row w-full h-screen" style="">
    <div class="w-full bg-gradient-to-tl from-amber-100 via-[#F8971A]/70 to-purple-500">
        {{-- <div class="bg-blue-900 opacity-20 size-full">This div element has position: absolute;</div> --}}
    </div>
    <div class="flex flex-col justify-center w-full shadow-xl gap-10" style="max-width: 30%">
        <div class="flex flex-col items-center gap-15">
            <img src="icon_nav\flyingfish-icon.png" alt="" style="width: 30%">
            <div class="flex flex-col items-center">
                <h5 class="text-center font-bold text-4xl text-[#F8971A]">FLYING FISH</h5>
                <p class="text-sm font-light text-gray-600">Service Center System</p>
            </div>
        </div>
        <div class="flex flex-col p-10">
            <form wire:submit.prevent="login" class="flex flex-col gap-10">

                <div class="flex flex-col gap-5">
                    <div class="form-group">
                        <label class="font-weight-bold">Username</label>
                        <input type="text" wire:model.lazy="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('username') is-invalid border-red-500 @enderror"
                            placeholder="username">
                        @error('username')
                        <div class="invalid-feedback text-red-500 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Password</label>
                        <div class="flex flex-row @error('password') is-invalid border rounded-2xl border-red-500 @enderror">
                            <input type="password" wire:model.lazy="password" id="pw"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('password') is-invalid @enderror" 
                                placeholder="Password"
                            >
                            <button id="pw" type="button" class="flex border border-gray-200 w-fit pl-2 pr-2 items-center hover:shadow"
                                    x-data="{ isActive: false }"
                                    x-on:click="(isActive = !isActive); showPw()"
                                    :class="{ 'bg-blue-100 rounded-r-2xl text-white': isActive, 'bg-gray-100 rounded-r-2xl text-gray-800': !isActive }" 
                            >
                                <img src="icon_SLOverview\show_icon_password.svg" alt="" style="width: 25px">
                            </button>
                        </div>
                        @error('password')
                        <div class="invalid-feedback text-red-500 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="cursor-pointer px-4 py-2 border rounded-2xl bg-amber-500 border-gray-200 hover:opacity-60 text-white">
                    LOGIN
                </button>
            </form>
        </div>
        <div class="flex flex-col text-gray-400 self-center items-center gap-5">
            <img src="icon_SLOverview\bhinneka-logo.svg" alt="" style="width: 70%">
            <p class="text-sm">
                © 1993-2025 PT. Bhinneka Mentari Dimensi
            </p>
        </div>
    </div>

    <script>
        function showPw() {
        var x = document.getElementById("pw");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }

        // button.addEventListener('click', function() {
        //     isPressed = !isPressed; // Toggle the state

        //     if (isPressed) {
        //     button.style.backgroundColor = color2;
        //     } else {
        //     button.style.backgroundColor = color1;
        //     }
        // });
    </script>
</div>
