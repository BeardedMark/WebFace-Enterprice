<div class="flex-row-8 ai-center">
    <span class="flex-row-5">
        <a class="icon" onclick="showPreloader()" data-tooltip="Все разделы" href="{{ route('catalogs.tree') }}">
            <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/tree-structure.png" alt="tree-structure" />
        </a>
    </span>

    <span class="font-sm color-second flex-row-8 flex-grow flex-wrap">
        @foreach ($items as $index => $item)
            @if ($index > 0)
                /
            @endif

            @if (!empty($item['url']))
                <a class="link" onclick="showPreloader()" href="{{ $item['url'] }}">{{ $item['title'] }}</a>
            @else
                <span >{{ $item['title'] }}</span>
            @endif
        @endforeach
    </span>

    <span class="flex-row-5">
        <x-share />
    </span>
</div>
