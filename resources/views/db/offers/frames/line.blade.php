<div class="cut"></div>

<div class="flex-row-8">
    {{-- <a href="{{ route('offers.show', $offer['Ref_Key']) }}" class="bord-other bord-rad-5 img-square back-light pad-5">
        @empty($offer['ФайлКартинки_Key'])
            <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
        @else
            <img class="mar-5 lock"
                src="https://1s.dnlmarket.ru/ut/hs/webface/offers/getImage?guid={{ $offer['ФайлКартинки_Key'] }}"
                alt="{{ $offer['ФайлКартинки_Key'] }}">
        @endempty
    </a> --}}

    <p class="flex-col">
        <a class="link" href="{{ route('offers.show', $offer['Ref_Key']) }}">
            {{ $offer['Description'] }}</a>
        <span class="font-sm color-second flex-grow">Арт: {{ $offer['Артикул'] ?? $offer['Code'] }}</span>

        {{-- <span>{{ $offer['countVariations'] }}</span> --}}
    </p>
</div>
