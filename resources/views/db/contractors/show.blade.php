@extends('auth.layouts.sidebar')

@section('sidebar-content')
    <div class="flex-col-34">
        <div class="flex-col-21">
            <div class="flex-col-5 pad-x-5">
                <h1 class="font-xxl font-bold">{{ $contractor['name'] }}</h1>
                <p class="font-lg">Карточка контрагента</p>
            </div>

            <div class="row">
                <div class="col-auto">
                    <p class="flex-col pad-x-5 font-sm">
                        <span><span class="color-second">КОД:</span> {{ $contractor['code'] }}</span>
                        <span><span class="color-second">ИНН:</span> {{ $contractor['inn'] }}</span>
                        <span><span class="color-second">КПП:</span> {{ $contractor['kpp'] }}</span>
                        <span><span class="color-second">ОГРН(ИП):</span> {{ $contractor['ogrn'] }}</span>
                    </p>
                </div>

                <div class="col">
                    <p class="flex-col-5 pad-x-5 font-sm font-end">
                        @foreach ($contractor['contacts'] as $contact)
                            <span class="flex-col">
                                <span class="color-second">{{ $contact['name'] }}:</span>
                                {{ $contact['value'] }}
                            </span>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        @isset($contractor['manager'])
            <div class="flex-col-5 pad-x-5">
                <h2 class="font-xl font-bold">Персональный менеджер</h2>
                <p class="font-lg">{{ $contractor['manager']['name'] }}</p>
                <p class="flex-col-5 font-sm">
                    @foreach ($contractor['manager']['contacts'] as $contact)
                        <span class="flex-col">
                            {{ $contact['value'] }}
                        </span>
                    @endforeach
                </p>
            </div>
        @endisset


        <div class="flex-col-21">
            <div class="flex-col-5 pad-x-5">
                <h2 class="font-xl font-bold">История заказов</h2>
                <p class="font-md">Список последних заказов контрагента</p>
            </div>

            <div class="flex-col-5 pad-x-5">
                @foreach ($orders as $order)
                    <div class="cut"></div>
                    <p class="row ai-center">
                        <a class="link col-4" href="{{ route('orders.show', $order['guid']) }}">
                            № {{ $order['number'] }}</a>
                        <span class="col-4 font-sm color-second">
                            {{ $order['status'] }}</span>
                        <span class="col-2 font-sm font-end color-second">
                            <x-number :value="$order['itemsCount']" /> тов.</span>
                        <span class="col-2 font-sm font-end">
                            <x-number :value="$order['amount']" /> ₽</span>
                    </p>
                @endforeach
            </div>
        </div>

        <div class="flex-col-21">
            <div class="flex-col-5 pad-x-5">
                <h2 class="font-xl font-bold">Цены предложений</h2>
                <p class="font-md">Список последних заказов контрагента</p>
            </div>

            <div class="flex-col-5 pad-x-5">
                @foreach ($prices as $price)
                    <div class="cut"></div>
                    <div class="row ai-center">
                        <a class="link col-4 flex-col"
                            href="{{ route('offers.show', $price['offer']['guid']) }}">
                            {{ $price['offer']['name'] }}
                            <span
                                class="font-sm color-second">{{ isset($price['variant']) ? $price['variant']['name'] : '' }}</span>
                        </a>

                        <div class="col-2">
                            @if ($price['order'])
                                <a class="link font-sm" href="{{ route('orders.show', $price['order']['guid']) }}">
                                    {{ $price['lastSale']['date'] }}</a>
                            @else
                                <span class="font-sm color-second">{{ $price['lastSale']['date'] }}</span>
                            @endif
                        </div>

                        <span class="col-2 font-sm font-end color-second">
                            <x-number :value="$price['salesCount']" /> пок</span>
                        <span class="col-2 font-sm font-end color-second">
                            <x-number :value="$price['totalCount']" /> {{ $price['unit'] }}</span>


                        <span class="col-2 font-sm font-end">
                            <x-number :value="$price['lastSale']['personalPrice']" /> ₽</span>
                    </div>
                @endforeach
            </div>
        </div>

        <x-code :code="compact('contractor', 'orders', 'prices')" />
    </div>
@endsection
