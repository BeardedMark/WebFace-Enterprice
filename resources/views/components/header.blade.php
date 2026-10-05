<div class="flex-col-5 pad-x-13 flex-grow">
    @isset($title)
        <{{ $tag ?? 'p'}} class="font-{{ $size ?? 'xxl'}} color-{{ $color ?? 'contast'}}">
            {{ $title }}
        </{{ $tag ?? 'p'}}>
    @endisset

    @isset($description)
        <p class="font-md color-main">{{ $description }}</p>
    @endisset

    @isset($note)
        <p class="font-sm">{{ $note }}</p>
    @endisset
</div>
