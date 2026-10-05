<div class="flex-col flex-grow pad-x-5">
    @isset($title)
        <h3 class="font-xl color-brand">{{ $title }}</h3>
    @endisset

    @isset($description)
        <p class="font-md">{{ $description }}</p>
    @endisset
</div>
