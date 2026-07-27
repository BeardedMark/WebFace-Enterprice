<!DOCTYPE html>
<html lang="ru">

<head>
    {{-- <meta name="robots" content="noindex, nofollow"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $baseData['name'])</title>
    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @endif
    @hasSection('keywords')
        <meta name="keywords" content="@yield('keywords')">
    @endif
    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')">
    @endif
    @stack('meta')

    <link rel="icon" href="{{ asset('16-dark.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/markup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/html.css') }}">
    @if (config('settings.debug.grid'))
        <link rel="stylesheet" href="{{ asset('css/debug.css') }}">
    @endif
    @stack('styles')

    @include('layouts.components.head')
</head>

<body>
    <x-preloader />

    @yield('app-content')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/basket.js') }}"></script>
    <script src="{{ asset('js/favorites.js') }}"></script>
    <script src="{{ asset('js/compare.js') }}"></script>
    <script src="{{ asset('js/bitrixPopup.js') }}"></script>
    @stack('scripts')
</body>

</html>
