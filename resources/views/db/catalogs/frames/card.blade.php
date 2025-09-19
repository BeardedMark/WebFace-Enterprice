<a class="link back-light flex-row-8 bord-other bord-rad-13 hover-up pad-13 ai-center h-100" onclick="showPreloader()" href="{{ route('catalogs.show', $catalog['guid']) }}">
    <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/folder-invoices--v1.png"
        alt="folder-invoices--v1" />

    <span class="font-sm flex-grow">{{ $catalog['name'] }}</span>
    <span class="font-sm color-second" data-tooltip="Предложений">{{ $catalog['totalCountOffers'] ?? 0 }}</span>
</a>
