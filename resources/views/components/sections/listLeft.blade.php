
<section class="row g-4 jc-center">
    <div class="col col-7">
        <div class="flex-col-21 pad-x-5">
            @foreach ($section['items'] as $item)
                <div class="flex-col-5 flex-grow pad-x-5">
                    @isset($item['title'])
                        <h3 class="font-lg">{{ $item['title'] }}</h3>
                    @endisset

                    @isset($item['description'])
                        <p class="font-md">{{ $item['description'] }}</p>
                    @endisset
                </div>

                {{-- <div class="cut"></div> --}}
            @endforeach
        </div>
    </div>

    <div class="col offset-1">
        <div class="flex-col-8 pad-x-13">
            @isset($section['title'])
                <h2>{{ $section['title'] }}</h2>
            @endisset

            @isset($section['description'])
                <p class="color-second">{{ $section['description'] }}</p>
            @endisset
        </div>
    </div>
</section>
