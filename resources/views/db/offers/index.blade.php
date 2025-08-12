@extends('layouts.container')

@section('container-content')
    <section class="flex-col-21">
        <div class="flex-col-5">
            <h1 class="font-xxl font-bold">Номенклатура</h1>
            <p class="font-lg">Всего записей {{ count($offers) }}</p>
        </div>

        <div class="flex-col-5 pad-x-5">
            <p class="font-sm color-second font-end">Всего записей {{ count($offers) }}</p>
            @foreach ($offers as $offer)
                <div class="cut"></div>
                <p class="flex-row-8 ai-center">
                    <a class="link" href="{{ route('offers.show', $offer['guid']) }}">
                        {{ $offer['name'] }}</a>
                    <span class="font-sm color-second flex-grow">арт: {{ $offer['article'] ?? '-' }}</span>

                    <span>{{ $offer['countVariations'] }}</span>
                </p>
            @endforeach
        </div>
    </section>
@endsection
