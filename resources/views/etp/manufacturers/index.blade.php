@extends('layouts.container')
@section('title', 'Список производителей')
@section('description', 'Список производителей наших товаров')
@section('canonical', route('manufacturers.index'))

@section('container-content')
    <x-code :code="compact('manufacturers')" />

    <section class="flex-col-21">
        {{-- <x-breadcrumbs :items="$breadcrumbs" /> --}}

        <x-header tag='h1' size='xxl' color='brand' title="Производители"
            description="Список поставщиков наших товаров"
            note="{{ count($manufacturers) > 0 ? count($manufacturers) . ' производителей' : '' }}" />
    </section>

    @if (count($manufacturers) > 0)
        <section class="row g-2">
            @foreach ($manufacturers as $manufacturer)
                <div class="col-12 col-md-6 col-lg-3">
                    @component('etp.manufacturers.frames.card', ['manufacturer' => $manufacturer])
                    @endcomponent
                </div>
            @endforeach
        </section>
    @endif

@endsection
