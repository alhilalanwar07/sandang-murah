@section('title', 'Register')
<div>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo text-center pb-1 p-1 m-1 mb-3">
                        <a href="/">
                            <h1>SiRoti</h1>
                            <span>
                                Sistem Informasi Pengolahan Transaksi Penjualan Roti
                                Karunia Mandiri
                            </span>
                        </a>
                    </div>
                    <form wire:submit.prevent="register" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <textarea wire:model="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" name="alamat" required autocomplete="alamat">{{ old('alamat') }}</textarea>
                            <div class="form-control-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input wire:model="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor telepon" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            @error('no_telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input wire:model="gambar" type="file" class="form-control @error('gambar') is-invalid @enderror" placeholder="Gambar" name="gambar" value="{{ old('gambar') }}" required autocomplete="gambar" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-file-image"></i>
                            </div>
                            @error('gambar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input wire:model="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button wire:click.prevent="register()" class="btn btn-primary btn-block btn-md shadow-md mt-2">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="text-muted mb-0">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>
</div>
