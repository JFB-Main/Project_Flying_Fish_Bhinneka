<nav class="fixed top-0 left-0 w-64 flex flex-col h-screen outline outline-solid outline-[#E6D08E] " style="">
    <div class="bg-[#F8971A] w-full h-min pt-3 pb-3">
        <div class="flex flex-row gap-2 items-center justify-baseline pl-5">
            <img src="{{ asset('icon_nav/flyingfish-icon.png') }}" alt="" style="width: 20%; height: 20%;">
            <h1 class="text-[#FFF8DE] font-bold text-xl">
            Flying Fish
            </h1>
        </div>
    </div>
    <div class="w-full bg-white h-full pl-5 gap-6">
        <div class="flex flex-col pt-5 gap-6 items-baseline [&>*]:hover:font-semibold [&>*]:hover:text-[#F8971A] [&>*]:active:bg-[#EDE9E6] [&>*]:hover:rounded-2xl [&>*]:pl-1 [&>*]:pr-2 [&>*]:gap-3">
            <div class="flex flex-row items-start">
                <img src="{{ asset('icon_nav/dashboard_icon.svg') }}" alt="" style="width: 30px;">
                <form action="{{ url('/') }}">
                    <button x-data x-on:click="$Livewire.emit('setPageTitle', 'dd')" class="text-xl ">
                        <span>
                            Dashboard
                        </span>
                    </button>
                </form>
            </div>
            <div class="flex flex-row items-start">
                <img src="{{ asset('icon_nav/service_icon.svg') }}" alt="" style="width: 30px;">
                <button class="text-xl">
                    <span>
                        Service
                    </span>
                </button>
            </div>
            <div class="flex flex-row items-start">
                <img src="{{ asset('icon_nav/logout_icon.svg') }}" alt="" style="width: 30px;">
                <form action="{{route('auth.logout')}}">
                    <button class="text-xl">
                        <span>
                            logout
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>