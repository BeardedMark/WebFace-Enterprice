@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <form class="row g-4 jc-center" action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="col-12 col-md-7 order-2 order-md-1">
                <div class="flex-col-34">
                    <div class="flex-col-5 pad-x-5">
                        <h1 class="font-xxl font-bold">Оформление заказа</h1>
                        <p class="font-lg">Отправка заказа на обработку</p>
                    </div>

                    <div class="flex-col-13">
                        @isset($contractors)
                            <div class="flex-col">
                                <label class="pad-x-5" for="guidContractor">Выберите контрагента<span
                                        class="color-danger">*</span></label>
                                <select class="input" name="guidContractor" id="guidContractor" required>
                                    <option value=""></option>
                                    @foreach ($contractors as $contractor)
                                        <option value="{{ $contractor['guid'] }}">{{ $contractor['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endisset

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
                                    autocomplete="street-address">
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
                </div>
            </div>

            <div class="col-12 col-md-4 order-1 order-md-2 offset-md-1">
                <div class="flex-col-21">



                    <div class="flex-row-5 jc-end">
                        <a class="button-other">Условия доставки</a>
                        <button class="button-main" type="submit">Оформить заказ</button>
                    </div>
                </div>

            </div>
        </form>
    </section>

    <script>
        const radioButtons = document.querySelectorAll('input[name="deliveryType"]');
        const deliveryFields = document.getElementById('delivery-fields');

        function toggleFields() {
            const selected = document.querySelector('input[name="deliveryType"]:checked').value;
            deliveryFields.style.display = selected === 'delivery' ? 'flex' : 'none';
        }

        radioButtons.forEach(radio => {
            radio.addEventListener('change', toggleFields);
        });

        // запускаем при загрузке
        toggleFields();
    </script>
@endsection
