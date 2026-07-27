@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <div class="row g-4">
            <div class="col-12 col-md-7">
                <div class="flex-col-34">
                    <x-header tag='h1' size='xxl' color='brand' title="Корзина"
                        description="Список товаров готовых к заказу" />

                    <div class="flex-col-13">
                        <div class="flex-col-5" id="pre-order-offers">
                            <div id="empty-basket-message" class="flex-col-13 pad-x-5" style="display: none;">
                                <p class="color-second pad-x-8">Корзина пуста</p>
                                <a class="item-second" href="{{ route('catalogs.index') }}">Перейти в каталог</a>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');
                            const container = document.getElementById('pre-order-offers');
                            const emptyMessage = document.getElementById('empty-basket-message');

                            if (!localBasket.length) {
                                emptyMessage.style.display = 'block';
                                return;
                            }

                            fetch('{{ route('offers.items') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        items: localBasket
                                    })
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

                        document.addEventListener('DOMContentLoaded', () => {
                            const clearBtn = document.getElementById('clear-basket-btn');
                            if (clearBtn) {
                                clearBtn.addEventListener('click', () => {
                                    localStorage.setItem('basket', '[]');
                                    window.location.reload();
                                });
                            }
                        });
                    </script>
                </div>
            </div>

            <div class="col-12 col-md-4 offset-md-1">
                <div class="flex-col-21" data-delivery-summ="{{ config('enterprice.deliverySumm', 10000) }}">

                    <div class="flex-col font-end pad-x-5">
                        <p class="font-sm color-second font-end">Сумма отложенных товаров: <span
                                class="postponed-total">0</span> ₽</p>
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

                    <div class="flex-row-5 jc-end gap-2">
                        <button type="button" class="item-other" id="clear-basket-btn" title="Очистить корзину">Очистить
                            корзину</button>
                        <a href="{{ route('orders.create') }}" class="button-brand">Оформление заказа</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
