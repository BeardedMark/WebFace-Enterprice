@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <form class="row g-4 jc-center" action="{{ route('orders.store') }}" method="POST" id="order-form">
            @csrf

            <div class="col-12 col-md-7 order-2 order-md-1">
                <div class="flex-col-34">
                    <div class="flex-col-5 pad-x-5">
                        <h1 class="font-xxl font-bold">Оформление заказа</h1>
                        <p class="font-lg">Заполните данные для оформления заказа</p>
                    </div>

                    {{-- Поля оформления заказа --}}
                    <div class="flex-col-13">
                        <div class="flex-col">
                            <label class="pad-x-5">Способ получения</label>
                            <div class="flex-row-8">
                                <label class="item-other flex-row-8 flex-grow cursor-pointer"><input type="radio"
                                        name="deliveryType" value="pickup" checked> Самовывоз</label>
                                <label class="item-other flex-row-8 flex-grow cursor-pointer"><input type="radio"
                                        name="deliveryType" value="delivery"> Доставка</label>
                            </div>
                        </div>

                        <div id="delivery-fields" class="flex-col-13">
                            <div class="flex-col">
                                <label class="pad-x-5" for="addres">Адрес доставки
                                    <span class="color-danger">*</span></label>
                                <input class="input" type="text" name="addres" id="addres"
                                    value="{{ old('addres') }}" placeholder="Город, Улица, Номер дома"
                                    autocomplete="street-address" data-required-delivery="true">
                                <p class="pad-x-5 font-xs color-second">Подробный адрес для водителя для проезда к вам</p>
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="date">Дата доставки</label>
                                <input class="input" type="date" name="date" id="date"
                                    value="{{ old('date') }}">
                                <p class="pad-x-5 font-xs color-second">Учитывайте выходные и праздничные дни при выборе
                                    даты
                                </p>
                            </div>

                            <div class="flex-row-5">
                                <div class="flex-col flex-grow">
                                    <label class="pad-x-5" for="fromTime">Время доставки С</label>
                                    <input class="input" type="time" name="fromTime" id="fromTime"
                                        value="{{ old('fromTime') }}">
                                    <p class="pad-x-5 font-xs color-second">Выберите удобное время в пределах рабочего дня
                                    </p>
                                </div>

                                <div class="flex-col flex-grow">
                                    <label class="pad-x-5" for="toTime">Время доставки ПО</label>
                                    <input class="input" type="time" name="toTime" id="toTime"
                                        value="{{ old('toTime') }}">
                                    <p class="pad-x-5 font-xs color-second">Выберите удобное время в пределах рабочего дня
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-col">
                            <label class="pad-x-5" for="commentary">Комментарий к заказу</label>
                            <textarea class="input" name="commentary" id="commentary" rows="3" placeholder="Например: позвонить заранее">{{ old('commentary') }}</textarea>
                        </div>
                    </div>

                    <div class="flex-col-13">
                        @empty($user)
                            <div class="flex-col-13">
                                <div class="flex-col">
                                    <label class="pad-x-5" for="name">Ваше имя
                                        <span class="color-danger">*</span></label>
                                    <input class="input" type="text" name="name" id="name"
                                        value="{{ old('name') }}" placeholder="Как к вам обращаться?" data-required="true">
                                </div>

                                <div class="flex-col">
                                    <label class="pad-x-5" for="phone">Ваш телефон
                                        <span class="color-danger">*</span></label>
                                    <input class="input" type="tel" name="phone" id="phone"
                                        value="{{ old('phone') }}" placeholder="Для оперативной связи" data-required="true">
                                </div>

                                <div class="flex-col">
                                    <label class="pad-x-5" for="email">Ваш email
                                        <span class="color-danger">*</span></label>
                                    <input class="input" type="email" name="email" id="email"
                                        value="{{ old('email') }}" placeholder="Для передачи документов" data-required="true">
                                </div>

                                <div class="flex-col">
                                    <label class="pad-x-5" for="inn">ИНН организации
                                        <span class="color-second font-sm">(не обязательно)</span></label>
                                    <input class="input" type="text" name="inn" id="inn"
                                        value="{{ old('inn') }}" placeholder="Для юридических взаимодействий">
                                </div>
                            </div>
                        @else
                            <div class="flex-col">
                                <label class="pad-x-5" for="guidContractor">Выберите контрагента<span
                                        class="color-danger">*</span></label>
                                <select class="input" name="guidContractor" id="guidContractor" data-required="true">
                                    <option value="">-- Выберите контрагента --</option>
                                    @foreach ($contractors as $contractor)
                                        <option value="{{ $contractor['guid'] }}" {{ old('guidContractor') == $contractor['guid'] ? 'selected' : '' }}>
                                            {{ $contractor['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endempty
                    </div>

                    <div class="flex-row-5 jc-end">
                        <span class="ai-center flex-grow pad-x-5 font-sm"><x-antibot /></span>
                        <a class="button-other" href="{{ route('basket.index') }}">Вернуться в корзину</a>
                        <button class="button-main" type="submit">Оформить заказ</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 order-1 order-md-2 offset-md-1">
                <div class="flex-col-21" data-delivery-summ="{{ config('enterprice.deliverySumm', 10000) }}">
                    {{-- Блок информации о заказе --}}
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
                </div>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('order-form');
            let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');

            // Фильтруем только товары, которые не отложены и имеют количество > 0
            const activeItems = localBasket.filter(item => !item.postponed && (item.quantity || 0) > 0);

            if (activeItems.length === 0) {
                alert('Корзина пуста. Добавьте товары перед оформлением заказа.');
                window.location.href = '{{ route("basket.index") }}';
                return;
            }

            // Добавляем скрытые поля с данными из localStorage
            activeItems.forEach((item, index) => {
                // Парсим guid для получения offerGuid и variantGuid
                const parts = item.guid.split('#');
                const offerGuid = parts[0];
                const variantGuid = parts[1] || null;
                const quantity = parseInt(item.quantity) || 0;

                // Пропускаем товары с нулевым количеством
                if (quantity <= 0) {
                    return;
                }

                // Добавляем скрытые поля в форму
                const hiddenDiv = document.createElement('div');
                hiddenDiv.innerHTML = `
                    <input type="hidden" name="items[${index}][guid]" value="${item.guid}">
                    <input type="hidden" name="items[${index}][offerGuid]" value="${offerGuid}">
                    <input type="hidden" name="items[${index}][variantGuid]" value="${variantGuid || ''}">
                    <input type="hidden" name="items[${index}][quantity]" value="${quantity}">
                `;
                form.appendChild(hiddenDiv);
            });

            // Загружаем информацию о товарах для расчета итого
            let loadedCount = 0;
            let totalSum = 0;

            // Функция для обновления итого
            const updateOrderTotal = () => {
                const totalElement = document.querySelector('.basket-total');
                if (totalElement) {
                    totalElement.textContent = new Intl.NumberFormat('ru-RU').format(totalSum.toFixed(2)) + ' ₽';
                }

                // Обновляем информацию о доставке
                const deliverySumm = parseFloat(document.querySelector('[data-delivery-summ]')?.getAttribute('data-delivery-summ')) || 10000;
                const remaining = deliverySumm - totalSum;
                const deliveryInfo = document.querySelector('.basket-delivery-info');
                const deliveryFree = document.querySelector('.basket-delivery-free');
                const deliveryRemaining = document.querySelector('.delivery-remaining');

                if (remaining > 0) {
                    if (deliveryInfo) deliveryInfo.style.display = 'block';
                    if (deliveryFree) deliveryFree.style.display = 'none';
                    if (deliveryRemaining) {
                        deliveryRemaining.textContent = new Intl.NumberFormat('ru-RU').format(remaining.toFixed(2));
                    }
                } else {
                    if (deliveryInfo) deliveryInfo.style.display = 'none';
                    if (deliveryFree) deliveryFree.style.display = 'block';
                }
            };

            // Загружаем цены товаров для расчета итого
            activeItems.forEach((item) => {
                // Пропускаем товары с нулевым количеством
                const quantity = parseInt(item.quantity) || 0;
                if (quantity <= 0) {
                    loadedCount++;
                    if (loadedCount === activeItems.length) {
                        updateOrderTotal();
                    }
                    return;
                }

                const guid = encodeURIComponent(item.guid);

                fetch('/basket/offerbyorder?guid=' + guid)
                    .then(res => res.text())
                    .then(html => {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        const productCard = tempDiv.querySelector('.product-card');

                        if (productCard) {
                            const price = parseFloat(productCard.getAttribute('data-price')) || 0;
                            totalSum += price * quantity;
                        }

                        loadedCount++;

                        // Когда все товары загружены
                        if (loadedCount === activeItems.length) {
                            updateOrderTotal();
                        }
                    })
                    .catch(err => {
                        console.error('Ошибка загрузки товара:', err);
                        loadedCount++;
                        if (loadedCount === activeItems.length) {
                            updateOrderTotal();
                        }
                    });
            });

            // Обработка формы
            const radioButtons = document.querySelectorAll('input[name="deliveryType"]');
            const deliveryFields = document.getElementById('delivery-fields');

            function toggleFields() {
                const selected = document.querySelector('input[name="deliveryType"]:checked').value;
                deliveryFields.style.display = selected === 'delivery' ? 'flex' : 'none';

                const addressInput = document.getElementById('addres');
                if (addressInput) {
                    if (selected === 'delivery') {
                        addressInput.setAttribute('data-required-delivery', 'true');
                    } else {
                        addressInput.removeAttribute('data-required-delivery');
                    }
                }
            }

            radioButtons.forEach(radio => {
                radio.addEventListener('change', toggleFields);
            });

            toggleFields();

            // Валидация формы
            const requiredInputs = form.querySelectorAll('[data-required="true"]');

            form.addEventListener('submit', function(e) {
                // Обновляем список активных товаров перед отправкой
                let currentBasket = JSON.parse(localStorage.getItem('basket') || '[]');
                let currentActiveItems = currentBasket.filter(item => !item.postponed && (item.quantity || 0) > 0);

                // Проверяем, что есть товары
                if (currentActiveItems.length === 0) {
                    e.preventDefault();
                    alert('Корзина пуста. Добавьте товары перед оформлением заказа.');
                    window.location.href = '{{ route("basket.index") }}';
                    return false;
                }

                // Обновляем скрытые поля с актуальными данными из localStorage
                // Удаляем старые скрытые поля
                form.querySelectorAll('input[type="hidden"][name^="items["]').forEach(input => input.remove());

                // Добавляем новые скрытые поля с актуальными данными
                currentActiveItems.forEach((item, index) => {
                    const parts = item.guid.split('#');
                    const offerGuid = parts[0];
                    const variantGuid = parts[1] || null;
                    const quantity = item.quantity || 1;

                    const hiddenDiv = document.createElement('div');
                    hiddenDiv.innerHTML = `
                        <input type="hidden" name="items[${index}][guid]" value="${item.guid}">
                        <input type="hidden" name="items[${index}][offerGuid]" value="${offerGuid}">
                        <input type="hidden" name="items[${index}][variantGuid]" value="${variantGuid || ''}">
                        <input type="hidden" name="items[${index}][quantity]" value="${quantity}">
                    `;
                    form.appendChild(hiddenDiv);
                });

                let isValid = true;
                let firstInvalidInput = null;

                // Проверяем обязательные поля
                requiredInputs.forEach(input => {
                    if (input.value.trim() === '') {
                        isValid = false;
                        if (!firstInvalidInput) {
                            firstInvalidInput = input;
                        }
                    }
                });

                // Проверяем адрес доставки, если выбрана доставка
                const deliveryType = document.querySelector('input[name="deliveryType"]:checked');
                if (deliveryType && deliveryType.value === 'delivery') {
                    const addressInput = document.getElementById('addres');
                    if (addressInput && addressInput.value.trim() === '') {
                        isValid = false;
                        if (!firstInvalidInput) {
                            firstInvalidInput = addressInput;
                        }
                    }
                }

                if (!isValid) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (firstInvalidInput) {
                        firstInvalidInput.focus();
                        firstInvalidInput.reportValidity();
                    }
                    return false;
                }

                // Сохраняем отложенные товары перед отправкой
                const allBasketItems = JSON.parse(localStorage.getItem('basket') || '[]');
                const postponedItems = allBasketItems.filter(item => item.postponed === true);

                // Очищаем корзину, оставляя только отложенные товары
                localStorage.setItem('basket', JSON.stringify(postponedItems));

                // Обновляем счетчик корзины в шапке
                const basketIcon = document.getElementById('basket');
                if (basketIcon) {
                    if (postponedItems.length > 0) {
                        basketIcon.setAttribute('data-notice', postponedItems.length);
                    } else {
                        basketIcon.removeAttribute('data-notice');
                    }
                }
            });
        });
    </script>
@endsection
