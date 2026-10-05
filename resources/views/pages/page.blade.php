@extends('layouts.container')
@section('title', $meta['seo']['title'])
@section('description', $meta['seo']['description'])
@section('canonical', $meta['seo']['canonical'])

@section('container-content')
    <x-code :code="compact('baseData', 'meta', 'page')" />

    <section class="row g-4 ai-center">
        <div class="col">
            <div class="flex-col-13">
                <x-header tag='h1' size='xxl' color='brand' :title="$meta['title']" :description="$meta['description']" :note="$page['content']" />

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

        @isset($page['image'])
            <div class="col col-4 offset-1">
                <div class="bord-rad-13 flex jc-center over-hide">
                    <img src="{{ $page['image'] }}" alt="{{ $page['image'] }}" />
                </div>
            </div>
        @endisset
    </section>

    @isset($page['sections'])
        <div class="cut"></div>

        @foreach ($page['sections'] as $section)
            @component('components.sections.' . ($section['template'] ?? 'default'), compact('section'))
            @endcomponent

            @unless ($loop->last)
                <div class="cut"></div>
            @endunless
        @endforeach
    @endisset

    {{-- @isset($page['content'])
        <div class="cut"></div>

        <section class="html pad-x-13">
            {!! $page['content'] !!}
        </section>
    @endisset --}}
@endsection
