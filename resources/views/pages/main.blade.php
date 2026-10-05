@extends('layouts.container')
@section('title', $meta['seo']['title'])
@section('description', $meta['seo']['description'])
@section('canonical', $meta['seo']['canonical'])

@section('container-content')
    <x-code :code="compact('page')" />

    <section class="row g-4 align-items-center">
        <div class="col">
            <div class="flex-col-21">
                <x-header tag='h1' size='xxl' color='brand' :title="$meta['title']" :description="$meta['description']" />

                @isset($page['links'])
                    <div class="flex-row-5 pad-x-8">
                        @foreach ($page['links'] as $link)
                            <a class="item-{{ isset($link['template']) ? $link['template'] : 'other' }}"
                                title="{{ $link['description'] }}" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>

        <div class="col col-3 col-md-4 offset-md-1">
            <div class="flex jc-center pad-x-13">
                <img max-height="50px" src="{{ asset('storage/images/logotypes/full-logotype-ru-3.png') }}" />
            </div>
        </div>
    </section>

    @isset($page['sections'])
        @foreach ($page['sections'] as $section)
            @component('components.sections.' . ($section['template'] ?? 'default'), compact('section'))
            @endcomponent

            @unless ($loop->last)
                <div class="cut"></div>
            @endunless
        @endforeach

        @isset($page['content'])
            <section class="html pad-x-13">
                {!! $page['content'] !!}
            </section>
        @endisset
    @endisset
@endsection
