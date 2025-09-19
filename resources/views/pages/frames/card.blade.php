<a class="link back-light flex-col bord-other bord-rad-13 hover-up over-hide h-100" href="{{ $link ?? '#' }}"
    onclick="showPreloader()">

    @isset($image)
        <div class="img-cover back-light"  style="height: {{ $height ?? '200px' }}">
            <img src="{{ $image }}" alt="{{ $image }}" />
        </div>
    @endisset

    @if (isset($icon) || isset($title) || isset($description))
        <div class="flex-col-8 pad-13">
            @isset($icon)
                <img width="32" height="32" src="{{ $icon }}" alt="{{ $icon }}" />
            @endisset

            <div class="flex-col h-100">
                @isset($title)
                    <span class="">{{ $title }}</span>
                @endisset

                @isset($description)
                    <span class="font-sm color-second">{{ $description }}</span>
                @endisset
            </div>
        </div>
    @endif
</a>
