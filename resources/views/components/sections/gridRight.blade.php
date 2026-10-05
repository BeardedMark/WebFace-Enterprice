<section class="row g-4">
    <div class="col">
        <div class="flex-col-13 pad-x-8">
            <x-header tag='h2' :title="$section['title']" :description="$section['description']" :note="$section['content']" />

            @isset($section['links'])
                <div class="flex-row-5 pad-x-8">
                    @foreach ($section['links'] as $link)
                        <a class="item-{{ isset($link['template']) ? $link['template'] : 'other' }}"
                            title="{{ $link['description'] }}" href="{{ $link['url'] }}"
                            target="{{ isset($link['target']) ? '_blink' : '' }}"">{{ $link['title'] }}</a>
                    @endforeach
                </div>
            @endisset

            @isset($section['image'])
                <div class="bord-rad-5 img-cover back-light">
                    <img src="{{ $section['image'] }}" alt="api" />
                </div>
            @endisset
        </div>
    </div>

    <div class="col col-7 offset-1">
        <div class="flex-col-21 pad-x-5">
            <div class="row g-4">
                @foreach ($section['items'] as $item)
                    <div class="col-6">
                        @component('components.frames.' . ($item['template'] ?? 'default'), $item)
                        @endcomponent
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
