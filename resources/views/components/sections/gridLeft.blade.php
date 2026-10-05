<section class="row g-4 jc-center">
    <div class="col col-7">
        <div class="flex-col-21 pad-x-5">
            @foreach ($section['items'] as $item)
                @component('components.frames.' . ($item['template'] ?? 'default'), $item)
                @endcomponent
            @endforeach
        </div>
    </div>

    <div class="col offset-1">
        <div class="flex-col-8 pad-x-13">
            <x-header tag='h2' :title="$section['title']" :description="$section['description']" :note="$section['content']" />
        </div>
    </div>
</section>
