<div class="flex-row-8 ai-center pad-x-13">
    <p class="font-sm color-second flex-row-5 flex-grow flex-wrap ">
        @foreach ($items as $index => $item)
            @if ($index > 0)
                /
            @endif

            @if (!empty($item['url']))
                <a class="link font-overflow" style="max-width: 200px" onclick="showPreloader()" href="{{ $item['url'] }}" title="{{ $item['title'] }}">{{ $item['title'] }}</a>
            @else
                <span class="font-overflow" style="max-width: 200px" title="{{ $item['title'] }}">{{ $item['title'] }}</span>
            @endif
        @endforeach
    </p>

    {{-- <span class="flex-row-5">
        <x-share />
    </span> --}}
</div>
