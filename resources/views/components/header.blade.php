<div class="flex-col-5 pad-x-13 flex-grow">
    @isset($title)
        <{{ $tag ?? 'p'}} class="font-{{ $size ?? 'lg'}} color-brand">
            {{ $title }}
        </{{ $tag ?? 'p'}}>
    @endisset

    @isset($description)
        <p class="font-lg color-main">{{ $description }}</p>
    @endisset

    @isset($note)
        <p class="font-md color-second">{{ $note }}</p>
    @endisset
</div>
