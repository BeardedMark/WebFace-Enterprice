@extends('layouts.container')

@section('container-content')
    <section class="flex-col-21">
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="row g-4">
            <div class="col-12 col-md order-2 order-md-2 offset-md-1">
                <div class="flex-col-21">
                    <div class="flex-col-5 pad-x-5">
                        <div class="flex-row-8">
                            <h1 class="font-xxl font-bold flex-grow">{{ $offer['name'] }}</h1>
                            <p class="font-sm color-second">Арт:
                                {{ !empty($offer['article']) ? $offer['article'] : '#' . $offer['code'] }}</p>
                        </div>

                        @isset($offer['description'])
                            <p class="font-lg">{{ $offer['description'] ?? '' }}</p>
                        @endisset

                        @isset($offer['type'])
                            <p class="font-md">{{ $offer['type'] }}</p>
                        @endisset

                        @if (isset($offer['manufacturer']) || isset($offer['brand']))
                            <span class="font-sm color-second">
                                {{ $offer['manufacturer'] ? $offer['manufacturer']['name'] : '' }}
                                @if (isset($offer['manufacturer']) && isset($offer['brand']))
                                    ,
                                @endif
                                {{ $offer['brand'] ? $offer['brand']['name'] : '' }}
                            </span>
                        @endif

                        <span>Спрос: {{ $offer['rating'] }}%</span>
                    </div>

                    @if ($offer['countVariants'] <= 0)
                        <div class="flex-col-5">
                            <p class="flex-col pad-x-5">
                                <span
                                    class="color-{{ isset($offer['freeStock']) && $offer['freeStock'] > 0 ? 'main' : 'second' }}">
                                    Кол-во:
                                    @component('db.offers.data.stock', [
                                        'totalStock' => $offer['totalStock'],
                                        'freeStock' => $offer['freeStock'],
                                        'unit' => $offer['unit'],
                                    ])
                                    @endcomponent
                                </span>
                            </p>

                            <p class="flex-col pad-x-5">

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
                                            {{ $offer['countVariants'] > 1 ? 'от ' : '' }}<x-number
                                                :value="$offer['maxPrice']" />₽</span>
                                    @endif
                                @else
                                    <span class="color-second">Цена по запросу</span>
                                @endif
                            </p>
                        </div>

                        <div class="flex-row-5 ai-end w-100">
                            <div class="flex-row-5 flex-grow jc-end ai-center">


                                {{-- <form action="{{ route('offers.toggleCompare', $offer['guid']) }}" method="POST">
                                    @csrf
                                    <button
                                        class="icon{{ in_array($offer['guid'], session('compare', [])) ? '-second' : '' }}"
                                        type="submit">
                                        <img width="20" height="20"
                                            src="https://img.icons8.com/fluency-systems-{{ in_array($offer['guid'], session('compare', [])) ? 'filled' : 'regular' }}/20/similar-items.png"
                                            alt="similar-items" />
                                    </button>
                                </form>

                                <form action="{{ route('offers.toggleFavorite', $offer['guid']) }}" method="POST">
                                    @csrf
                                    <button
                                        class="icon{{ in_array($offer['guid'], session('favorites', [])) ? '-second' : '' }}"
                                        type="submit">
                                        <img width="20" height="20"
                                            src="https://img.icons8.com/fluency-systems-{{ in_array($offer['guid'], session('favorites', [])) ? 'filled' : 'regular' }}/20/bookmark-ribbon.png"
                                            alt="bookmark-ribbon" />
                                    </button>
                                </form> --}}

                                <form method="POST" action="{{ route('orders.update', $offer['guid']) }}">
                                    @csrf
                                    <input type="hidden" name="offerGuid" value="{{ $offer['guid'] }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="button-main" type="submit">В Корзину</button>
                                </form>



                            </div>
                        </div>
                    @else
                        <div class="flex-col-5 pad-x-5">
                            @foreach ($variants as $variant)
                                <div class="cut"></div>

                                <div class="flex-row-8 ai-center">
                                    <div class="flex-center bord-other bord-rad-5 back-light pad-3"
                                        style="width: 64px; height: 64px;">
                                        @empty($variant['imageGuid'])
                                            <img class="lock"
                                                src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png"
                                                alt="no-image">
                                        @else
                                            <img class="lock"
                                                src="{{ config('enterprice.base_url') }}public_api/offer/GetImage?guid={{ $variant['imageGuid'] }}"
                                                alt="{{ $variant['imageGuid'] }}">
                                        @endempty
                                    </div>

                                    <p class="flex-col flex-grow">
                                        <span>{{ $variant['name'] }}</span>

                                        <span class="font-sm color-second">
                                            @component('db.offers.data.stock', [
                                                'totalStock' => $variant['totalStock'],
                                                'freeStock' => $variant['freeStock'],
                                                'unit' => $offer['unit'],
                                            ])
                                            @endcomponent
                                        </span>
                                    </p>
                                    @if ($variant['price'] > 0)
                                        <span class="font-md font-bold"><x-number :value="$variant['price']" /> ₽</span>
                                    @else
                                        <span class="font-sm color-second">Цена по запросу</span>
                                    @endif

                                    <form action="{{ route('basket.add') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="offerGuid" value="{{ $offer['guid'] }}">
                                        <input type="hidden" name="variantGuid" value="{{ $variant['guid'] }}">
                                        <button class="icon-brand" type="submit">
                                            <img width="20" height="20"
                                                src="https://img.icons8.com/fluency-systems-filled/FCFBFB/20/buy--v1.png"
                                                alt="buy--v1" />
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-4 order-1 order-md-1">
                <div class="bord-other bord-rad-5 img-square lock back-light pad-5">
                    @if ($offer['imageGuid'])
                        <img class="mar-5 lock"
                            src="{{ config('enterprice.base_url') }}public_api/offer/GetImage?guid={{ $offer['imageGuid'] }}"
                            alt="{{ $offer['imageGuid'] }}">
                    @else
                        <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png"
                            alt="no-image">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <x-code :code="compact('offer', 'variants')" />
@endsection
