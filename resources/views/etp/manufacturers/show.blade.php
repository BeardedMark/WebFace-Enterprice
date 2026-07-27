@extends('layouts.container')
@section('title', $meta['title'])
@section('description', $meta['description'])
@section('canonical', $meta['canonical'])

@section('container-content')
    <x-code :code="compact('breadcrumbs', 'manufacturer', 'brands', 'offers')" />

    <section class="row g-4">
        <div class="col">
            <div class="flex-col-21">
                <x-breadcrumbs :items="$breadcrumbs" />
                <x-header tag='h1' size='xxl' color='brand' :title="$meta['title']" :description="$meta['description']" />
            </div>
        </div>

        @if ($manufacturer['logoGuid'])
            <div class="col col-4 offset-1">
                <div class="bord-rad-13 img-contain">
                    <img width="auto" height="auto"
                        src="{{ route('images.proxy', ['type' => 'file', 'guid' => $manufacturer['logoGuid']]) }}"
                        alt="{{ $manufacturer['logoGuid'] }}" />
                </div>
            </div>
        @endif
    </section>

    @if (count($brands) > 0)
        <section class="flex-col-21">
            <x-header tag='h2' size='xl' color='brand' title="Бренды производителя ({{ count($brands) }})" />
            @component('etp.brands.frames.grid', compact('brands'))
            @endcomponent
        </section>
    @endif

    @if (count($offers) > 0)
        <section class="flex-col-21">
            <x-header tag='h2' size='xl' color='brand' title="Товары производителя ({{ count($offers) }})" />
            @component('etp.offers.frames.grid', compact('offers'))
            @endcomponent
        </section>
    @endif

    @if ($manufacturer['content'])
        <section class="html pad-x-13">
            {!! $manufacturer['content'] !!}
        </section>
    @endif
@endsection
