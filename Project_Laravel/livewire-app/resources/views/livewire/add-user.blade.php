<div class="flex flex-col w-auto pl-10 pr-10 pb-20 gap-15">
    <div class="flex flex-col border border-amber-300 bg-white pt-10 pb-10 rounded-4xl gap-10">
        {{-- Add wire:submit to your form to trigger the createTechlog method --}}
        <form wire:submit.prevent="createUser" class="flex flex-col gap-20">
            <div class="flex flex-col gap-10">
                <h1 class="self-center text-3xl text-[#F8971A] tracking-widest font-medium">
                    ADD USER
                </h1>
                <div class="flex flex-col items-center justify-around w-full gap-15 pl-5 pr-5 [&>*]:w-6/12 [&>*]:max-h-fit">
                    <div class="flex flex-col">
                        <label for="invoiceDate">
                            Username
                        </label>
                        <input wire:model="input_username" type="text" name="invoiceDate" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_invoiceDate') border-red-500 @enderror">
                        @error('input_invoiceDate')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="salesOrder">
                            Email 
                        </label>
                        <input wire:model="input_email" type="email" name="salesOrder" id="" placeholder="Enter email" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_salesOrder') border-red-500 @enderror">
                        @error('input_salesOrder')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
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
                        @error('input_invoiceDate')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="invoiceDate">
                            Confirm Password 
                        </label>
                        <input wire:model="input_confirmPassword" type="password" name="invoiceDate" id="" class="bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('input_invoiceDate') border-red-500 @enderror">
                        @error('input_invoiceDate')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="flex flex-col ">
                        <label for="serviceType">
                            Service Type <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="input_serviceType" name="serviceType" id="serviceType" class="w-full bg-gray-50 border text-gray-900 text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('input_serviceType') border-red-500 @enderror">
                            <option value="" selected>-- Select Service Type --</option>
                            @foreach($serviceType_ddl as $type)
                                <option value="{{$type->id}}">{{$type->service_type_name}}</option>
                            @endforeach
                        </select>
                        @error('input_serviceType')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div> --}}
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
    </script>
</div>