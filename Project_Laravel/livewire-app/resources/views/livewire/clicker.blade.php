<div class="flex flex-row justify-between bg-white p-5 pl-8 pr-8 border-b border-amber-300">
    <div class="flex flex-row max-w-fit gap-5 items-center">
        <div class="flex flex-row max-w-fit gap-1">
            <div class="bg-[#F8971A]" style="width: 4px"></div>
            <h1 class="text-2xl font-semibold self-center">
            {{ $pageTitle }} 
            {{-- {{$message}} --}}
            </h1>
        </div>
        <a href="{{route('create-techlog')}}" class="max-h-fit bg-[#F8971A] hover:opacity-60 w-fit text-white font-medium p-1 pl-3 pr-3 rounded-4xl">
            New Techlog +
        </a>
    </div>
    <div class="flex flex-row max-w-fit gap-1">
        <div class="flex flex-row max-w-fit gap-1">
            <div class="items-end flex flex-col max-w-fit [&>h2]:text-xl [&>h2]:font-semibold h-fit">
                @if (session()->has('username'))
                    <h2>{{ ucwords(session('username')) }}</h2>
                @else
                    <h2>Guest</h2>
                @endif
                <p class="font-semibold text-[#F18D0B] text-md">
                    Service Center Team
                </p>
            </div>
            <div class="bg-[#F8971A] self-center" style="width: 4px; height: 90%;"></div>
        </div>
        <img src="{{ asset('icon_nav/Profile_Picture.png') }}" alt="">
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
