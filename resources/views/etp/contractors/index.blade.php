@extends('auth.layouts.sidebar')
@section('title', 'Ваши контрагенты')
@section('description', 'Список доступных вам юридических лиц')
@section('canonical', route('contractors.index'))

@section('sidebar-content')
    <x-code :code="compact('contractors')" />

    <div class="flex-col-34">

        <section class="flex-row-8 pad-e-8">
            <div class="flex-col-21 flex-grow">
                <x-breadcrumbs :items="$breadcrumbs" />
                <x-header tag='h1' size='xxl' title="Мои контрагенты" description="Список доступных вам юридических лиц"
                    note="Контрагентов в списке: {{ count($contractors) }}" />
            </div>

            <div class="flex-row-5">
                <button onclick="openModal('more')" data-tooltip="Еще" class="icon">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/more.png" alt="more" />
                </button>
            </div>
        </section>

        <div class="flex-col-5 pad-x-13">
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

    </div>
@endsection
