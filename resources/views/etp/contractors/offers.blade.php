@extends('auth.layouts.sidebar')
@section('title', 'История товаров')
@section('description', 'Список товаров которые приобретались')
@section('canonical', route('contractors.offers'))

@section('sidebar-content')
    <x-code :code="compact('contractors', 'offers')" />

    <div class="flex-col-34">
        <div class="flex-col-21 flex-grow">
            <x-breadcrumbs :items="$breadcrumbs" />
            <x-header tag='h1' size='xxl' title="История товаров"
                description="Список товаров которые вы приобретали" />
        </div>

        <form method="GET" action="{{ route('contractors.offers') }}" class="flex-row-5 pad-x-8">
            <select class="input flex-grow" name="contractor" onchange="this.form.submit()">
                <option value="">Выберите контрагента</option>
                @foreach ($contractors as $contractor)
                    <option value="{{ $contractor['guid'] }}"
                        {{ request('contractor') == $contractor['guid'] ? 'selected' : '' }}>{{ $contractor['name'] }}
                    </option>
                @endforeach
            </select>

            {{-- если у тебя в запросе есть еще параметры (например, page, search), их надо сохранить --}}
            @foreach (request()->except('contractor') as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            <button class="d-none" type="submit" class="btn">Найти</button>
        </form>

        <div class="pad-x-5">
            @if (count($offers) > 0)
                @component('etp.orders.frames.offers-list', ['offers' => $offers])
                @endcomponent
            @else
                <p class="pad-x-8 flex-col">
                    <span class="font-lg color-warning">Список товаров пуст</span>
                    <span class="color-second">Выберите другого контрагента или оформите новый заказ</span>
                </p>
            @endif
        </div>
    </div>
@endsection
