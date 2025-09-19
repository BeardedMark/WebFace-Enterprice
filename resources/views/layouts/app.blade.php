<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="robots" content="noindex, nofollow">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', '1SWEB - 1С для клиентов')</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/markup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @if (config('settings.debug.grid'))
        <link rel="stylesheet" href="{{ asset('css/debug.css') }}">
    @endif
    @stack('styles')

</head>

<body>
    <x-preloader />

    @yield('app-content')

    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('scripts')
</body>

</html>
