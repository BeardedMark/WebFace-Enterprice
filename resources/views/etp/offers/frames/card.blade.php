<div class="flex-col h-100 product-card" data-offer="{{ $offer['guid'] }}" data-variant="{{ $variant['guid'] ?? '' }}"
    data-price="{{ $offer['maxPrice'] ?? 0 }}">
    <a href="{{ route('offers.show', $offer['guid']) }}" onclick="showPreloader()"
        class="bord-other bord-rad-13 hover-up img-square back-light pad-5">
        @empty($offer['imageGuid'])
            <img class="lock" width="auto" height="auto"  src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
        @else
            <img class="mar-5 lock" width="auto" height="auto"  src="{{ route('images.proxy', ['type' => 'offer', 'guid' => $offer['imageGuid']]) }}"
                alt="{{ $offer['imageGuid'] }}">
        @endempty

        <div class="pos-abs pos-fill flex-col-8 font-sm w-100 h-100 hover-show">
            <div class="flex-row-8 flex-grow">
                <div class="pad-8 flex-row-5">
                    <div data-tooltip="@component('etp.offers.data.stock', [
                        'totalStock' => $offer['totalStock'],
                        'freeStock' => $offer['freeStock'],
                        'unit' => $offer['unit'],
                    ])
                            @endcomponent"
                        class="icon">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-regular/20{{ $offer['freeStock'] == 0 ? '/a3a4ac' : '' }}/warehouse-1.png"
                            alt="similar-items" />
                    </div>

                    @if ($offer['rating'] > 0)
                        <div data-tooltip="{{ $offer['rating'] }}%" class="icon">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-filled/20{{ $offer['rating'] > 10 ? '/F88070' : '' }}/fire-element.png"
                                alt="similar-items" />
                        </div>
                    @endif
                </div>

                <div class="pad-8 flex-row-5 flex-grow jc-end">
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
                </div>
            </div>
            <div class="flex-col">
                <p class="pad-13 font-xs flex-col back-light bord-t-other">
                    <span>Артикул: {{ $offer['article'] != "" ? $offer['article'] : '—' }}</span>
                    <span>Код: {{ $offer['code'] }}</span>
                    @if($offer['type'])
                        <span>Тип: {{ $offer['type'] }}</span>
                    @endisset
                </p>
            </div>
        </div>
    </a>

    <div class="flex-col pad-8 h-100">
        <p class="flex-col ai-start flex-grow pad-5 h-100">
            <a class="flex-col link font-md w-100" onclick="showPreloader()"
                href="{{ route('offers.show', $offer['guid']) }}">
                <span class="font-overflow" title="{{ $offer['name'] }}">{{ $offer['name'] }}</span>

                <span class="font-sm font-overflow" title="{{ $offer['description'] }}">
                    {{ !empty($offer['description']) ? $offer['description'] : $offer['type'] }}
                </span>
            </a>

            <span class="font-sm color-second">
                @if (isset($offer['manufacturer']))
                    <a href="{{ route('manufacturers.show', $offer['manufacturer']['guid']) }}" class="link-second"
                        data-tooltip="Производитель">
                        {{ $offer['manufacturer']['name'] }}
                    </a>
                @endif

                @if (isset($offer['brand']) && isset($offer['manufacturer']))
                    /
                @endif

                @if (isset($offer['brand']))
                    <a href="{{ route('brands.show', $offer['brand']['guid']) }}" class="link-second"
                        data-tooltip="Марка (бренд)">
                        {{ $offer['brand']['name'] }}
                    </a>
                @endif
            </span>
        </p>

        <div class="flex-row ai-end">
            <p class="flex-row-8 flex-grow pad-x-5">
                @if ($offer['maxPrice'] > 0)
                    @if (isset($offer['minPrice']) && $offer['minPrice'] > 0 && $offer['maxPrice'] != $offer['minPrice'])
                        <span class="font-md font-bold curs-help"
                            data-tooltip="{{ $offer['countVariants'] > 1 ? 'до ' : '' }}<x-number :value="$offer['maxPrice']" />₽">
                        {{ $offer['countVariants'] > 1 ? 'от ' : '' }}{{ $offer['minPrice'] }} ₽</span>
                    @else
                        <span class="font-md font-bold {{ $offer['maxPrice'] > 0 ? '' : 'color-second' }}">
                            {{ $offer['countVariants'] > 1 ? 'от ' : '' }}<x-number :value="$offer['maxPrice']" />
                            ₽/{{ $offer['unit'] }}</span>
                    @endif
                @else
                    <span class="color-second font-sm">Цена по запросу</span>
                @endif
            </p>

            <div class="flex-row-8 ai-center">
                @if ($offer['countVariants'] > 0)
                    <a href="{{ route('offers.show', $offer['guid']) }}" class="icon-second font-md font-bold"
                        data-tooltip="Вариантов" onclick="showPreloader()">{{ $offer['countVariants'] }}
                    </a>
                @else
                    @component('etp.offers.data.counter', ['offerGuid' => $offer['guid']])
                    @endcomponent
                @endif
            </div>
        </div>
    </div>
</div>
