<div class="flex-col-8 flex-row-8 h-100">
    <a href="{{ route('offers.show', $offer['guid']) }}" class="bord-other bord-rad-5 img-square back-light pad-5">
        @empty($offer['imageGuid'])
            <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
        @else
            <img class="mar-5 lock"
                src="{{ config('enterprice.base_url') }}Extensions/Image/get?guid={{ $offer['imageGuid'] }}"
                alt="{{ $offer['imageGuid'] }}">
        @endempty
    </a>

    {{-- top --}}
    <div class="flex-row-5 ai-center w-100">
        <p class="font-sm color-second flex-grow pad-x-5">Арт:
            {{ !empty($offer['article']) ? $offer['article'] : '#' . $offer['code'] }}</p>

        {{-- <form action="{{ route('offers.toggleCompare', $offer['guid']) }}" method="POST">
            @csrf
            <button class="icon{{ in_array($offer['guid'], session('compare', [])) ? '-second' : '' }}" type="submit">
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
        </form> --}}
    </div>

    {{-- middle --}}
    <p class="flex-col ai-start flex-grow pad-x-5 h-100" title="Поделиться">
        @if ($offer['countVariants'] <= 1)
            <a class="flex-col link font-md w-100" href="{{ route('offers.show', $offer['guid']) }}">
                <span class="font-overflow">{{ $offer['name'] }}</span>
                <span
                    class="font-sm font-overflow">{{ !empty($offer['description']) ? $offer['description'] : $offer['type'] }}</span>
            </a>
        @else
            <a class="link font-md font-overflow"
                href="{{ route('offers.show', $offer['guid']) }}">{{ $offer['name'] }}</a>
            <a href="#" class="link-second font-sm">Вариантов: {{ $offer['countVariants'] }}</a>
        @endif

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

    {{-- bottom --}}
    <div class="flex-row-5 ai-end">
        <p class="flex-col flex-grow pad-x-5">
            @if ($offer['price'] > 0)
                @if (isset($offer['personalPrice']) && $offer['personalPrice'] > 0)
                    <span
                        class="font-md color-second font-through">{{ $offer['countVariants'] > 1 ? 'от ' : '' }}{{ $offer['price'] }}
                        ₽</span>
                    <span
                        class="font-lg color-success font-bold">{{ $offer['countVariants'] > 1 ? 'от ' : '' }}{{ $offer['personalPrice'] }}
                        ₽</span>
                @else
                    <span
                        class="font-lg font-bold {{ $offer['price'] > 0 ? '' : 'color-second' }}">{{ $offer['countVariants'] > 1 ? 'от ' : '' }}<x-number
                            :value="$offer['price']" />
                        ₽</span>
                @endif
            @else
                <span class="color-second">Цена по запросу</span>
            @endif
        </p>

        <div class="flex-row-8 ai-center">
            <p class="font-sm color-{{ $offer['freeStock'] > 0 ? 'main' : 'second' }} font-end">
                @component('db.offers.data.stock', [
                    'totalStock' => $offer['totalStock'],
                    'freeStock' => $offer['freeStock'],
                    'unit' => $offer['unit'],
                ])
                @endcomponent
            </p>

            @if ($offer['countVariants'] > 0)
                <a href="{{ route('offers.show', $offer['guid']) }}" class="icon-second font-sm" type="submit">
                    <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/more.png"
                        alt="more" /></a>
            @else
                {{-- <form method="POST" action="{{ route('orders.update', $offer['guid']) }}">
                    @csrf
                    @method('PUT')
                    <button class="icon-main" type="submit">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-filled/FCFBFB/20/buy--v1.png" alt="buy--v1" />
                    </button>
                </form> --}}

                <form action="{{ route('basket.add') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="offerGuid" value="{{ $offer['guid'] }}">
                    <button class="icon-brand" data-tooltip="В корзину" type="submit">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-filled/FCFBFB/20/buy--v1.png" alt="buy--v1" />
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
