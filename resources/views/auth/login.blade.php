@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div id="auth">
    <div class="row h-50">
        <div class="col-lg-5 col-12">
            <div id="auth-left" class="mb-2">
                <div class="auth-logo text-center">
                    <a href="/">
                        <h1>Toko Sandang Murah</h1>
                        <span>
                            Sistem Informasi Penjualan Pupuk & Pestisida Pertanian
                        </span>
                    </a>
                </div>
                <h3 class="mb-3">Halaman Login</h3>
                @if (session('success'))
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "{{ session('success') }}",
                    });
                </script>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div
                        class="form-group position-relative has-icon-left mb-4"
                    >
                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            placeholder="email"
                        />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div
                        class="form-group position-relative has-icon-left mb-4"
                    >
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="password"
                        />

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-success btn-block btn-md shadow-md mt-2"
                    >
                        {{ __("Login") }}
                    </button>
                </form>
                <p></p>
                <p class="mt-2 mb-2">
                        <!-- <a class="mt-2" href="{{ route('password.request') }}">Lupa Password?</a> -->
                        <a class="" href="/u/register">Belum Punya Akun? Register</a>
                    </p>
                    <p>
                        <p>
                            <br>
                        </p>
                    </p>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div  id="auth-right" style="background-image: url('/assets1/img/sandang_murah_logo.png'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        </div>
    </div>
</div>
@endsection
