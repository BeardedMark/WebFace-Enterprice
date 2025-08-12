@extends('layouts.container')

@section('container-content')
    <section class="flex-col-21">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="flex-col-5 flex-grow">
            <h1 class="flex-row-8 ai-end pad-x-5">
                <span class="font-xxl font-bold flex-grow" title="Название текущей категории">{{ $catalog['name'] ?? 'Каталог' }}</span>

                @isset($catalog['code'])
                    <span class="font-sm color-second" title="Код текущей категории">#{{ $catalog['code'] ?? '' }}</span>
                @endisset
            </h1>

            <div class="flex-row-8 pad-x-5">
                <p class="font-lg flex-grow" title="Описание текущей категории">
                    {{ empty($catalog['name']) ? 'Корневой каталог' : 'Категория' }} товаров и предложений</p>
                <div class="flex-row-13">
                    @if (count($catalogs) > 0)
                        <p class="font-sm flex-row-5 ai-center curs-help" data-tooltip="Папок">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-regular/20/folder-invoices--v1.png"
                                alt="folder-invoices--v1" />
                            {{ $catalog['countCatalogs'] }}{{ $catalog['countTotalCatalogs'] > $catalog['countCatalogs'] ? " / {$catalog['countTotalCatalogs']}" : '' }}
                        </p>
                    @endif

                    <p class="font-sm flex-row-5 ai-center curs-help" data-tooltip="Товаров">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-regular/20/package-delivery-logistics.png"
                            alt="open-box" />
                        {{ $catalog['countOffers'] }}{{ $catalog['countTotalOffers'] > $catalog['countOffers'] ? " / {$catalog['countTotalOffers']}" : '' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- <div class="flex-row-5 jc-end">
            <div class="flex-row-13 pad-x-5 flex-grow">
                <p class="font-sm flex-row-5 ai-center">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/package-delivery-logistics.png"
                        alt="open-box" />
                    {{ $catalog['countOffers'] }}{{ $catalog['countTotalOffers'] > $catalog['countOffers'] ? " / {$catalog['countTotalOffers']}" : '' }}
                </p>

                @if (count($catalogs) > 0)
                    <p class="font-sm flex-row-5 ai-center">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-regular/20/folder-invoices--v1.png"
                            alt="folder-invoices--v1" />
                        {{ $catalog['countCatalogs'] }}{{ $catalog['countTotalCatalogs'] > $catalog['countCatalogs'] ? " / {$catalog['countTotalCatalogs']}" : '' }}
                    </p>
                @endif
            </div>
        </div> --}}
    </section>

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

    <x-code :code="compact('catalog', 'catalogs', 'offers')" />
@endsection
