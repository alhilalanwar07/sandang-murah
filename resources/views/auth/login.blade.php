@extends('layouts.auth')
@section('title', 'Login')
@section('content')

{{-- css dari auth --}}
{{-- @push('css') --}}
<style>
    #auth {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    #auth-left {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #auth-right {
        background: url('/assets1/img/sandang_murah_logo.png');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        height: 100%;
        border-radius: 10px;
    }
    .auth-logo h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
    }
    .auth-logo span {
        font-size: 0.8rem;
        color: #666;
    }
    .auth-logo a {
        text-decoration: none;
    }
    */ bg */
    .bg-primary {
        background-color: #007bff !important;
    }
</style>
{{-- @endpush --}}

<div id="auth" class="">
    <div class="row h-80">
        <div class="">
            <div id="auth-left" class="mb-2">
                <div class="auth-logo text-center">
                    <a href="/">
                        <h1>Toko Sandang Murah</h1>
                        <span>
                            Sistem Informasi Penjualan Pupuk & Pestisida Pertanian
                        </span>
                    </a>
                </div>
                <p></p>
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

                    <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div
                        class="form-group position-relative has-icon-left mb-1"
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
                    <label for="password" class="col-md-12 col-form-label text-md-right">{{ __('Password') }}</label>
                    <div
                        class="form-group position-relative has-icon-left mb-1"
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
    </div>
</div>
@endsection
