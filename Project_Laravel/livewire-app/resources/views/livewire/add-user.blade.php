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
    <div class="flex flex-col border shadow-lg w-[90%] self-center border-[#132c53] bg-white pt-10 pb-10 rounded-4xl gap-10"
        x-data
        x-on:open-modal.window="toggleScroll()" 
        x-on:close-modal.window="toggleScroll()"
        x-on:keydown.escape.window="toggleKeydownScroll()">
        {{-- Add wire:submit to your form to trigger the createTechlog method --}}
        <form wire:submit.prevent="createUser" class="flex flex-col gap-20">
            <div class="flex flex-col gap-10">
                <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                    ADD USER
                </h1>
                <div class="flex flex-col items-center justify-around w-full gap-15 pl-5 pr-5 [&>*]:w-6/12 [&>*]:max-h-fit max-md:[&>*]:w-full">
                    <div class="flex flex-col">
                        <label for="invoiceDate">
                            Username
                        </label>
                        <input wire:model="input_username" type="text" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_username') border-red-500 @enderror">
                        @error('input_username') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="salesOrder">
                            Email 
                        </label>
                        <input wire:model="input_email" type="email" id="" placeholder="Enter email" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_email') border-red-500 @enderror">
                        @error('input_email') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                    </div>
                    {{-- <div class="flex flex-col">
                        <label for="">
                            Department Type 
                        </label>
                        <select wire:model="input_module_role_id" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_module_role_id') border-red-500 @enderror">
                            <option value="" selected>-- Select Department Type --</option>
                            <option value="1">Service Department</option>
                            <option value="2">DPS Department</option>
                        </select>
                        @error('input_module_role_id') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                    </div> --}}
                    @if (session('role') == 1)
                        <div class="flex flex-col">
                            <label for="">
                                Role 
                            </label>
                            <select wire:model="input_role_id" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_role_id') border-red-500 @enderror">
                                <option value="3">User</option>
                                <option value="2">Admin</option>
                            </select>
                            @error('input_role_id') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div class="flex flex-col">
                            <label for="">
                                Role 
                            </label>
                            <i class="bg-gray-50 border text-green-600 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_role_id') border-red-500 @enderror">
                                User role default to normal user under your permission level
                            </i>
                            @error('input_role_id') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    @if (session('role') == 1)
                        <div class="flex flex-col">
                            <label for="">
                                Department Type 
                            </label>
                            <select wire:model="input_module_role_id" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_module_role_id') border-red-500 @enderror">
                                <option value="" selected>-- Select Department Type --</option>
                                <option value="1">Flyingfish | Service Department</option>
                                <option value="2">Stingray | DPS Department</option>
                            </select>
                            @error('input_module_role_id') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div class="flex flex-col">
                            <label for="">
                                Department Type 
                            </label>
                            <i class="bg-gray-50 border text-green-600 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_module_role_id') border-red-500 @enderror">
                                Department type are uncostumizable under your permission level
                            </i>
                            @error('input_module_role_id') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <label for="invoiceDate">
                            Password 
                        </label>
                        <div class="flex flex-row">
                            <input wire:model="input_password" type="password" name="invoiceDate" id="pw" class="bg-gray-50 border text-gray-900 text-sm rounded-l-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_invoiceDate') border-red-500 @enderror">
                            <button id="pw" type="button" class="flex border border-gray-200 w-fit pl-2 pr-2 items-center hover:shadow"
                                    x-data="{ isActive: false }"
                                    x-on:click="(isActive = !isActive); showPw()"
                                    :class="{ 'bg-blue-100 rounded-r-2xl text-white': isActive, 'bg-gray-100 rounded-r-2xl text-gray-800': !isActive }" 
                            >
                                <img src="icon_SLOverview\show_icon_password.svg" alt="" style="width: 25px">
                            </button>
                        </div>
                        @error('input_password') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="invoiceDate">
                            Confirm Password 
                        </label>
                        <input wire:model="input_confirmPassword" type="password" name="invoiceDate" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_invoiceDate') border-red-500 @enderror">
                        @error('input_confirmPassword') <span class="text-red-500 text-sm error">{{ $message }}</span> @enderror
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

    <div class="flex flex-col border justify-center shadow-xl border-[#132c53] bg-white pt-10 pb-10 rounded-4xl w-[90%] self-center gap-1">
        <div class="flex flex-row shadow-lg w-full gap-1 pl-5 pb-10">
            <div class="bg-[#F8971A]" style="width: 4px"></div>
            <div class="flex flex-row gap-2">
                <h1 class="text-2xl text-[#302714] font-bold">
                    Users List
                </h1>
            </div>
        </div>
        <div class="flex flex-col overflow-x-scroll rounded-2xl">
            <table class="mx-10">
                <thead class="bg-gray-200 border-t border-gray-200">
                    <tr class="gap-3">
                        <th class="text-left p-2" style="">ID</th>
                        <th class="text-left p-2" style="">Username</th>
                        <th class="text-left p-2" style="">Email</th>
                        <th class="text-left p-2" style="">Role</th>
                        <th class="text-left p-2" style="">Created At</th>
                        <th class="text-left p-2" style="">Updated At</th>
                        <th class="text-left p-2" style="">Action</th>
                        <th class="text-center p-2 text-red-500 ">Danger Zone</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listUser as $s)
                        <tr class="border-t">
                            <td class="p-2 pt-5 pb-5 ">{{ $s->id }}</td>
                            <td class="p-2 ">{{ $s->username}}</td>
                            <td class="p-2 ">{{ $s->email}}</td>
                            <td class="p-2 ">
                                {{ $s->role == 1 ? 'Superadmin' : ( $s->role == 2 ? 'Admin' : 'User')}}
                            </td>
                            <td class="p-2 max-w-[50px]">{{ $s->created_at }}</td>
                            <td class="p-2 max-w-[50px]">{{ $s->updated_at }}</td>
                            <td>
                                <button type="button" 
                                        x-data 
                                        x-on:click="$dispatch('open-modal', {name: 'passwordChangeModal', userId: '{{$s->id}}'})"
                                        class="text-white cursor-pointer px-4 py-2 rounded-2xl bg-[#F8971A] hover:opacity-60"
                                        >
                                    Change Password
                                </button>
                            </td>
                            <td class="p-2 bg-red-100">
                                <div class="flex flex-col gap-3 min-w-fit">
                                        <button type="button" 
                                                x-data 
                                                x-on:click="
                                                    if (confirm('Are you sure you want to delete this user?')) {
                                                        $wire.deleteUser({{$s->id}});
                                                        $dispatch('close-modal');
                                                    }
                                                "
                                                class="self-center text-white cursor-pointer px-4 py-2 rounded-2xl bg-red-600 hover:opacity-60"
                                                >
                                            Delete
                                        </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">No notes found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (session()->has('successDelete'))
            <div class="w-full pl-10 pr-10" role="alert">
                <p class="bg-green-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-green-400">
                Success: <span class="text-green-600 text-lg font-medium">{{ session('success') }}</span>
                </p>
            </div>
        @endif

        {{-- Display error message if it exists (e.g., from try-catch) --}}
        @if (session()->has('errorDelete'))
            <div class="w-full pl-10 pr-10" role="alert">
                <p class="bg-red-100 font-semibold text-xl text-gray-400 w-full p-2 pl-5 rounded-2xl border border-red-400">
                    Error: <span class="text-red-600 text-lg font-medium">{{ session('error') }}</span>
                </p>
            </div>
        @endif
        <div class="p-10">
            {{$listUser->links('vendor.livewire.tailwind')}}
        </div>
        <x-modal-AdminChangePassword name="passwordChangeModal" title="Test">
        </x-modal-AdminChangePassword>
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
    </script>
</div>