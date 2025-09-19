@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <div class="flex-col-21">
            <x-breadcrumbs :items="$breadcrumbs" />

            <div class="flex-col-5 flex-grow">
                <h1 class="flex-row-8 ai-end pad-x-5">
                    <span class="font-xxl font-bold flex-grow"
                        title="Название текущей категории">{{ $catalog['name'] ?? 'Каталог' }}</span>

                    @isset($catalog['code'])
                        <span class="font-sm color-second" title="Код текущей категории">#{{ $catalog['code'] ?? '' }}</span>
                    @endisset
                </h1>

                <div class="flex-row-8 pad-x-5">
                    <p class="font-lg flex-grow" title="Описание текущей категории">
                        {{ empty($catalog['name']) ? 'Корневой каталог' : 'Категория' }} товаров и предложений</p>

                    @if ($catalog['totalCountOffers'] > 0)
                        <div class="flex-row-13">
                            <p class="font-sm flex-row-5 ai-center curs-help" data-tooltip="Товаров">
                                <img width="20" height="20"
                                    src="https://img.icons8.com/fluency-systems-regular/20/package-delivery-logistics.png"
                                    alt="open-box" />
                                {{ $catalog['countOffers'] }}
                                {{ $catalog['totalCountOffers'] > $catalog['countOffers'] ? "/ {$catalog['totalCountOffers']}" : '' }}
                            </p>
                        </div>
                    @endif
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
