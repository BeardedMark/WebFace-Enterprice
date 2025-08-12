@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <div class="flex-col-5 pad-x-5">
            <h1 class="font-xxl font-bold">Сравнение предложений</h1>
            <p class="font-lg">Всего из {{ count($offers) }}</p>
        </div>

        <div class="flex-col-5 pad-x-5">
            <p class="font-sm color-second font-end">Всего записей {{ count($offers) }}</p>
            @foreach ($offers as $offer)
                @component('db.offers.frames.line', compact('offer'))
                @endcomponent
            @endforeach
        </div>
    </section>
@endsection
