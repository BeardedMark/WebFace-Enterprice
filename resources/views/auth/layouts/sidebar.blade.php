@extends('layouts.container')

@section('container-content')
    <div class="row g-4">
        {{-- <div class="col"> --}}
        <div class="col-12 col-md">
            @yield('sidebar-content')
        </div>

        {{-- <div class="col col-4 offset-1"> --}}
        <div class="col-12 col-md-4 offset-md-1">
            <div class="flex-col-21">
                <div class="flex-col-5">
                    <a class="item-other" href="{{ route('auth.main') }}">Мой профиль</a>
                    <a class="item-other" href="{{ route('contractors.index') }}">Мои контрагенты</a>
                    {{-- <a class="item-other" href="{{ route('offers.price') }}">Персональные цены</a>
                    <a class="item-other" href="{{ route('orders.index') }}">История заказов</a> --}}
                </div>

                <div class="flex-col-5">
                    {{-- <a class="item-other" href="https://1s.dnlmarket.ru/ut/ru/" target="_blink">Перейти в 1С
                        Предприятие</a> --}}
                    <a class="item-other color-danger" href="{{ route('auth.logout') }}">Выйти из профиля</a>
                </div>
            </div>
        </div>
    </div>
@endsection
