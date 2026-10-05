@extends('layouts.container')
@section('title', $meta['seo']['title'])
@section('description', $meta['seo']['description'])
@section('canonical', $meta['seo']['canonical'])

@section('container-content')

    <section class="flex-row-8 pad-e-8">
        <div class="flex-col-21 flex-grow">
            {{-- <x-breadcrumbs :items="$breadcrumbs" /> --}}
            <x-header tag='h1' size='xxl' color='brand' :title="$page['title']" :description="$page['description']" />
        </div>

        <div class="flex-row-5">
            <x-code :code="compact('meta', 'page', 'catalogs', 'offers')" />
            <x-share/>

            <button onclick="openModal('more')" data-tooltip="Еще" class="icon">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/more.png"
                    alt="more" />
            </button>
        </div>
    </section>

    @if (count($catalogs) > 0)
        <section class="flex-col-21">
            @component('enterprise.catalogs.frames.grid', compact('catalogs'))
            @endcomponent
        </section>
    @endif

    @if (count($offers) > 0)
        @component('enterprise.offers.frames.grid', compact('offers'))
        @endcomponent
    @endif

    {{-- @if (count($page['popularOffers']) > 0)
        <div class="cut"></div>

        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-row ai-end">
                        <x-header tag='h2' size='xxl' color='brand' title="Хиты продаж"
                            description="Товары которые имеют наивысшую популярность" />

                        <a class="item-other" href="{{ route('catalogs.index') }}">Изучить каталог</a>
                    </div>

                    @isset($page['popularOffers'])
                        <div class="row g-4">
                            @foreach ($page['popularOffers'] as $popularOffer)
                                <div class="col-6 col-md-4 col-lg-2">
                                    @component('enterprise.offers.frames.card', ['offer' => $popularOffer])
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                    @endisset
                </div>
            </div>
        </section>
    @endif --}}

    {{-- @if (count($page['newOffers']) > 0)
        <div class="cut"></div>

        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-row ai-end">
                        <x-header tag='h2' size='xxl' color='brand' title="Наши новинки"
                            description="Новые позиции в нашем ассортименте" />

                        <a class="item-other" href="{{ route('pages.search') }}">Открыть каталог</a>
                    </div>

                    @isset($page['newOffers'])
                        <div class="row g-4">
                            @foreach ($page['newOffers'] as $newOffer)
                                <div class="col-6 col-md-4 col-lg-2">
                                    @component('enterprise.offers.frames.card', ['offer' => $newOffer])
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                    @endisset
                </div>
            </div>
        </section>
    @endif --}}


    {{-- @if (count($page['manufacturers']) > 0)
        <div class="cut"></div>
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-row ai-end">
                        <x-header tag='h2' size='xxl' color='brand' title="Производители наших товаров"
                            description="Наши производители, поставщики и партнеры" />

                        <a class="item-other" href="{{ route('manufacturers.index') }}">Все производители</a>
                    </div>

                    <div class="row g-4">
                        @foreach ($page['manufacturers'] as $manufacturer)
                            <div class="col-6 col-md-4 col-lg-3">
                                @component('enterprise.manufacturers.frames.card', compact('manufacturer'))
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (count($page['brands']) > 0)
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-row ai-end">
                        <x-header tag='h3' size='xl' color='brand' title="Бренды производителей"
                            description="Крупные линейки марок (брендов) товаров" />

                        <a class="item-other" href="{{ route('brands.index') }}">Все бренды</a>
                    </div>

                    <div class="row g-4">
                        @foreach ($page['brands'] as $brand)
                            <div class="col-6 col-md-4 col-lg-3">
                                @component('enterprise.brands.frames.card', compact('brand'))
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif --}}

    @isset($page['data']['content'])
        <section class="flex-col-21">
            <div class="html pad-x-13">
                {!! $page['data']['content'] !!}
            </div>
        </section>
    @endisset

    <x-modal name="more" title="Дополнительные дейтвия">
        <div class="flex-col-5">
            {{-- <a class="item-other" title="Открыть запись по внешней ссылке" href="{{ config('enterprice.base') }}#{{ $catalog['link'] }}">Открыть запись в
                1С:Предприятие</a> --}}

            {{-- <div class="flex-row-5">
                <input type="text" class="input flex-grow" title="Внутренняя ссылка 1С" readonly value="{{ $catalog['link'] }}">

                <button id="copy-btn" title="Копировать ссылку" class="icon">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/copy--v1.png" alt="email--v1" />
                </button>
            </div> --}}
        </div>
    </x-modal>
@endsection
