

{{-- <p class="flex-row-8 ai-center">
    @empty($offer['imageGuid'])
        <img class="lock" height="100" width="100"
            src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
    @else
        <img class="mar-5 lock" height="100" width="100"
            src="{{ route('images.proxy', ['type' => 'offer', 'guid' => $offer['imageGuid']]) }}"
            alt="{{ $offer['imageGuid'] }}">
    @endempty

    <span class="flex-col flex-grow">
        <a class="link" href="{{ route('offers.show', $offer['offer']['guid']) }}">
            {{ $offer['offer']['name'] }}</a>
        @if ($offer['variant'])
            <a class="link font-sm" href="{{ route('offers.show', $offer['variant']['guid']) }}">
                {{ $offer['variant']['name'] }}</a>
        @endif
    </span>

    <span>{{ $offer['price'] }}</span>
</p> --}}

<div class="flex-row-13 ai-center product-card" data-offer="{{ $offer['offer']['guid'] }}"
    data-variant="{{ $offer['variant']['guid'] ?? '' }}"
    data-price="{{ $offer['price'] }}"
    data-quantity="{{ 1 }}">

    <a href="{{ route('offers.show', $offer['offer']['guid']) }}" onclick="showPreloader()"
        class="flex-center bord-other bord-rad-5 back-light pad-3" style="width: 64px; height: 64px;">
        @empty($offer['imageGuid'])
            <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
        @else
            {{-- <img class="lock"
                src="{{ route('images.proxy', ['type' => 'extension', 'guid' => $offer['imageGuid']]) }}"
                alt="{{ $offer['imageGuid'] }}"> --}}
                <img class="lock"
                            src="{{ route('images.proxy', ['type' => 'offer', 'guid' => $offer['imageGuid']]) }}"
                            alt="{{ $offer['imageGuid'] }}">
        @endempty
    </a>

    <div class="flex-col flex-grow pad-x-5">
        <a class="link flex-col" href="{{ route('offers.show', $offer['offer']['guid']) }}">
            {{ $offer['offer']['name'] }}
            @isset($offer['variant'])
                <span class="font-sm color-second">{{ $offer['variant']['name'] }}</span>
            @endisset
        </a>
    </div>


    <div class="flex-col font-end flex-grow">
        <p class="font-sm"><x-number :value="$offer['price']" /> ₽</p>
        <p class="font-bold totalPrice"></p>
    </div>

    @component('etp.offers.data.counter', [
        'offerGuid' => $offer['offer']['guid'],
        'variantGuid' => $offer['variant']['guid'] ?? null,
        'showCounter' => true,
        'initialQuantity' =>  1,
    ])
    @endcomponent
</div>
