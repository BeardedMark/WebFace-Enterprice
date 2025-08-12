@extends('layouts.container')

@section('container-content')
    <section class="flex-col-21">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="flex-col-5 flex-grow">
            <h1 class="flex-row-8 ai-end pad-x-5 color-brand">
                <span class="font-xxl font-bold flex-grow">Каталоги товаров</span>
            </h1>

            <div class="flex-row-8 pad-x-5">
                <p class="font-lg flex-grow">Подробная структура разделов каталога</p>
                <div class="flex-row-13">
                    {{-- @if (count($catalogs) > 0)
                        <p class="font-sm flex-row-5 ai-center" data-tooltip="Папок в каталоге">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-regular/20/folder-invoices--v1.png"
                                alt="folder-invoices--v1" />
                            {{ $catalog['countCatalogs'] }}{{ $catalog['countTotalCatalogs'] > $catalog['countCatalogs'] ? " / {$catalog['countTotalCatalogs']}" : '' }}
                        </p>
                    @endif

                    <p class="font-sm flex-row-5 ai-center" data-tooltip="Товаров в каталоге">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-regular/20/package-delivery-logistics.png"
                            alt="open-box" />
                        {{ $catalog['countOffers'] }}{{ $catalog['countTotalOffers'] > $catalog['countOffers'] ? " / {$catalog['countTotalOffers']}" : '' }}
                    </p> --}}
                </div>
            </div>
        </div>
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

    <x-code :code="compact('catalogs')" />
@endsection
