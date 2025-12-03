<div class="flex flex-col w-auto pb-20 gap-15 max-md:px-5">
    <div class="flex flex-row justify-between bg-[#132c53] p-5 pl-8 pr-8 border-b border-gray-500 max-xl:text-sm max-md:px-4 shadow-lg">
        {{-- <div x-on:click="$dispatch('open-sidebar')" class="bg-purple-600 w-10 cursor-pointer hidden max-md:flex"></div> --}}
        <div class="flex flex-row max-w-fit gap-5 items-center">

            <div class="flex flex-row max-w-fit gap-1">
                {{-- @if ((session('role') == null || !auth()->check()))
                    <img src="{{ asset('icon_nav/flyingfish-icon.png') }}" alt="" class="w-[50px] h-[50px] self-center mr-2 max-md:size-[40px]">
                @endif --}}
                <div class="bg-[#e01b21]" style="width: 4px"></div>
                <a href="{{route('mainMenu')}}" class="text-white text-2xl max-xl:text-xl max-lg:text-base font-semibold self-center">
                  Add User
                    {{-- {{$message}} --}}
                </a>
            </div>
            <div class="flex flex-row gap-5 max-lg:[&>*]:text-[10px] max-md:hidden">
                @if (auth()->check())
                    <a href="{{route('auth.logout')}}" class="max-h-fit bg-white hover:opacity-60 w-fit text-gray-600 font-medium p-1 px-5 rounded-4xl">
                        Logout
                    </a>
                    <a href="{{route('mainMenu')}}" class="max-h-fit bg-white hover:opacity-60 w-fit text-gray-600 font-medium p-1 px-5 rounded-4xl">
                        Back Home
                    </a>
                @else
                    <a href="{{route('auth.login')}}" class="max-h-fit bg-white hover:opacity-60 w-fit text-gray-600 font-medium p-1 px-5 rounded-4xl">
                        Login
                    </a>
                @endif
            </div>
        </div>
        <div class="flex flex-row max-w-fit gap-1 item">
            <div class="flex flex-row max-w-fit gap-1">
                <div class="text-white items-end flex flex-col max-w-fit [&>h2]:text-xl [&>h2]:font-semibold max-xl:[&>h2]:text-lg max-lg:[&>h2]:text-base h-fit">
                    @if (session()->has(key: 'username'))
                        <h2>{{ ucwords(session('username')) }}</h2>
                        {{-- <h2>{{ ucwords(session('user_id')) }}</h2>
                        <h2>{{ session()->has('role') ? ucwords(session('role')) : 'N/A' }}</h2> --}}
                    @else
                        <h2>Guest</h2>
                    @endif
                    @if (auth()->check())
                        <p class="font-semibold text-white max-xl:text-[10px]">
                            Service Center Team
                        </p>
                    @else
                        <p class="font-semibold text-white max-xl:text-[10px]">
                            Welcome!
                        </p>
                    @endif
                </div>
                <div class="bg-[#e01b21] self-center" style="width: 4px; height: 90%;"></div>
            </div>
            <a href="{{route('addUser')}}" class="self-center">
                @if ((session('role') == null || !auth()->check()))
                    <a href="{{route('auth.login')}}" class="self-center max-xl:size-[45px] max-lg:size-[30px] max-md:size-[40px]">
                        <img src="{{ asset('icon_nav/Profile_Picture.png') }}" alt="" >
                    </a>
                @else
                    <img src="{{ asset('icon_nav/Profile_Picture.png') }}" alt="" class="self-center max-xl:size-[45px] max-lg:size-[30px] max-md:size-[40px]">
                @endif
            </a>
        </div>
    </div>
    <div class="flex flex-col w-[90%] self-center shadow-lg border border-[#132c53] bg-white pt-10 pb-10 rounded-4xl gap-10">
        {{-- Add wire:submit to your form to trigger the createTechlog method --}}
        <form wire:submit.prevent="updatePassword" class="flex flex-col gap-20">
            <div class="flex flex-col gap-10">
                <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                    Change Password
                </h1>
                <div class="flex flex-col items-center justify-around w-full gap-15 pl-5 pr-5 [&>*]:w-6/12 [&>*]:max-h-fit max-md:[&>*]:w-full">
                    <div class="flex flex-col">
                        <label for="pw">
                            Old Password 
                        </label>
                        <div class="flex flex-row">
                            <input wire:model="old_password" type="password" name="invoiceDate" id="pw" class="bg-gray-50 border text-gray-900 text-sm rounded-l-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('old_password') border-red-500 @enderror">
                            <button id="pw" type="button" class="flex border border-gray-200 w-fit pl-2 pr-2 items-center hover:shadow"
                                    x-data="{ isActive: false }"
                                    x-on:click="(isActive = !isActive); showPw()"
                                    :class="{ 'bg-blue-100 rounded-r-2xl text-white': isActive, 'bg-gray-100 rounded-r-2xl text-gray-800': !isActive }" 
                            >
                                <img src="icon_SLOverview\show_icon_password.svg" alt="" style="width: 25px">
                            </button>
                        </div>
                        @error('old_password') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="invoiceDate">
                            Confirm Old Password 
                        </label>
                        <input wire:model="old_confirmPassword" type="password" name="invoiceDate" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('old_confirmPassword') border-red-500 @enderror">
                        @error('old_confirmPassword') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                    </div>



                    <div class="flex flex-col">
                        <label for="new_pw">
                            New Password 
                        </label>
                        <div class="flex flex-row">
                            <input wire:model="new_password" type="password" name="invoiceDate" id="new_pw" class="bg-gray-50 border text-gray-900 text-sm rounded-l-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('new_password') border-red-500 @enderror">
                            <button id="new_pw" type="button" class="flex border border-gray-200 w-fit pl-2 pr-2 items-center hover:shadow"
                                    x-data="{ isActive: false }"
                                    x-on:click="(isActive = !isActive); showNewPw()"
                                    :class="{ 'bg-blue-100 rounded-r-2xl text-white': isActive, 'bg-gray-100 rounded-r-2xl text-gray-800': !isActive }" 
                            >
                                <img src="icon_SLOverview\show_icon_password.svg" alt="" style="width: 25px">
                            </button>
                        </div>
                        @error('new_password') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="invoiceDate">
                            Confirm New Password 
                        </label>
                        <input wire:model="new_confirmPassword" type="password" name="invoiceDate" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('new_confirmPassword') border-red-500 @enderror">
                        @error('new_confirmPassword') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-col pl-10 pr-10 gap-10 items-center">
                {{-- General Session Messages (Success/Error from form submission) --}}
                @if (session()->has('success'))
                    <div class="w-full pl-10 pr-10" role="alert">
                        <p class="bg-green-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-green-400">
                        Success: <span class="text-green-600 text-lg font-medium">{{ session('success') }}</span>
                        </p>
                    </div>
                @endif

                {{-- Display error message if it exists (e.g., from try-catch) --}}
                @if (session()->has('error'))
                    <div class="w-full pl-10 pr-10" role="alert">
                        <p class="bg-red-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-red-400">
                            Error: <span class="text-red-600 text-lg font-medium">{{ session('error') }}</span>
                        </p>
                    </div>
                @endif

                <button type="submit" class="max-h-fit bg-[#F8971A] hover:opacity-60 w-fit text-white font-medium p-2 pl-10 pr-10 rounded-4xl text-2xl">
                    Confirm
                </button>
            </div>
        </form>
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
        function showNewPw() {
            var x = document.getElementById("new_pw");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</div>