@extends('layouts.container')
@section('title', $meta['seo']['title'])
@section('description', $meta['seo']['description'])
@section('canonical', $meta['seo']['canonical'])

@section('container-content')
    <x-code :code="compact('page', 'meta')" />

    <section class="row g-4">
        <div class="col">
            <div class="flex-col-34">

                <x-header tag='h1' size='xxl' color='brand' :title="$meta['title']" :description="$meta['description']" />

                <div class="flex-col-21">
                    <p class="flex-col-5 pad-x-13">
                        @isset($baseData['email'])
                            <span class="font-lg">{{ $baseData['email'] }}</span>
                        @endisset

                        @isset($baseData['phone'])
                            <span class="font-lg">{{ $baseData['phone'] }}</span>
                        @endisset
                    </p>

                    <p class="flex-col pad-x-13">
                        @isset($baseData['address'])
                            <span class="font-sm">{{ $baseData['address'] }}</span>
                        @endisset
                    </p>


                    <div class="flex-row-5 d-print-none pad-x-8">
                        @foreach ($baseData['links'] as $link)
                            <x-linkicon href="{{ $link['url'] }}">{{ $link['title'] }}</x-linkicon>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col col-4 col-md-6 offset-md-1">
            <div class="flex-col-34 ai-center jc-center">
                <img class="bord-rad-13 back-light shadow-real"
                    src="{{ route('images.qrcode', [
                        'data' => $baseData,
                    ]) }}">

                <p class="flex-col font-center d-print-none">
                    <span class="font-lg">Добавить в контакты</span>
                    <span class="font-sm color-second">Отсканируйте код с помощью телефона</span>
                </p>
            </div>
        </div>
    </section>

    <div id="message" class="cut"></div>

    @isset($page)
        @foreach ($page['sections'] as $section)
            @component('components.sections.' . ($section['template'] ?? 'default'), compact('section'))
            @endcomponent

            @unless ($loop->last)
                <div class="cut"></div>
            @endunless
        @endforeach
    @endisset

    @isset($page['content'])
        <section class="html pad-x-13">
            {!! $page['content'] !!}
        </section>
    @endisset
@endsection
