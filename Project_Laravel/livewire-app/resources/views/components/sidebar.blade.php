<nav 
x-data="{ show: false }"
     x-on:open-sidebar.window="show = !show"
     class="fixed top-0 left-0 w-64 max-xl:w-44 max-lg:w-36 max-md:w-56 flex flex-col h-screen outline border border-[#E6D08E]
            md:translate-x-0 md:z-3 
            max-md:absolute max-md:z-50 max-md:-translate-x-full max-md:transition-transform max-md:duration-300 z- 2
            "
     :class="{ 'max-md:translate-x-0 max-md:z-3 max-md:fixed': show }"
     >

    {{-- bg-gradient-to-br from-amber-400 to-purple-700 --}}
    {{-- <div class="bg-gradient-to-br from-amber-400 to-purple-700 w-full h-min pt-3 pb-3"> --}}

    <div class="bg-gradient-to-b from-amber-400 via-[#F8971A] to-[#f88d1a] to-[90%] w-full h-min pt-3 pb-3">
        <div class="flex flex-row gap-2 items-center justify-baseline pl-5 max-lg:pl-0 max-lg:justify-center max-lg:">
            <a href="{{route('guestSearch')}}" class="w-[20%] h-[20%]" style="">
                <img src="{{ asset('icon_nav/flyingfish-icon.png') }}" alt="">
            </a>
            <a href="{{route('guestSearch')}}" class="text-[#FFF8DE] font-bold hover:text-[#fbe4be] text-xl max-xl:text-lg max-lg:text-base">
            Flying Fish
            </a>
        </div>
    </div>
    <div class="w-full bg-white h-full pl-5 max-xl:pl-0 max-xl:items-center max-xl:[&_div]:items-start gap-6">
        <div class="flex flex-col pt-5 gap-6 items-baseline max-xl:[&>*]:ml-auto max-xl:[&>*]:mr-auto max-xl:[&>*]:w-10/12 [&>*]:hover:font-semibold [&>*]:hover:text-[#F8971A] [&>*]:active:bg-[#EDE9E6] [&>*]:hover:rounded-2xl [&>*]:pl-1 [&>*]:pr-2 [&>*]:gap-3">
            <div class="flex flex-row">
                <img src="{{ asset('icon_nav/dashboard_icon.svg') }}" alt="" class="self-center w-[30px] max-xl:w-[20px]">
                <form action="{{ route('dashboard')}}">
                    <button x-data class="text-xl max-xl:text-base max-lg:text-sm">
                        <span>
                            Dashboard
                        </span>
                    </button>
                </form>
            </div>
            <div class="flex flex-row items-start">
                <img src="{{ asset('icon_nav/service_icon.svg') }}" alt="" class="self-center w-[30px] max-xl:w-[20px]">
                <a class="text-xl max-xl:text-base max-lg:text-sm" href="{{route('dataReport')}}">
                    <span>
                        Data Report
                    </span>
                </a>
            </div>
            <div class="flex flex-row items-start">
                <img src="{{ asset(path: 'icon_nav/service_icon.svg') }}" alt="" class="self-center w-[30px] max-xl:w-[20px]">
                <a class="text-xl max-xl:text-base max-lg:text-sm" href="{{route('mainMenu')}}">
                    <span>
                        Home
                    </span>
                </a>
            </div>
            <div class="w-[90%] bg-amber-400/30 h-[1px]"></div>
            <div class="flex flex-row items-start">
                <img src="{{ asset('icon_nav/logout_icon.svg') }}" alt="" class="self-center w-[30px] max-xl:w-[20px]">
                <form action="{{route('auth.logout')}}">
                    <button class="text-xl max-xl:text-base max-lg:text-sm">
                        <span>
                            logout
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>  
</nav>