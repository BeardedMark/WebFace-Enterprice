<div class="flex-col-8 pad-x-13">
    @isset($title)
        <{{ $tag ?? 'p'}} class="font-{{ $size ?? 'lg'}}">
            {{ $title }}
        </{{ $tag ?? 'p'}}>
    @endisset

    @isset($description)
        <p class="font-lg color-main">{{ $description }}</p>
    @endisset

    @isset($note)
        <p class="font-md color-main">{{ $note }}</p>
    @endisset
</div>
