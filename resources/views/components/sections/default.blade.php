<section id="{{ $section['code'] }}" class="flex-col-34 pad-x-5">
    {{-- <div class="flex-col-8 pad-x-5">
        @isset($section['title'])
            <h2>{{ $section['title'] }}</h2>
        @endisset

        @isset($section['description'])
            <p class="color-second">{{ $section['description'] }}</p>
        @endisset
    </div> --}}

    <div class="flex-row ai-end">
        <x-header tag='h3' color='brand' :title="$section['title']" :description="$section['description']" />

        @isset($section['links'])
            <div class="flex-row-5 pad-x-8">
                @foreach ($section['links'] as $link)
                    <a class="item-{{ isset($link['template']) ? $link['template'] : 'other' }}"
                        title="{{ $link['description'] }}" href="{{ $link['url'] }}"
                        target="{{ isset($link['target']) ? '_blink' : '' }}"">{{ $link['title'] }}</a>
                @endforeach
            </div>
        @endisset
    </div>

    @php
        $count = count($section['items']);

        $columns = match (true) {
            $count <= 1 => 1,
            $count <= 2 => 2,
            $count <= 3 => 3,
            $count <= 4 => 4,
            $count <= 9 => 3,
            default => 4,
        };

        $colClass = 'col-' . 12 / $columns;
    @endphp

    @isset($section['items'])
        <div class="row g-4">
            @foreach ($section['items'] as $item)
                <div class="col {{ $colClass }}">
                    @component('components.frames.' . ($item['template'] ?? 'default'), $item)
                    @endcomponent
                </div>
            @endforeach
        </div>
    @endisset

    @if (!empty($section['catalogs']))
        <div class="row g-4">
            @foreach ($section['catalogs'] as $catalog)
                <div class="col">
                    @component('enterprise.catalogs.frames.card', compact('catalog'))
                    @endcomponent
                </div>
            @endforeach
        </div>
    @endif

    @if (!empty($section['offers']))
        <div class="row g-4">
            @foreach ($section['offers'] as $offer)
                <div class="col">
                    @component('enterprise.offers.frames.card', compact('offer'))
                    @endcomponent
                </div>
            @endforeach
        </div>
    @endif

    @if (!empty($section['manufacturers']))
        <div class="row g-4">
            @foreach ($section['manufacturers'] as $manufacturer)
                <div class="col">
                    @component('enterprise.manufacturers.frames.card', compact('manufacturer'))
                    @endcomponent
                </div>
            @endforeach
        </div>
    @endif

    @if (!empty($section['posts']))
        <div class="row g-4">
            @foreach ($section['posts'] as $post)
                <div class="col">
                    @component('enterprise.posts.frames.card', compact('post'))
                    @endcomponent
                </div>
            @endforeach
        </div>
    @endif

    @if (!empty($section['organizations']))
        <div class="row g-4">
            @foreach ($section['organizations'] as $organization)
                <div class="col">
                    @component('enterprise.organizations.components.card', compact('organization'))
                    @endcomponent
                </div>
            @endforeach
        </div>
    @endif

    @if (!empty($section['persons']))
        <div class="row g-4">
            @foreach ($section['persons'] as $person)
                <div class="col">
                    @component('enterprise.persons.components.card', compact('person'))
                    @endcomponent
                </div>
            @endforeach
        </div>
    @endif

    @isset($section['content'])
        <div class="html pad-x-13">
            {!! $section['content'] !!}
        </div>
    @endisset
</section>
