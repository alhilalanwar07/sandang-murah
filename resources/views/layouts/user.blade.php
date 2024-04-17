<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Toko sandang murah adalah toko yang menjual pupuk dan pestisida pertanian">
    <meta name="keywords" content="toko sandang murah">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    {{-- icon --}}
    <link rel="shortcut icon" href="{{ url('/') }}/assets1/img/sandang_murah_logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('/') }}/assets1/img/sandang_murah_logo.png" type="image/png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/css/iconly.css">
    {{-- @yield('css') --}}
    @livewireStyles

    <style>
        .main-navbar {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
        }

        .main-navbar.active {
            max-height: 500px;
            /* Adjust the max-height value as needed */
            opacity: 1;
        }

    </style>

</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="#"><img src="{{ url('/') }}/assets1/img/sandang_murah_logo.png" alt="Logo" srcset="" style="width: 70px; height: 100%"></a>

                        </div>
                        <div class="header-top-right">
                            <div class="">
                                <marquee behavior="" direction="left" class="text-danger font-weight-bold">Selamat Datang di Toko Sandang Murah | Buka Mulai 08.00 - 17.00 WITA | Gratis Ongkir untuk Pembelian diatas Rp. 300.000,-</marquee>
                            </div>
                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="https://ui-avatars.com/api/?name={{ Auth::check() ? Auth::user()->name : '' }}" alt="User Image" class="rounded-circle">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">
                                            {{ Auth::check() ? Auth::user()->name : '' }}
                                        </h6>
                                        <p class="user-dropdown-status text-sm text-muted">
                                            {{ Auth::check() ? Auth::user()->role : '' }}
                                        </p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                    <li><a class="dropdown-item" href="#">My Account</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    {{-- logout --}}
                                    @auth
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </form>
                                    </li>
                                    @endauth
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none" id="burger-btn">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item @if (Request::is('/')) active @endif">
                                <a href="/" class="menu-link">
                                    <span><i class="bi bi-grid-fill"></i> Beranda</span>
                                </a>
                            </li>
                            <li class="menu-item @if (Request::is('u/produk')) active @endif">
                                <a href="/u/produk" class="menu-link">
                                    <span><i class="bi bi-box"></i> Produk</span>
                                </a>
                            </li>
                            <li class="menu-item @if (Request::is('u/keranjang')) active @endif">
                                <a href="/u/keranjang" class="menu-link">
                                    <span><i class="bi bi-cart"></i> Keranjang</span>
                                </a>
                            </li>
                            <li class="menu-item @if (Request::is('u/pesanan')) active @endif">
                                <a href="/u/pesanan" class="menu-link">
                                    <span><i class="bi bi-list-check"></i> Pesanan</span>
                                </a>
                            </li>
                            <li class="menu-item @if (Request::is('u/kontak')) active @endif">
                                <a href="/u/kontak" class="menu-link">
                                    <span><i class="bi bi-telephone-fill"></i> Kontak</span>
                                </a>
                            </li>
                            {{-- logout --}}
                            @auth
                            <li class="menu-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class=" menu-link" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <span><i class="bi bi-box-arrow-right"></i> Keluar</span>
                                    </a>
                                </form>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="content-wrapper container">


                @yield('content')


            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2024 &copy; Toko Sandang Murah</p>
                        </div>
                        <div class="float-end">
                            <p>Made with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="#">Arif</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/static/js/initTheme.js"></script>
    <!-- Start content here -->

    <!-- End content -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/static/js/components/dark.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/compiled/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/zuramai/mazer@docs/demo/assets/static/js/pages/dashboard.js"></script>
    @livewireScripts
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const burgerBtn = document.getElementById('burger-btn');
            const navbar = document.querySelector('.main-navbar');

            if (window.innerWidth > 768) {
                navbar.classList.add('active');
            }

            burgerBtn.addEventListener('click', function() {
                navbar.classList.toggle('active');
            });
        });

    </script>

</body>

</html>
