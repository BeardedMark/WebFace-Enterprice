@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <div class="row g-4">
            <div class="col-12 col-md-7">
                <div class="flex-col-34">
                    <div class="flex-col-13">
                        <div class="flex-col-5 pad-x-5">
                            <h1 class="font-xxl font-bold">Корзина</h1>
                            <p class="font-lg">Список товаров готовых к заказу</p>
                        </div>
                    </div>

                    <div class="flex-col-13">
                        <div class="flex-col-5" id="cucold">
                            <div id="empty-basket-message" class="pad-x-5" style="display: none;">
                                <p class="color-second">Корзина пуста</p>
                                <a href="{{ route('catalogs.index') }}" class="button-second">Перейти в каталог</a>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');
                            const container = document.getElementById('cucold');
                            const emptyMessage = document.getElementById('empty-basket-message');

                            if (!localBasket.length) {
                                emptyMessage.style.display = 'block';
                                return;
                            }

                            // Создаем прелоадеры под количество товаров
                            container.innerHTML = '';
                            localBasket.forEach((item, index) => {
                                container.innerHTML += `
                                    ${index > 0 ? '<div class="cut"></div>' : ''}
                                    <div class="flex-row-13 ai-center product-card-loading" id="preloader-${index}" style="padding: 20px; min-height: 100px; align-items: center; justify-content: center;">
                                        <div class="preloader-spinner-small"></div>
                                    </div>
                                `;
                            });

                            fetch('{{ route("basket.items") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ items: localBasket })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    container.innerHTML = data.html || '';
                                    if (!container.innerHTML.trim()) {
                                        emptyMessage.style.display = 'block';
                                    } else {
                                        setTimeout(() => {
                                            if (typeof window.getProductCardsActions === 'function') {
                                                window.getProductCardsActions();
                                            }
                                            if (typeof window.updateBasketTotal === 'function') {
                                                window.updateBasketTotal();
                                            }
                                        }, 200);
                                    }
                                } else {
                                    emptyMessage.style.display = 'block';
                                }
                            })
                            .catch(err => {
                                console.error('Ошибка загрузки корзины:', err);
                                emptyMessage.style.display = 'block';
                            });
                        });
                    </script>

                    <style>
                        .preloader-spinner-small {
                            width: 24px;
                            height: 24px;
                            border: 3px solid var(--color-other, #e5e5e5);
                            border-top-color: var(--color-brand, #007bff);
                            border-radius: 50%;
                            animation: spin 0.8s linear infinite;
                        }

                        @keyframes spin {
                            to {
                                transform: rotate(360deg);
                            }
                        }

                        .product-card-loading {
                            opacity: 0.6;
                        }
                    </style>

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
                <div class="flex-col-21" data-delivery-summ="{{ config('enterprice.deliverySumm', 10000) }}">

                    <div class="flex-col font-end pad-x-5">
                        <p class="font-sm color-second font-end">Сумма отложенных товаров: <span class="postponed-total">0</span> ₽</p>
                        <p class="font-sm color-warning font-end basket-delivery-info" style="display: none;">
                            До бесплатной доставки: <span class="delivery-remaining"></span> ₽
                        </p>
                        <p class="font-sm color-success font-end basket-delivery-free" style="display: none;">
                            Доступна бесплатная доставка!
                        </p>
                        <p class="font-lg font-end">Итого:
                            <span class="font-bold basket-total">0 ₽</span>
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
