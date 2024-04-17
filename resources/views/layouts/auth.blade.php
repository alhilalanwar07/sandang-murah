<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title') | {{ config('app.name') }}
    </title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/main/app.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/pages/auth.css">
    {{-- icon --}}
    <link rel="shortcut icon" href="{{ url('/') }}/assets1/img/sandang_murah_logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('/') }}/assets1/img/sandang_murah_logo.png" type="image/png">

</head>

<body>
    @yield('content')
    @livewireScripts
</body>
</html>

