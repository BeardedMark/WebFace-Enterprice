@extends('layouts.container')
@section('title', 'Поиск по сайту')
@section('description', 'Найдите товар, категорию или другую информацию')
@section('canonical', route('pages.search'))

@section('container-content')
    <x-code :code="compact('offers')" />

    <section class="flex-col-21">
        <x-header tag='h1' size='xxl' color='brand' title="Поиск по сайту"
            description="Найдите товар, категорию или другую информацию" />
    </section>

    <section class="flex-col-21">

        <div class="flex-col-5 flex-grow">

            <div class="flex-row-8 pad-x-5">

                <form method="GET" action="{{ route('pages.search') }}">
                    <input type="text" class="input" placeholder="Поиск по каталогу" name="search"
                        value="{{ request('search') }}">
                    {{-- <input type="text" class="input" placeholder="Производитель" name="manufacturer"
                        value="{{ request('manufacturer') }}">
                    <input type="text" class="input" placeholder="Бренд" name="brand" value="{{ request('brand') }}"> --}}

                    <select class="input" name="sort" onchange="this.form.submit()">
                        <option value="rating-asc" {{ request('sort') == 'rating-desc' ? 'selected' : '' }}>Популярные
                        </option>
                        <option value="date-asc" {{ request('sort') == 'date-asc' ? 'selected' : '' }}>Новые</option>
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Дешевые</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Дорогие</option>
                    </select>

                    <select class="input" name="manufacturer" onchange="this.form.submit()">
                        <option value="">Все производители</option>
                        @foreach ($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer['guid'] }}" {{ request('manufacturer') == $manufacturer['guid'] ? 'selected' : '' }}>{{ $manufacturer['name'] }}</option>
                        @endforeach
                    </select>

                    <select class="input" name="brand" onchange="this.form.submit()">
                        <option value="">Все бренды</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand['guid'] }}" {{ request('brand') == $brand['guid'] ? 'selected' : '' }}>{{ $brand['name'] }}</option>
                        @endforeach
                    </select>

                    {{-- если у тебя в запросе есть еще параметры (например, page, search), их надо сохранить --}}
                    @foreach (request()->except('sort', 'search', 'manufacturer', 'brand') as $name => $value)
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endforeach
                    <button class="d-none" type="submit" class="btn">Найти</button>
                </form>
            </div>
        </div>
    </section>

    {{-- @if (count($catalogs) > 0)
        <section class="row g-2">
            @foreach ($catalogs as $catalogItem)
                <div class="col-12 col-md-6 col-lg-3">
                    @component('etp.catalogs.frames.card', ['catalog' => $catalogItem])
                    @endcomponent
                </div>
            @endforeach
        </section>
    @endif --}}

    @if (count($offers) > 0)
        <section class="row g-4">
            @foreach ($offers as $offer)
                <div class="col-6 col-md-4 col-lg-3">
                    @component('etp.offers.frames.card', compact('offer'))
                    @endcomponent
                </div>
            @endforeach
        </section>
    @endif

@endsection
