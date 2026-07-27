<a class="pos-rel hover-scale back-light flex-row bord-other bord-rad-13 over-hide h-100" href="{{ route('posts.show', ['post' => $post['guid']]) }}"
    onclick="showPreloader()" style="max-height: {{ $height ?? '100%' }}">

    @isset($post['imageUrl'])
        <div class="img-cover back-light" style="max-width: 100%">
            <img src="{{ $post['imageUrl'] }}" alt="{{ $post['name'] }}" />
        </div>
    @endisset

    <span class="pos-abs back-black-60 h-100 w-100 flex-col-8 pad-21 h-100">
        @isset($post['name'])
            <span class="font-md color-prime">{{ $post['name'] }}</span>
        @endisset

        @isset($post['description'])
            <span class="font-sm color-prime">{{ $post['description'] }}</span>
        @endisset

        <span class="flex-row-8">
            <span class="font-xs color-second flex-grow">{{ date('d.m.Y H:i', strtotime($post['publishedAt'])) }}</span>
            <span class="font-sm color-second">подробнее »</span>
        </span>
    </span>

</a>
