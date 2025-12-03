<div class="flex flex-row justify-between bg-white p-5 pl-8 pr-8 border-b border-[#3385b7] max-xl:text-sm max-md:px-4 shadow-lg">
    <div class="flex flex-row max-w-fit gap-5 items-center">

        {{-- icon sphere buat create  --}}
        @if ((session('role') == null || !auth()->check()))

        @else
            <img x-on:click="$dispatch('open-sidebar')" src="{{asset('icon_nav\sidebar_burger.svg') }}" alt="" class=" w-10 cursor-pointer hidden max-md:flex"> 
        @endif
        {{-- icon sphere buat create  --}}

        <div class="flex flex-row max-w-fit gap-5">
            @if ((session('role') == null || !auth()->check()))
                <img src="{{ asset('icon_SLOverview\pack-stingray.png') }}" alt="" class="w-[50px] h-[50px] self-center mr-2 max-md:size-[40px]">
            @endif
            <div class="flex flex-row max-w-fit gap-1">
                <div class="bg-[#67d1e4]" style="width: 4px"></div>
                <h1 class="text-2xl max-xl:text-xl max-lg:text-base font-semibold self-center">
                    {{ $pageTitle }} 
                    {{-- {{$message}} --}}
                </h1>
            </div>
            @if (auth()->check() && (session('role') == 1 || session('role') == 2 ))
                <div class="flex items-center">
                    <a href="{{route('addUser')}}" class="max-w-fit max-h-fit text-[#302714] font-medium p-1 pl-3 pr-3 rounded-4xl border border-cyan-600 hover:bg-cyan-600 hover:text-white cursor-pointer">
                        Add User +
                    </a>
                </div>
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
                    <p class="font-semibold text-[#3385b7] max-xl:text-[10px]">
                        DPS Team
                    </p>
                @else
                    <p class="font-semibold text-[#3385b7] max-xl:text-[10px]">
                        Welcome!
                    </p>
                @endif
            </div>
            <div class="bg-[#67d1e4] self-center" style="width: 4px; height: 90%;"></div>
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
    </div>

</div>
