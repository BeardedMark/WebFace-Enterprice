<a class="link back-light flex-row-8 bord-other bord-rad-13 hover-up pad-13 ai-center h-100" onclick="showPreloader()"
    href="{{ route('manufacturers.show', $manufacturer['guid']) }}">

    @if($manufacturer['logoGuid'] != "")
        <img src="{{ route('images.proxy', ['type' => 'file', 'guid' => $manufacturer['logoGuid']]) }}"
            alt="{{ $manufacturer['logoGuid'] }}" />
    @endif

    <span class="font-sm flex-grow">{{ $manufacturer['name'] }}</span>
    <span class="font-sm color-second" data-tooltip="Предложений">{{ $manufacturer['offersCount'] ?? 0 }}</span>
</a>
