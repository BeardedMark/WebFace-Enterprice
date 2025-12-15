@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <div class="flex-col-21">
            <x-breadcrumbs :items="$breadcrumbs" />

            <div class="flex-col-5 flex-grow pad-x-13">
                <h1 class="flex-row-8 ai-end pad-x-5">
                    <span class="font-xxl font-bold flex-grow"
                        title="Название текущей категории">
                        {{ $catalog['name'] ?? 'Каталог' }}
                        @if (count($offers) > 0)
                            ({{ count($offers) }})
                        @endif
                    </span>

                    @isset($catalog['code'])
                        <span class="font-sm color-second" title="Код текущей категории">#{{ $catalog['code'] ?? '' }}</span>
                    @endisset
                </h1>

                <div class="flex-row-8 pad-x-5">
                    <p class="font-lg flex-grow" title="Описание текущей категории">
                        {{ empty($catalog['name']) ? 'Корневой каталог' : 'Категория' }} товаров и предложений</p>

                    <form method="GET" action="{{ url()->current() }}">
                        <select class="input" name="sort" onchange="this.form.submit()">
                            <option value="rating-asc" {{ request('sort') == 'rating-desc' ? 'selected' : '' }}>Популярные</option>
                            <option value="date-asc" {{ request('sort') == 'date-asc' ? 'selected' : '' }}>Новые</option>
                            <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Дешевые</option>
                            <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Дорогие</option>
                        </select>

                        {{-- если у тебя в запросе есть еще параметры (например, page, search), их надо сохранить --}}
                        @foreach (request()->except('sort') as $name => $value)
                            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                        @endforeach
                    </form>
                </div>
            </div>
        </div>

        @if (count($catalogs) > 0)
            <section class="row g-2">
                @foreach ($catalogs as $catalogItem)
                    <div class="col-12 col-md-6 col-lg-3">
                        @component('db.catalogs.frames.card', ['catalog' => $catalogItem])
                        @endcomponent
                    </div>
                @endforeach
            </section>
        @endif

        @if (count($offers) > 0)
            <section class="row g-4">
                @foreach ($offers as $offer)
                    <div class="col-6 col-md-4 col-lg-3">
                        @component('db.offers.frames.card', compact('offer'))
                        @endcomponent
                    </div>
                @endforeach
            </section>
        @endif
    </section>

    <x-code :code="compact('catalog', 'catalogs', 'offers')" />
@endsection
