@extends('layouts.container')
@section('title', $offer['name'] . ' купить в ДНЛ Маркет')
@section('description', 'купить ' . $offer['name'] . ' в магазине днл')
@section('canonical', route('offers.show', $offer['guid']))

@section('container-content')
    <section class="flex-col-21">
        <div class="row g-4">
            <div class="col-12 col-md order-2 order-md-2 offset-md-1">
                {{-- Header --}}
                <div class="flex-row-8 pad-e-8">
                    <div class="flex-col-21 flex-grow">
                        <x-breadcrumbs :items="$breadcrumbs" />
                        <x-header tag='h1' size='xxl' color='brand' title="{{ $offer['name'] ?? 'Каталог' }}" />
                    </div>

                    <div class="flex-row-5">
                        <x-code :code="compact('breadcrumbs', 'offer', 'variants')" />

                        <x-share />

                        <button onclick="openModal('more')" data-tooltip="Еще" class="icon">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-regular/20/more.png" alt="more" />
                        </button>
                    </div>
                </div>

                <div class="flex-col-5 pad-x-13">
                    @isset($description)
                        <p class="font-lg">{{ $description }}</p>
                    @endisset
                    @isset($offer['description'])
                        <p class="font-lg">{{ $offer['description'] }}</p>
                    @endisset

                    @if (isset($offer['manufacturer']) || isset($offer['brand']))
                        <p class="font-md color-second">
                            @isset($offer['manufacturer'])
                                <a href="{{ route('manufacturers.show', $offer['manufacturer']['guid']) }}"
                                    data-tooltip="Производитель">{{ $offer['manufacturer']['name'] }}</a>
                            @endisset

                            @if (isset($offer['manufacturer']) && isset($offer['brand']))
                                ,
                            @endif

                            @isset($offer['brand'])
                                <span class="curs-help" data-tooltip="Марка (бренд)">{{ $offer['brand']['name'] }}</span>
                            @endisset
                        </p>
                    @endif
                </div>

                <div class="flex-col-21 {{ count($variants) > 0 ? '' : 'product-card' }}" data-offer="{{ $offer['guid'] }}"
                    data-variant="{{ $variant['guid'] ?? '' }}" data-price="{{ $offer['maxPrice'] ?? 0 }}">
                    {{-- Main --}}

                    {{-- Price --}}
                    <div class="flex-col-5 pad-x-8">
                        <p class="flex-row-5 pad-x-5 ai-center font-lg ">
                            @if ($offer['maxPrice'] > 0)
                                @if (isset($offer['minPrice']) && $offer['minPrice'] > 0 && $offer['maxPrice'] != $offer['minPrice'])
                                    <span class="font-bold"><x-number :value="$offer['minPrice']" />₽</span>
                                    <span class="color-second">{{ $offer['countVariants'] > 1 ? '- ' : '' }}<x-number
                                            :value="$offer['maxPrice']" />₽</span>
                                @else
                                    <span class="font-bold {{ $offer['maxPrice'] > 0 ? '' : 'color-second' }}"><x-number
                                            :value="$offer['maxPrice']" />₽</span>
                                @endif
                            @else
                                <span class="color-second">Цена по запросу</span>
                            @endif
                        </p>
                    </div>

                    @if (count($variants) <= 0)
                        <div class="flex-row-5 ai-end w-100">
                            <div class="flex-row-5 flex-grow jc-end ai-center">
                                <!-- Кнопка сравнения -->
                                {{-- <button onclick="Compare.toggle('{{ $offer['guid'] }}', event)" data-tooltip="К сравнению"
                                    class="icon">
                                    <span id="cmp-{{ $offer['guid'] }}">
                                        <img width="20" height="20"
                                            src="https://img.icons8.com/fluency-systems-regular/20/similar-items.png"
                                            alt="similar-items" /></span>
                                </button> --}}

                                <!-- Кнопка избранного -->
                                {{-- <button onclick="Favorites.toggle('{{ $offer['guid'] }}', event)" data-tooltip="В избранное"
                                    class="icon">
                                    <span id="fav-{{ $offer['guid'] }}">
                                        <img width="20" height="20"
                                            src="https://img.icons8.com/fluency-systems-regular/20/bookmark-ribbon.png"
                                            alt="bookmark-ribbon" /></span>
                                </button> --}}

                                @component('etp.offers.data.counter', ['offerGuid' => $offer['guid'], 'variantGuid' => $variant['guid'] ?? null])
                                @endcomponent
                            </div>
                        </div>
                    @else
                        <div class="flex-col-5 pad-x-8">
                            {{-- <p class="font-md pad-x-5">Вариантов: {{ count($variants) }} ({{ $offer['countVariants'] }})
                            </p> --}}
                            @foreach ($variants as $variant)
                                <div class="flex-row-8 ai-center product-card" data-offer="{{ $offer['guid'] }}"
                                    data-variant="{{ $variant['guid'] ?? '' }}" data-price="{{ $variant['price'] ?? 0 }}">
                                    <div class="flex-center bord-other bord-rad-5 back-light pad-3"
                                        style="width: 64px; height: 64px;">


                                        @empty($variant['imageGuid'])
                                            <img class="h-100 lock"
                                                src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png"
                                                alt="no-image">
                                        @else
                                            <img class="h-100 lock"
                                                src="{{ route('images.proxy', ['type' => 'offer', 'guid' => $variant['imageGuid']]) }}"
                                                alt="{{ $variant['imageGuid'] }}">
                                        @endempty
                                    </div>

                                    <p class="flex-col flex-grow">
                                        <span>{{ $variant['name'] }}</span>

                                        <span class="flex-row-8">
                                            <span class="font-sm color-second" data-tooltip="Наличие">
                                                @component('etp.offers.data.stock', [
                                                    'totalStock' => $variant['totalStock'],
                                                    'freeStock' => $variant['freeStock'],
                                                    'unit' => $offer['unit'],
                                                ])
                                                @endcomponent
                                            </span>

                                            <span class="font-sm color-second flex-row-8">
                                                @foreach ($variant['attributes'] as $attribute)
                                                    <span data-tooltip="{{ $attribute['name'] }}">{{ $attribute['value'] }}</span>
                                                @endforeach
                                            </span>
                                        </span>
                                    </p>

                                    @if ($variant['price'] > 0)
                                        <span class="font-md font-bold"><x-number :value="$variant['price']" /> ₽</span>
                                    @else
                                        <span class="font-sm color-second">Цена по запросу</span>
                                    @endif

                                    @component('etp.offers.data.counter', ['offerGuid' => $offer['guid'], 'variantGuid' => $variant['guid'] ?? null])
                                    @endcomponent


                                    {{-- <form action="{{ route('basket.add') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="offerGuid" value="{{ $offer['guid'] }}">
                                <input type="hidden" name="variantGuid" value="{{ $variant['guid'] }}">
                                <button class="icon-main" type="submit">
                                    <img width="20" height="20"
                                        src="https://img.icons8.com/fluency-systems-filled/FCFBFB/20/buy--v1.png"
                                        alt="buy--v1" />
                                </button>
                            </form> --}}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-4 order-1 order-md-1">
                <div class="flex-col-21">
                    <div class="bord-other bord-rad-13 img-square lock back-light pad-5">
                        @if ($offer['imageGuid'])
                            <img class="mar-5 lock"
                                src="{{ route('images.proxy', ['type' => 'offer', 'guid' => $offer['imageGuid']]) }}"
                                alt="{{ $offer['imageGuid'] }}">
                        @else
                            <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png"
                                alt="no-image">
                        @endif
                    </div>

                    <div class="flex-col-8">
                        <div class="flex-col pad-x-13">
                            @foreach ($offer['attributes'] as $attribute)
                                <x-stat name="{{ $attribute['name'] }}" value="{{ $attribute['value'] }}" />
                            @endforeach
                        </div>

                        <button onclick="openModal('attributes')" class="link pad-x-13 flex font-sm">
                            Показать все характеристики
                        </button>
                    </div>

                    <x-modal name="attributes" title="Все характеристики">
                        <div class="flex-col-13 pad-x-5">
                            <div class="flex-col">
                                @foreach ($offer['attributes'] as $attribute)
                                    <x-stat name="{{ $attribute['name'] }}" value="{{ $attribute['value'] }}" />
                                @endforeach
                            </div>

                            <div class="flex-col">
                                <x-stat name="Артикул" value="{{ !empty($offer['article']) ? $offer['article'] : '—' }}" />
                                <x-stat name="Производитель"
                                    value="{{ $offer['manufacturer'] ? $offer['manufacturer']['name'] : '—' }}" />
                                <x-stat name="Марка" value="{{ $offer['brand'] ? $offer['brand']['name'] : '—' }}" />
                                <x-stat name="Рейтинг популярности" value="{{ $offer['rating'] }}%" />
                            </div>

                            <div class="flex-col">
                                <x-stat name="Код" value="{{ $offer['code'] }}" />
                                <x-stat name="Тип" value="{{ $offer['type'] ? $offer['type'] : '—' }}" />
                                <x-stat name="Категория" value="{{ $offer['parent'] ? $offer['parent']['name'] : '—' }}" />
                            </div>

                            <div class="flex-col">
                                <x-stat name="Вариантов товара" value="{{ $offer['countVariants'] }}" />
                                <x-stat name="Минимальная цена" value="{{ $offer['maxPrice'] ?? '—' }} руб" />
                                <x-stat name="Максимальная цена" value="{{ $offer['minPrice'] ?? '—' }} руб" />
                            </div>

                            @if (config('settings.debug.data'))
                                <div class="flex-col">
                                    <x-stat name="Свободный остаток"
                                        value="{{ $offer['freeStock'] }} {{ $offer['unit'] }}" />
                                    <x-stat name="Общий остаток"
                                        value="{{ $offer['totalStock'] }} {{ $offer['unit'] }}" />
                                </div>
                            @endif
                        </div>
                    </x-modal>
                </div>
            </div>
        </div>

        @if ($offer['content'])
            <div class="flex-col-21">
                <div class="html pad-x-13">
                    {!! $offer['content'] !!}
                </div>
            </div>
        @endif
    </section>

    <x-modal name="more" title="Дополнительные дейтвия">
        <div class="flex-col-5">
            <a class="item-other" title="Открыть запись по внешней ссылке"
                href="{{ config('enterprice.base') }}#{{ $offer['link'] }}">Открыть запись в
                1С:Предприятие</a>

            <div class="flex-row-5">
                <input type="text" class="input flex-grow" title="Внутренняя ссылка 1С" readonly
                    value="{{ $offer['link'] }}">

                <button id="copy-btn" title="Копировать ссылку" class="icon">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/copy--v1.png" alt="email--v1" />
                </button>
            </div>
        </div>
    </x-modal>
@endsection
