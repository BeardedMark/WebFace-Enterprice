@extends('auth.layouts.sidebar')

@section('sidebar-content')
    <div class="flex-col-34">
        <div class="flex-col-5 pad-x-5">
            <h1 class="font-xxl font-bold">Персональный профиль</h1>
            <p class="font-lg">Добро пожаловать, {{ $user['name'] }}!</p>
            <p class="font-md">
                У вас есть доступ к {{ $user['contractorCount'] }} контрагентам
            </p>
        </div>

        <x-code :code="compact('user')" />
    </div>
@endsection
