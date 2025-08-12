@extends('auth.layouts.sidebar')

@section('sidebar-content')
    <div class="flex-col-34">
        <div class="flex-col-5 pad-x-5">
            <h1 class="font-xxl font-bold">Ваши контрагенты</h1>
            <p class="font-lg">Список доступных юридических лиц</p>
            <p class="font-md">Контрагентов в списке: {{ count($contractors) }}</p>
        </div>

        <div class="flex-col-5 pad-x-5">
            <p class="row g-1 ai-center font-sm color-second">
                <span class="col-5">Наименование</span>
                <span class="col-2">ИНН</span>
                <span class="col-3">Доступ</span>
                <span class="col-2 font-end">Заказов</span>
            </p>

            @foreach ($contractors as $contractor)
                <div class="cut"></div>

                <p class="row g-1 ai-center">
                    @if ($contractor['isActive'])
                        <a class="col-5 link" href="{{ route('contractors.show', $contractor['guid']) }}">
                            {{ $contractor['name'] }}</a>
                    @else
                        <span class="col-5 color-second">
                            {{ $contractor['name'] }}</span>
                    @endif

                    <span class="col-2 font-sm color-second">
                        {{ $contractor['inn'] }}</span>
                    <span class="col-3 font-sm color-second">
                        {{ !$contractor['isActive'] ? 'Ожидание' : ($contractor['isAdmin'] ? 'Управляющий' : 'Сотрудник') }}</span>
                    <span class="col-2 font-sm font-end {{ $contractor['isActive'] ? '' : 'color-second' }}">
                        {{ $contractor['isActive'] ? $contractor['ordersCount'] : '?' }} зак.</span>
                </p>
            @endforeach
        </div>

        <x-code :code="compact('contractors')" />
    </div>
@endsection
