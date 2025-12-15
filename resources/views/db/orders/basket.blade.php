@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <div class="row g-4">
            <div class="col-12 col-md-7">
                <div class="flex-col-34">
                    <div class="flex-col-13">
                        <div class="flex-col-5 pad-x-5">
                            <h1 class="font-xxl font-bold">Корзина ({{ count($basket) }})</h1>
                            <p class="font-lg">Список товаров готовых к заказу</p>
                        </div>
                    </div>

                    <div class="flex-col-13">
                        <div class="flex-col-5" id="cucold">
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');
                            const container = document.getElementById('cucold');

                            localBasket.forEach(item => {
                                const guid = encodeURIComponent(item.guid);
                                const quantity = encodeURIComponent(item.quantity);

                                // container.innerHTML += `<p>${quantity} ${guid}</p>`; // добавляем полученный компонент

                                fetch('/basket/offerbyorder?guid=' + guid)
                                    .then(res => res.text()) // если сервер возвращает HTML
                                    .then(html => {
                                        container.innerHTML += html; // добавляем полученный компонент
                                    })
                                    .catch(err => console.error('Ошибка запроса:', err));
                            });
                        });
                    </script>

                    {{-- @if (count($basket) > 0)
                        <div class="flex-col-13">
                            <div class="flex-col-5">
                                @foreach ($basket as $key => $item)
                                    @component('db.orders.frames.offerbyorder', compact('key', 'item'))
                                    @endcomponent
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="font-md color-second">
                            <a href="{{ route('catalogs.index') }}" class="button-second">Наполнить корзину из каталога</a>
                        </p>
                    @endif --}}

                    {{-- @if (count($postponed) > 0)
                        <div class="flex-col-13">
                            <div class="flex-col-5 pad-x-5">
                                <h2 class="font-xl font-bold">Отложенные товары ({{ count($postponed) }})</h2>
                                <p class="font-md">Список товаров готовых к заказу</p>
                            </div>

                            <div class="flex-col-5">
                                @foreach ($postponed as $key => $item)
                                    @component('db.orders.frames.offerbyorder', compact('key', 'item'))
                                    @endcomponent
                                @endforeach
                            </div>
                        </div>
                    @endif --}}
                </div>
            </div>

            <div class="col-12 col-md-4 offset-md-1">
                <div class="flex-col-21">

                    <div class="flex-col font-end pad-x-5">
                        <p class="font-sm color-second font-end">Сумма отложенных товаров: {{ $postponedSumm }} ₽</p>
                        @if ($basketSumm < config('enterprice.deliverySumm'))
                            <p class="font-sm color-warning font-end">До бесплатной доставки:
                                <x-number :value="config('enterprice.deliverySumm') - $basketSumm" /> ₽
                            </p>
                        @else
                            <p class="font-sm color-success font-end">Доступна бесплатная доставка!</p>
                        @endif
                        <p class="font-lg font-end">Итого:
                            <span class="font-bold"><x-number :value="$basketSumm" /> ₽</span>
                        </p>
                    </div>

                    @empty(session('user'))
                        <p class="flex-col bord-rad-5 pad-13 bord-danger">
                            <span class="color-danger">Товары в корзине хранятся временно </span>
                            {{-- <span class="color-second">Оформите заказ своей корзины ниже</span> --}}
                            <span class="color-second font-sm">Для сохранения корзины
                                <a class="link" href="{{ route('auth.login') }}">Войдите</a> или
                                <a class="link" href="{{ route('auth.register') }}">Зарегестрируйтесь</a>
                            </span>
                        </p>
                    @endempty

                    <div class="flex-row-5 jc-end">
                        {{-- @if (count($basket) > 0) --}}
                            {{-- <form action="{{ route('basket.clear') }}" method="POST" class="flex-row-5 jc-end">
                                @csrf
                                @method('DELETE')
                                <button class="button-other" type="submit">Очистить</button>
                            </form> --}}

                            <a href="{{ route('orders.create') }}" class="button-brand">Оформление заказа</a>
                        {{-- @else --}}
                            {{-- <a href="{{ route('catalogs.index') }}" class="button-second">Подбор из каталога</a> --}}
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-code :code="compact('basket', 'postponed')" />
@endsection
