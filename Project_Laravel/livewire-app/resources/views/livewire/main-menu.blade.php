<div>
    <div class="flex flex-row justify-between bg-[#132c53] p-5 pl-8 pr-8 border-b border-gray-500 max-xl:text-sm max-md:px-4 shadow-lg">
        {{-- <div x-on:click="$dispatch('open-sidebar')" class="bg-purple-600 w-10 cursor-pointer hidden max-md:flex"></div> --}}
        <div class="flex flex-row max-w-fit gap-5 items-center">

            <div class="flex flex-row max-w-fit gap-1">
                {{-- @if ((session('role') == null || !auth()->check()))
                    <img src="{{ asset('icon_nav/flyingfish-icon.png') }}" alt="" class="w-[50px] h-[50px] self-center mr-2 max-md:size-[40px]">
                @endif --}}
                <div class="bg-[#e01b21]" style="width: 4px"></div>
                <h1 class="text-white text-2xl max-xl:text-xl max-lg:text-base font-semibold self-center">
                  Home 
                    {{-- {{$message}} --}}
                </h1>
            </div>
            <div class="flex flex-row gap-5 max-lg:[&>*]:text-[10px] max-md:hidden">
                @if (auth()->check())
                    <a href="{{route('auth.logout')}}" class="max-h-fit bg-white hover:opacity-60 w-fit text-gray-600 font-medium p-1 px-5 rounded-4xl">
                        Logout
                    </a>
                    <a href="{{route('addUser')}}" class="max-h-fit bg-white hover:opacity-60 w-fit text-gray-600 font-medium p-1 px-5 rounded-4xl">
                        Add User
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
            <a href="{{route('changePassword')}}" class="self-center">
                @if ((session('role') == null || !auth()->check()))
                    <a href="{{route('auth.login')}}" class="self-center max-xl:size-[45px] max-lg:size-[30px] max-md:size-[40px]">
                        <img src="{{ asset('icon_nav/Profile_Picture.png') }}" alt="" >
                    </a>
                @else
                    <img src="{{ asset('icon_nav/Profile_Picture.png') }}" alt="" class="self-center max-xl:size-[45px] max-lg:size-[30px] max-md:size-[40px]">
                @endif
            </a>
            {{-- <button wire:click="createNewUser()">
                new user
            </button>

            <button type="button" x-data x-on@click="$dispatch('user-created')">
                refresh
            </button> --}}
        </div>

        {{-- <button wire:click="logout">
            logout
        </button> --}}
    </div>

    <div class="flex flex-col items-center w-auto gap-15 max-md:px-5">
        <div class="flex flex-col w-full p-10 pb-20 shadow-md items-center gap-10">
            <img src="{{asset('icon_SLOverview\bhinneka-logo.svg') }}" alt="" class="w-[25%]">
            <h1 class="w-fit text-center font-semibold text-3xl
                        max-xl:text-3xl max-lg:text-2xl max-md:text-2xl">
                SERVICE DEPARTMENT & DPS DEPARTMENT ERP SYSTEM
            </h1>
        </div>
        <div class="flex flex-wrap gap-30">
            <a href="{{route('dashboard')}}" class="flex flex-col items-center max-w-fit cursor-pointer">
                <img src="{{ asset('icon_nav/flyingfish-icon.png') }}" alt="" class="w-[128px]">
                <p class="">Flying Fish</p>
            </a>
            <a href="{{route('dashboard-dps')}}"  class="flex flex-col items-center max-w-fit cursor-pointer">
                <img src="{{ asset('icon_nav\pack-stingray-icon-512x.png') }}" alt="" class="w-[128px]">
                <p>Stingray</p>
            </a>
        </div>
    </div>
</div>
