<div class="container flex flex-row w-full h-screen" style="">
    <div class="w-full bg-gradient-to-tl from-amber-100 via-[#F8971A]/70 to-purple-500">
        {{-- <div class="bg-blue-900 opacity-20 size-full">This div element has position: absolute;</div> --}}
    </div>
    <div class="row justify-content-center w-full" style="max-width: 30%">
        <div class="col-md-4">
            <div class="card border-0 rounded shadow">
                <div class="card-body">
                    <h5 class="text-center"> <i class="fa fa-user-circle"></i> LOGIN</h5>
                    <hr>
                    <form wire:submit.prevent="login">

                        <div class="form-group">
                            <label class="font-weight-bold">Username</label>
                            <input type="text" wire:model.lazy="username"
                                class="form-control @error('username') is-invalid @enderror"
                                placeholder="username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">PASSWORD</label>
                            <input type="password" wire:model.lazy="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
