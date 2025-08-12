@extends('auth.layouts.sidebar')

@section('sidebar-content')
    <div class="flex-col-34">
        <div class="flex-col-5 pad-x-5">
            <h1 class="font-xxl font-bold">Заказ покупателя №{{ $order['number'] }}</h1>
            <p class="font-lg">Дата заказа {{ $order['date'] }}</p>
        </div>

        <div class="flex-col-5 pad-x-5">
            <p class="font-sm color-second font-end">Всего: {{ count($order['items']) }}</p>

            @foreach ($order['items'] as $offer)
                <div class="cut"></div>

                <p class="flex-row-8 ai-center">
                    <a class="link flex-col flex-grow"
                        href="{{ route('offers.show', $offer['offer']['guid']) }}{{ isset($offer['variant']) ? '#' . $offer['variant']['guid'] : '' }}">
                        {{ $offer['offer']['name'] }}
                        <span
                            class="font-sm color-second">{{ isset($offer['variant']) ? $offer['variant']['name'] : '' }}</span>
                    </a>
                    <span class="font-sm color-second flex-grow">{{ $offer['count'] }} ед</span>
                    <span class="font-sm color-second flex-grow">{{ $offer['price'] }} ₽</span>
                    <span class="font-sm">{{ $offer['summ'] }} ₽</span>
                </p>
            @endforeach
        </div>

        <x-code :code="compact('order')" />
    </div>
@endsection
