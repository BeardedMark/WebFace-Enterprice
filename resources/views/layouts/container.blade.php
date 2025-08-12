@extends('layouts.app')

@section('app-content')
    <div class="flex-col-55 h-100">
        @include('partials.header')

        <main class="container h-100">
            <div class="flex-col-34">
                @yield('container-content')
            </div>
        </main>

        @include('partials.footer')
    </div>
@endsection
