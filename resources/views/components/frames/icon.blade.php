<div class="back-light bord-other bord-rad-13 flex-col-8 flex-grow pad-13 h-100">
    @isset($image)
        <img width="64" height="64" src="{{ $image }}" alt="realtime-protection" />
    @endisset

    @isset($title, $title, $description)
        <div class="flex-col flex-grow">
            @isset($title)
                <h3 class="font-lg">
                    @isset($link)
                        <a class="link" href="{{ $link }}">{{ $title }}</a>
                    @else
                        {{ $title }}
                    @endisset
                </h3>
            @endisset

            @isset($description)
                <p class="font-md">{{ $description }}</p>
            @endisset
        </div>
    @endisset

    @isset($link)
        <a class="link-second font-sm" href="{{ $link }}">Подробнее »</a>
    @endisset
</div>
