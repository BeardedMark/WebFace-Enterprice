@extends('layouts.container')
@section('title', 'Список брендов')
@section('description', 'Список брендов наших производителей')
@section('canonical', route('brands.index'))

@section('container-content')
    <x-code :code="compact('brands')" />

    <section class="flex-col-21">
        <x-breadcrumbs :items="$breadcrumbs" />

        <x-header tag='h1' size='xxl' color='brand' title="Бренды товаров"
            description="Марки наших производителей"
            note="{{ count($brands) > 0 ? count($brands) . ' брендов' : '' }}" />
    </section>

    @if (count($brands) > 0)
        <section class="row g-2">
            @foreach ($brands as $brand)
                <div class="col-12 col-md-6 col-lg-3">
                    @component('etp.brands.frames.card', ['brand' => $brand])
                    @endcomponent
                </div>
            @endforeach
        </section>
    @endif

@endsection
