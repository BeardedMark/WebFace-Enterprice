<a class="link back-light flex-col bord-other bord-rad-13 hover-up over-hide h-100" href="{{ $link }}"
    onclick="showPreloader()" href="№">

    @isset($image)
        <div class="img-cover img-square back-light">
            <img src="{{ $image }}" alt="{{ $image }}" />
        </div>
    @endisset

    <div class="flex-col-8 pad-x-13 pad-y-13 h-100">
        @isset($icon)
            <img width="32" height="32" src="{{ $icon }}" alt="{{ $icon }}" />
        @endisset

        <div class="flex-col h-100">
            @isset($title)
                <span class="font-lg">{{ $title }}</span>
            @endisset

            <span class="font-md">{{ $offersCount }} <span class="font-md">предложений</span></span>

            @isset($description)
                <span class="font-sm color-second">{{ $description }}</span>
            @endisset
        </div>
    </div>
</a>
