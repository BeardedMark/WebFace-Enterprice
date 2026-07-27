@extends('auth.layouts.sidebar')

@section('sidebar-content')
<x-code :code="compact('user')" />

    <section class="flex-col-21">
        <x-header tag='h1' size='xxl' title="Личный кабинет" description="Добро пожаловать, {{ $user['name'] }}!"
            note="У вас есть доступ к {{ $user['contractorCount'] }} контрагентам" />

    </section>
@endsection
