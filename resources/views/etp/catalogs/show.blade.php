@extends('layouts.container')
@section('title', $meta['title'])
@section('description', $meta['description'])
@section('canonical', $meta['canonical'])

@section('container-content')
    <section class="flex-row-8 pad-e-8">
        <div class="flex-col-21 flex-grow">
            <x-breadcrumbs :items="$breadcrumbs" />
            <x-header tag='h1' size='xxl' color='brand' :title="$catalog['name']" :description="$catalog['description']" />
        </div>

        <div class="flex-row-5">
            <x-code :code="compact('catalog', 'catalogs', 'offers')" />
            <x-share />

            <button onclick="openModal('more')" data-tooltip="Еще" class="icon">
                <img width="20" height="20"
                    src="https://img.icons8.com/fluency-systems-regular/20/more.png" alt="more" />
            </button>
        </div>
    </section>

    @if (count($catalogs) > 0)
        @component('etp.catalogs.frames.grid', compact('catalogs'))
        @endcomponent
    @endif

    @if (count($offers) > 0)
        @component('etp.offers.frames.grid', compact('offers'))
        @endcomponent
    @endif

    @isset ($catalog['content'])
        <section class="flex-col-21">
            <div class="html pad-x-13">
                {!! $catalog['content'] !!}
            </div>
        </section>
    @endisset

    <x-modal name="more" title="Дополнительные дейтвия">
        <div class="flex-col-5">
            <a class="item-other" title="Открыть запись по внешней ссылке" href="{{ config('enterprice.base') }}#{{ $catalog['link'] }}">Открыть запись в
                1С:Предприятие</a>

            <div class="flex-row-5">
                <input type="text" class="input flex-grow" title="Внутренняя ссылка 1С" readonly value="{{ $catalog['link'] }}">

                <button id="copy-btn" title="Копировать ссылку" class="icon">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/copy--v1.png" alt="email--v1" />
                </button>
            </div>
        </div>
    </x-modal>
@endsection
