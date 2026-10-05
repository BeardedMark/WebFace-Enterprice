<section class="row g-4 jc-center">
    <div class="col col-9">
        <div class="flex-col-8 pad-x-13 flex-center font-center">
            @isset($section['title'])
                <h2>{{ $section['title'] }}</h2>
            @endisset

            @isset($section['description'])
                <p class="font-xl">{{ $section['description'] }}</p>
            @endisset

            @isset($section['links'])
                <div class="flex-row-5 pad-x-8 flex-center">
                    @foreach ($section['links'] as $link)
                        <a class="item-{{ isset($link['template']) ? $link['template'] : 'other' }}"
                            title="{{ $link['description'] }}" href="{{ $link['url'] }}"
                            target="{{ isset($link['target']) ? '_blink' : '' }}"">{{ $link['title'] }}</a>
                    @endforeach
                </div>
            @endisset
        </div>
    </div>

    @isset($section['items'])
        <div class="col col-12">
            <div class="row">
                @foreach ($section['items'] as $item)
                    <div class="col-4">
                        @isset($item['title'])
                            <h3 class="font-xl"><span class="color-brand">●</span> {{ $item['title'] }}</h3>
                        @endisset

                        @isset($item['description'])
                            <p class="font-md">{{ $item['description'] }}</p>
                        @endisset
                    </div>

                    <div class="cut"></div>
                @endforeach
            </div>
        </div>
    @endisset
</section>
