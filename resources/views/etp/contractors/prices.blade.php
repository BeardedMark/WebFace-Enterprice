@extends('auth.layouts.sidebar')
@section('title', 'Персональные цены')
@section('description', 'Список товаров на которые у вас есть персональные цены')
@section('canonical', route('contractors.prices'))

@section('sidebar-content')
    <x-code :code="compact('contractors', 'breadcrumbs', 'deals', 'offers')" />

    <div class="flex-col-34">
        <div class="flex-col-21 flex-grow">
            <x-breadcrumbs :items="$breadcrumbs" />
            <x-header tag='h1' size='xxl' title="Персональные цены" description="Список товаров на которые у вас есть персональные цены"/>
        </div>

        <form method="GET" action="{{ route('contractors.prices') }}" class="flex-col-5 pad-x-8">
            <select class="input flex-grow" name="contractor" onchange="this.form.submit()">
                <option value="">Выберите контрагента ({{ count($contractors) }})</option>
                @foreach ($contractors as $contractor)
                    <option value="{{ $contractor['guid'] }}"
                        {{ request('contractor') == $contractor['guid'] ? 'selected' : '' }}>{{ $contractor['name'] }}
                    </option>
                @endforeach
            </select>

            {{-- @if (count($deals) > 0) --}}
                <select class="input flex-grow" name="deal" onchange="this.form.submit()">
                    <option value="">Выберите соглашение ({{ count($deals) }})</option>
                    @foreach ($deals as $deal)
                        <option value="{{ $deal['guid'] }}" {{ request('deal') == $deal['guid'] ? 'selected' : '' }}>
                            {{ $deal['name'] }}</option>
                    @endforeach
                </select>
            {{-- @endif --}}

            {{-- если у тебя в запросе есть еще параметры (например, page, search), их надо сохранить --}}
            @foreach (request()->except('contractor', 'deal') as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach

            <button class="d-none" type="submit" class="btn">Найти</button>
        </form>

        @if (count($offers) > 0)
            <div class="pad-x-8">
                @component('etp.orders.frames.offers-list', ['offers' => $offers])
                @endcomponent
            </div>
        @endif
    </div>
@endsection
