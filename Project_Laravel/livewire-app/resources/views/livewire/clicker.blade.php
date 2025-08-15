<div class="flex flex-row justify-between bg-white p-5 pl-8 pr-8 border-b border-amber-300 max-xl:text-sm max-md:px-4 shadow-lg">
    @if ((session('role') == null || !auth()->check()))

    @else
        <div class="flex-col gap-4 fixed bottom-4 right-4 hidden max-md:flex z-3 ">
            <a href="{{route('create-techlog')}}" class="">
                <img src="{{asset('icon_nav\Create_Sphere.svg') }}" alt="" class="w-16 h-16 cursor-pointer">
            </a>
            @if (session('role') == 1 || session('role') == 2 )
                <a href="{{route('addUser')}}" class="">
                <img src="{{asset('icon_nav\Add_user-Sphere.svg') }}" alt="" class="w-16 h-16 cursor-pointer">
                </a>
            @endif
        </div>
    @endif
    {{-- <div x-on:click="$dispatch('open-sidebar')" class="bg-purple-600 w-10 cursor-pointer hidden max-md:flex"></div> --}}
    <div class="flex flex-row max-w-fit gap-5 items-center">

        {{-- icon sphere buat create  --}}
        @if ((session('role') == null || !auth()->check()))

        @else
            <img x-on:click="$dispatch('open-sidebar')" src="{{asset('icon_nav\sidebar_burger.svg') }}" alt="" class=" w-10 cursor-pointer hidden max-md:flex"> 
        @endif
        {{-- icon sphere buat create  --}}

        <div class="flex flex-row max-w-fit gap-1">
            @if ((session('role') == null || !auth()->check()))
                <img src="{{ asset('icon_nav/flyingfish-icon.png') }}" alt="" class="w-[50px] h-[50px] self-center mr-2 max-md:size-[40px]">
            @endif
            <div class="bg-[#F8971A]" style="width: 4px"></div>
            <h1 class="text-2xl max-xl:text-xl max-lg:text-base font-semibold self-center">
                {{ $pageTitle }} 
                {{-- {{$message}} --}}
            </h1>
        </div>
        <div class="flex flex-row gap-5 max-lg:[&>*]:text-[10px] max-md:hidden">
            @if (auth()->check())
                <a href="{{route('create-techlog')}}" class="max-h-fit bg-[#F8971A] hover:opacity-60 w-fit text-white font-medium p-1 pl-3 pr-3 rounded-4xl">
                    New Techlog +
                </a>
                @if (session('role') == 1 || session('role') == 2 )
                    <div class="flex items-center">
                        <a href="{{route('addUser')}}" class="max-w-fit max-h-fit text-[#302714] font-medium p-1 pl-3 pr-3 rounded-4xl border border-indigo-600 hover:bg-indigo-600 hover:text-white cursor-pointer">
                            Add User +
                        </a>
                    </div>
                @endif
            @else
                <a href="{{route('auth.login')}}" class="max-h-fit bg-[#F8971A] hover:opacity-60 w-fit text-white font-medium p-1 px-5 rounded-4xl">
                    Login
                </a>
            @endif
        </div>
    </div>
    <div class="flex flex-row max-w-fit gap-1 item">
        <div class="flex flex-row max-w-fit gap-1">
            <div class="items-end flex flex-col max-w-fit [&>h2]:text-xl [&>h2]:font-semibold max-xl:[&>h2]:text-lg max-lg:[&>h2]:text-base h-fit">
                @if (session()->has('username'))
                    <h2>{{ ucwords(session('username')) }}</h2>
                    {{-- <h2>{{ ucwords(session('user_id')) }}</h2>
                    <h2>{{ session()->has('role') ? ucwords(session('role')) : 'N/A' }}</h2> --}}
                @else
                    <h2>Guest</h2>
                @endif
                @if (auth()->check())
                    <p class="font-semibold text-[#F18D0B] max-xl:text-[10px]">
                        Service Center Team
                    </p>
                @else
                    <p class="font-semibold text-[#F18D0B] max-xl:text-[10px]">
                        Welcome!
                    </p>
                @endif
            </div>
            <div class="bg-[#F8971A] self-center" style="width: 4px; height: 90%;"></div>
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
