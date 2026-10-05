
<div class="flex-col-5 flex-grow pad-x-5">
    @isset($title)
        <h3 class="font-lg"><span class="color-brand">●</span> {{ $title }}</h3>
    @endisset

    @isset($description)
        <p class="font-md">{{ $description }}</p>
    @endisset
</div>
