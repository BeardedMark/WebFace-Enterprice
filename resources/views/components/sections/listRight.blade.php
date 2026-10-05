
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

            @isset($section['$image'])
                <div class="bord-rad-5 img-cover back-light">
                    <img src="{{ $section['$image'] }}" alt="api" />
                </div>
            @endisset
        </div>
    </div>

    <div class="col col-7 offset-1">
        <div class="flex-col-21 pad-x-5">
            @foreach ($section['items'] as $item)
                <div class="flex-col-5 flex-grow pad-x-5">
                    @isset($item['title'])
                        <h3 class="font-lg"><span class="color-brand">●</span> {{ $item['title'] }}</h3>
                    @endisset

                    @isset($item['description'])
                        <p class="font-md">{{ $item['description'] }}</p>
                    @endisset
                </div>

                {{-- <div class="cut"></div> --}}
            @endforeach
        </div>
    </div>
</section>
