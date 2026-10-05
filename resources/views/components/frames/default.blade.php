<div class="back-light bord-other bord-rad-13 flex-col-13 flex-grow pad-13 h-100">
    @isset($image)
        <div class="bord-rad-5 img-cover back-light">
            <img src="{{ $image }}" alt="api" />
        </div>
    @endisset

    @isset($title)
        <h3 class="font-lg pad-x-5">{{ $title }}</h3>
    @endisset

    @isset($description)
        <p class="font-md pad-x-5">{{ $description }}</p>
    @endisset

    @isset($link)
        <a class="pad-x-5" href="{{ $link }}">Подробнее »</a>
    @endisset
</div>
