{{-- <a class="link back-light flex-col-8 bord-other bord-rad-13 hover-up pad-13 h-100" onclick="showPreloader()"
    href="{{ route('posts.show', ['post' => $post['guid']]) }}">
    <span class="font-md">{{ $post['name'] }}</span>
    <span class="font-sm flex-grow">{{ $post['description'] }}</span>

    <p class="flex-row-8">
        <span class="font-xs color-second flex-grow">{{ date('d.m.Y H:i', strtotime($post['publishedAt'])) }}</span>
        @if ($post['linksCount'] > 0)
            <span class="font-xs color-second">Ссылок: {{ $post['linksCount'] }}</span>
        @endif
    </p>
</a> --}}

<a class="link back-light flex-col bord-other bord-rad-13 hover-up over-hide h-100" href="{{ route('posts.show', ['post' => $post['guid']]) }}"
    onclick="showPreloader()">

    @isset($post['imageUrl'])
        <div class="img-cover back-light" style="height: 200px">
            <img src="{{ $post['imageUrl'] }}" alt="{{ $post['name'] }}" />
        </div>
    @endisset

    <div class="flex-col-13 pad-13 flex-grow">
        <div class="flex-col-8 flex-grow">
            @isset($post['name'])
                <span class="font-md">{{ $post['name'] }}</span>
            @endisset

            @isset($post['description'])
                <span class="font-sm">{{ $post['description'] }}</span>
            @endisset

        </div>

        <span class="font-sm color-second">{{ date('d.m.Y H:i', strtotime($post['publishedAt'])) }}</span>
    </div>
</a>
