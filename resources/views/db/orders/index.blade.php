@extends('auth.layouts.sidebar')

@section('sidebar-content')
    <div class="flex-col-34">
        <div class="flex-col-21">
            <div class="flex-col-5 pad-x-5">
                <h1 class="font-xxl font-bold">Вся история заказов</h1>
                <p class="font-lg">Список заказов покупателя по доступным контрагентам</p>
                <p class="font-md">Заказов на странице: {{ count($orders) }}</p>
            </div>
        </div>

        <div class="flex-col-5 pad-x-5">
            <p class="row g-1 ai-center font-sm color-second">
                <span class="col-2">Номер</span>
                <span class="col">Статус</span>
                <span class="col">Контрагент</span>
                <span class="col-1 font-end">Товаров</span>
                <span class="col-2 font-end">Сумма</span>
            </p>

            @foreach ($orders as $order)
                <div class="cut"></div>

                <p class="row g-1 ai-center">
                    <a class="col-2 link" href="{{ route('orders.show', $order['guid']) }}">
                        {{ $order['number'] }}</a>
                    <span class="col font-sm color-second">
                        {{ $order['status'] }}</span>

                    @isset($order['contractor'])
                        <a class="col link font-sm" href="{{ route('contractors.show', $order['contractor']['guid']) }}">
                            {{ $order['contractor']['name'] }}</a>
                    @endisset

                    <span class="col-1 font-sm font-end color-second">
                        {{ $order['itemsCount'] }} тов.</span>
                    <span class="col-2 font-sm font-end">
                        {{ $order['amount'] }} ₽</span>
                </p>
            @endforeach
        </div>

        <x-code :code="compact('contractors', 'orders')" />
    </div>
@endsection
