<div class="flex-col h-100">
    <a href="{{ route('offers.show', $offer['guid']) }}" onclick="showPreloader()"
        title="Арт: {{ !empty($offer['article']) ? $offer['article'] : '#' . $offer['code'] }}"
        class="bord-other bord-rad-13 hover-up img-square back-light pad-5">
        @empty($offer['imageGuid'])
            <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
        @else
            <img class="mar-5 lock"
                src="{{ config('enterprice.base_url') }}public_api/offer/GetImage?guid={{ $offer['imageGuid'] }}"
                alt="{{ $offer['imageGuid'] }}">
        @endempty

        <div class="pos-abs pos-fill flex-col  font-sm w-100 h-100 hover-show">


            <div class="pad-8 flex-row-5 jc-end ai-center">

                @if ($offer['rating'] > 0)
                    <div data-tooltip="{{ $offer['rating'] }}" class="icon">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-filled/20{{ $offer['rating'] > 10 ? '/F88070' : ''}}/fire-element.png"
                            alt="similar-items" />
                    </div>
                @endif
            </div>

            {{-- <div class="flex-col flex-grow pad-21 jc-end">
                <div class="pad-x-13 flex-grow">Арт:
                    {{ !empty($offer['article']) ? $offer['article'] : '#' . $offer['code'] }}</div>

                <span>Рейтинг: {{ $offer['rating'] }}</span>

                <span class="flex-grow item-other">Наличие:
                    @component('db.offers.data.stock', [
                        'totalStock' => $offer['totalStock'],
                        'freeStock' => $offer['freeStock'],
                        'unit' => $offer['unit'],
                    ])
                    @endcomponent
                </span>
            </div> --}}

            {{-- <div class="pad-8 flex-row-5 jc-end ai-center">
                <form action="{{ route('offers.toggleCompare', $offer['guid']) }}" method="POST">
                    @csrf
                    <button class="icon{{ in_array($offer['guid'], session('compare', [])) ? '-second' : '' }}"
                        type="submit">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-{{ in_array($offer['guid'], session('compare', [])) ? 'filled' : 'regular' }}/20/similar-items.png"
                            alt="similar-items" />
                    </button>
                </form>

                <form action="{{ route('offers.toggleFavorite', $offer['guid']) }}" method="POST">
                    @csrf
                    <button class="icon{{ in_array($offer['guid'], session('favorites', [])) ? '-second' : '' }}"
                        type="submit">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-{{ in_array($offer['guid'], session('favorites', [])) ? 'filled' : 'regular' }}/20/bookmark-ribbon.png"
                            alt="bookmark-ribbon" />
                    </button>
                </form>
            </div> --}}
        </div>
    </a>

    <div class="flex-col pad-8 h-100">
        <p class="flex-col ai-start flex-grow pad-5 h-100">
            <a class="flex-col link font-md w-100" onclick="showPreloader()"
                href="{{ route('offers.show', $offer['guid']) }}">
                <span class="font-overflow" title="{{ $offer['name'] }}">{{ $offer['name'] }}</span>

                <span class="font-sm font-overflow" title="{{ $offer['description'] }}">
                    @if ($offer['countVariants'] <= 1)
                        {{ !empty($offer['description']) ? $offer['description'] : $offer['type'] }}
                    @else
                        Вариантов: {{ $offer['countVariants'] }}
                    @endif
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
                        {{-- <span class="font-md color-second font-through">
                            {{ $offer['countVariants'] > 1 ? 'от ' : '' }}{{ $offer['maxPrice'] }}₽</span> --}}
                        <span class="font-md font-bold">
                            {{ $offer['countVariants'] > 1 ? 'от ' : '' }}{{ $offer['minPrice'] }}₽</span>
                        <span class="font-sm color-second">
                            {{ $offer['countVariants'] > 1 ? 'до ' : '' }}{{ $offer['maxPrice'] }}₽</span>
                    @else
                        <span class="font-md font-bold {{ $offer['maxPrice'] > 0 ? '' : 'color-second' }}">
                            {{ $offer['countVariants'] > 1 ? 'от ' : '' }}<x-number :value="$offer['maxPrice']" />₽</span>
                    @endif
                @else
                    <span class="color-second">Цена по запросу</span>
                @endif
            </p>

            <div class="flex-row-8 ai-center">
                @if ($offer['countVariants'] > 0)
                    <a href="{{ route('offers.show', $offer['guid']) }}" class="icon-second font-sm"
                        onclick="showPreloader()">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-regular/20/more.png" alt="more" /></a>
                @else
                    <form action="{{ route('basket.add') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="offerGuid" value="{{ $offer['guid'] }}">
                        <button class="icon-main" onclick="showPreloader()" data-tooltip="В корзину" type="submit">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-filled/FCFBFB/20/buy--v1.png"
                                alt="buy--v1" />
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
