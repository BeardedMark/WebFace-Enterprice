@if (isset($brand['manufacturer']['guid']))
    <a class="link back-light flex-row-8 bord-other bord-rad-13 hover-up pad-13 ai-center h-100" onclick="showPreloader()"
        href="{{ route('manufacturers.show', ['manufacturer' => $brand['manufacturer']['guid'], 'brand' => $brand['guid']]) }}">
        <span class="font-sm flex-grow">{{ $brand['name'] }}</span>
        @if ($brand['offersCount'] > 0)
            <span class="font-sm color-second" data-tooltip="Предложений">{{ $brand['offersCount'] }}</span>
        @endif
    </a>
@else
    <a class="link back-light flex-row-8 bord-other bord-rad-13 hover-up pad-13 ai-center h-100" onclick="showPreloader()"
        href="{{ route('pages.search', ['brand' => $brand['guid']]) }}">
        <span class="font-sm flex-grow">{{ $brand['name'] }}</span>
        @if ($brand['offersCount'] > 0)
            <span class="font-sm color-second" data-tooltip="Предложений">{{ $brand['offersCount'] }}</span>
        @endif
    </a>
@endif
