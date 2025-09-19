<a class="pos-rel hover-scale back-light flex-row bord-other bord-rad-13 over-hide h-100"
    @isset($link) href="{{ $link }}" @endif onclick="showPreloader()"
    style="max-height: {{ $height ?? '100%' }}">

    @isset($image)
        <div class="img-cover back-light" style="max-width: 100%">
            <img src="{{ $image }}" alt="{{ $image }}" />
        </div>
    @endisset

    @if (isset($icon) || isset($title) || isset($description) || isset($link))
        <div class="pos-abs hover-show back-black-60 h-100 w-100 flex-col-8 pad-21 h-100">
            @isset($icon)
                <img width="32" height="32" src="{{ $icon }}" alt="{{ $icon }}" />
            @endisset

            <div class="flex-col h-100 flex-center font-center">
                @isset($title)
                    <span class="font-md color-prime">{{ $title }}</span>
                @endisset

                @isset($description)
                    <span class="font-sm color-prime">{{ $description }}</span>
                @endisset

                @isset($link)
                    <span class="font-sm color-second">подробнее »</span>
                @endisset
            </div>
        </div>
    @endif
</a>
