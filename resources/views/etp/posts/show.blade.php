@extends('layouts.container')
@section('title', $post['name'])
@section('description', $post['description'])
@section('canonical', route('posts.show', $post['guid']))

@section('container-content')
    <x-code :code="compact('breadcrumbs', 'post')" />

    {{-- <section class="flex-col-34">
        <div class="flex-col-21">
            <x-breadcrumbs :items="$breadcrumbs" />

            <x-header tag='h1' size='xxl' color='brand' title="{{ $post['name'] }}"
                description="{{ $post['description'] }}" note="Дата публикации {{ $post['publishedAt'] }}" />
        </div>
    </section> --}}

    <section class="row g-4">
        <div class="col">
            <div class="flex-col-21">
                <x-breadcrumbs :items="$breadcrumbs" />

                <x-header tag='h1' size='xxl' color='brand' title="{{ $post['name'] }}"
                    description="{{ $post['description'] }}" note="Дата публикации {{ $post['publishedAt'] }}" />
            </div>
        </div>

        @if ($post['imageUrl'])
            <div class="col col-4 offset-1">
                <a class="bord-rad-13 img-cover back-light curs-z-in" href="{{ $post['imageUrl'] }}" target="_blink">
                    <img src="{{ $post['imageUrl'] }}" alt="api" />
                </a>
            </div>
        @endif
    </section>

    @if ($post['content'])
        <section class="html pad-x-13">
            {!! $post['content'] !!}
        </section>
    @endif

    @if (count($post['links']) > 0)
        <div class="flex-row-5 pad-x-8">
            @foreach ($post['links'] as $postLink)
                <a class="item-second" href="{{ $postLink['url'] }}">{{ $postLink['name'] }}</a>
            @endforeach
        </div>
    @endif

@endsection
