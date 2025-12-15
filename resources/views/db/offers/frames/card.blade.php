<div class="flex-col h-100 product-card" data-offer="{{ $offer['guid'] }}" data-variant="{{ $variant['guid'] ?? '' }}">
    <a href="{{ route('offers.show', $offer['guid']) }}" onclick="showPreloader()"
        class="bord-other bord-rad-13 hover-up img-square back-light pad-5">
        @empty($offer['imageGuid'])
            <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
        @else
            <img class="mar-5 lock"
                src="{{ config('enterprice.base_url') }}public_api/offer/GetImage?guid={{ $offer['imageGuid'] }}"
                alt="{{ $offer['imageGuid'] }}">
        @endempty

        <div class="pos-abs pos-fill flex-row font-sm w-100 h-100 hover-show">
            <div class="pad-8 flex-row-5">
                <div data-tooltip="@component('db.offers.data.stock', [
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
                    <div data-tooltip="{{ $offer['rating'] }}" class="icon">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-filled/20{{ $offer['rating'] > 10 ? '/F88070' : '' }}/fire-element.png"
                            alt="similar-items" />
                    </div>
                @endif
            </div>

            <div class="pad-8 flex-row-5 flex-grow jc-end">
                <!-- Кнопка сравнения -->
                {{-- @if ($offer['countVariants'] == 0)
                    <button onclick="Compare.toggle('{{ $offer['guid'] }}')" data-tooltip="К сравнению"
                        class="icon{{ in_array($offer['guid'], session('favorites', [])) ? '-second' : '' }}">
                        <span id="cmp-{{ $offer['guid'] }}">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-{{ in_array($offer['guid'], session('compare', [])) ? 'filled' : 'regular' }}/20/similar-items.png"
                                alt="similar-items" /></span>
                    </button>
                @endif --}}

                <!-- Кнопка избранного -->
                <button onclick="Favorites.toggle('{{ $offer['guid'] }}')" data-tooltip="В избранное"
                    class="icon{{ in_array($offer['guid'], session('compare', [])) ? '-second' : '' }}">
                    <span id="fav-{{ $offer['guid'] }}">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-{{ in_array($offer['guid'], session('favorites', [])) ? 'filled' : 'regular' }}/20/bookmark-ribbon.png"
                            alt="bookmark-ribbon" /></span>
                </button>
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

            @if (isset($offer['manufacturer']) || isset($offer['brand']))
                <span class="font-sm color-second">
                    {{ $offer['manufacturer'] ? $offer['manufacturer']['name'] : '' }}
                    @if (isset($offer['manufacturer']) && isset($offer['brand']))
                        ,
                    @endif
                    {{ $offer['brand'] ? $offer['brand']['name'] : '' }}
                </span>
            @endif
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
                            {{ $offer['countVariants'] > 1 ? 'от ' : '' }}<x-number :value="$offer['maxPrice']" /> ₽/{{ $offer['unit'] }}</span>
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
                    @component('db.offers.data.counter', ['offerGuid' => $offer['guid']])
                    @endcomponent
                @endif
            </div>
        </div>
    </div>
</div>
