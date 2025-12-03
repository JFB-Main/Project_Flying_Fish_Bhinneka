<div class="flex flex-row w-full h-screen md:min-h-screen md:max-h-[10000px] justify-end max-lg:justify-center max-md:h-screen max-md:items-center max-md:py-0 max-md:px-7" style="">
    {{-- <div class="w-full bg-gradient-to-tl from-amber-100 via-[#F8971A]/70 to-purple-500"> --}}
        {{-- <div class="bg-blue-900 opacity-20 size-full">This div element has position: absolute;</div> --}}
    {{-- </div> --}}
    <div class="flex flex-col justify-center w-[30%] h-full shadow-xl gap-3 py-16 
                bg-white max-xl:gap-0 max-md:w-full max-md:py-10 max-md:px-5 max-md:rounded-4xl max-md:max-h-fit max-md:gap-10" style="">
        <div class="flex flex-col items-center gap-15 max-xl:gap-10 max-lg:gap-5">
            <img src="icon_nav\flyingfish-icon.png" alt="" style="" class="w-[30%] max-xl:w-[25%] mafullx-md:w-[40%]">
            <div class="flex flex-col items-center">
                <h5 class="text-center font-bold text-4xl text-red-600/70 max-xl:text-3xl max-lg:text-xl max-md:text-4xl">LOGIN</h5>
                <p class="text-sm font-light text-gray-600 max-lg:text-[10px] max-md:text-sm">Service Center & DPS ERP System</p>
            </div>
        </div>
        <div class="flex flex-col p-10 max-lg:p-7 max-md:p-0 max-lg:py-5">
            <form wire:submit.prevent="login" class="flex flex-col gap-10 max-xl:gap-3">

                <div class="flex flex-col gap-5 max-xl:[&_div_*]:text-[12px] max-xl:[&_div_input]:p-1.5 max-xl:p-1.5 max-lg:[&_div_*]:text-[10px] max-lg:gap-2 max-md:[&_div_*]:text-base max-md:gap-7 max-md:[&_div_input]:text-sm max-md:[&_div_input]:p-1.5">
                    <div class="form-group">
                        <label class="font-weight-bold ">Username</label>
                        <input type="text" wire:model.lazy="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('username') is-invalid border-red-500 @enderror"
                            placeholder="Username">
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

                <button type="submit" class="cursor-pointer px-4 py-2 border rounded-2xl max-xl:text-[12px]  max-xl:py-1.5 max-lg:text-[8px] max-md:py-2.5 max-md:text-base bg-[#132c53] border-gray-200 hover:opacity-60 text-white">
                    LOGIN
                </button>
                <p class="self-center text-gray-600
                            max-xl:text-[12px] max-lg:text-[10px] max-md:text-base">
                    Are you a guest? <span class="text-[#f1b500] hover:opacity-60"> <a href="{{route('mainMenu')}}"> Click Here</a></span>
                </p>
            </form>
        </div>
        <div class="flex flex-col text-gray-400 self-center items-center gap-5 max-xl:gap-2">
            <img src="icon_SLOverview\bhinneka-logo.svg" alt="" style="" class="w-[70%] max-xl:w-[55%] max-md:w-[70%]">
            <p class="text-sm max-xl:text-[10px] max-lg:text-[8px]">
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
