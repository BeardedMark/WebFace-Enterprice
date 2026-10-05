<div class="flex-col-8">
    <x-header tag='h3' size='lg' color='second' :title="$section['title']" :description="$section['description']" />

    <ul>
        @foreach ($section['links'] as $link)
            <li><a class="item-prime" href="{{ $link['url'] }}"
                    title="{{ $link['description'] }}">{{ $link['title'] }}</a></li>
        @endforeach
    </ul>
</div>
