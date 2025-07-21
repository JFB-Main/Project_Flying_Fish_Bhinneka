<div>
    <div class="container" style="margin-top: 120px">
        <div class="row justify-content-center">
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
</div>  
