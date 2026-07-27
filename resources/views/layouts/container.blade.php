@extends('layouts.app')

@section('app-content')
    <div class="flex-col-55" style="min-height: 100vh;">
        @include('partials.header')

        <main class="container flex-grow-1">
            <div class="flex-col-55">
                @yield('container-content')
            </div>
        </main>

        @include('partials.footer')
        @include('partials.alerts')
    </div>
@endsection
