{{-- <a class="link back-light flex-row-8 bord-other bord-rad-13 hover-up pad-13 ai-center h-100"
    data-tooltip="{{ $catalog['description'] ?? '' }}" onclick="showPreloader()"
    href="{{ route('catalogs.show', $catalog['guid']) }}">

    @empty($catalog['imageGuid'])
    <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
@else
    <img class="mar-5 lock" src="{{ route('images.proxy', ['type' => 'offer', 'guid' => $catalog['imageGuid']]) }}"
        alt="{{ $catalog['imageGuid'] }}">
@endempty
    <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/folder-invoices--v1.png"
        alt="folder-invoices--v1" />
    <p class="flex-col  flex-grow">
        <span class="font-md">{{ $catalog['name'] }}</span>
        @isset($catalog['description'])
            <span class="font-sm color-second">{{ $catalog['description'] }}</span>
        @endisset
    </p>
    <span class="font-sm color-second" data-tooltip="Предложений">{{ $catalog['totalCountOffers'] ?? 0 }}</span>
</a> --}}


<a class="link back-light flex-col bord-other bord-rad-13 hover-up over-hide h-100" href="{{ route('catalogs.show', $catalog['guid']) }}"
    onclick="showPreloader()">

    @if($catalog['imageGuid'])
        <div class="img-cover back-light" style="height: 150px">
            <img width="auto" height="auto" src="{{ route('images.proxy', ['type' => 'offer', 'guid' => $catalog['imageGuid']]) }}" alt="{{ $catalog['imageGuid'] }}" />
        </div>
    @endif

    <div class="flex-row-8 pad-13 flex-grow ai-start">
        <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/folder-invoices--v1.png"
            alt="folder-invoices--v1" />

        <div class="flex-col flex-grow">
            @isset($catalog['name'])
                <span class="font-md">{{ $catalog['name'] }}</span>
            @endisset

            @isset($catalog['description'])
                <span class="font-sm color-second">{{ $catalog['description'] }}</span>
            @endisset

        </div>

        <span class="font-sm color-second" title="Предложений">{{ $catalog['totalCountOffers'] ?? 0 }}</span>
    </div>
</a>
