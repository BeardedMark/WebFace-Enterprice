<a class="link flex-row-8 frame-other bord-rad-5 pad-13 ai-center h-100" href="{{ route('catalogs.show', $catalog['guid']) }}">
    <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/folder-invoices--v1.png"
        alt="folder-invoices--v1" />

    <span class="font-sm flex-grow">{{ $catalog['name'] }}</span>
    <span class="font-sm color-second">{{ $catalog['countOffers'] }}</span>
</a>
