@extends('layouts.container')

@section('container-content')
    <div class="row">
        <div class="col">
            <section class="flex-col-34">
                <div class="flex-col-5 pad-x-5">
                    <h1 class="font-xxl font-bold">Контакты</h1>
                    <p class="font-lg">ООО "ДНЛ Упаковка"</p>
                    <p class="font-md">При открытии страницы, данные берутся сразу из 1С. Это позволяет быстро влиять на
                        контент сайта и автоматически поддерживать актуальность информации</p>
                </div>

                <p class="flex-col">
                    <span></span>
                </p>

                <div class="flex-row-5 flex-grow">
                    <a class="button-main" href="{{ route('pages.enterprice') }}">1С Подключение</a>
                    <a class="button-second" href="{{ route('odata.dashboard') }}">Сайт проекта</a>
                </div>

            <form class="flex-col-21" action="{{ route('orders.store') }}" method="POST">

                <div class="flex-col-8">
                    {{-- <div class="flex-col">
                            <label class="pad-x-5" for="guidContractor">Выберите контрагента<span class="color-danger">*</span></label>
                            <select class="input" name="guidContractor" id="guidContractor" required>
                                <option value=""></option>
                                @foreach ($contractors as $contractor)
                                    <option value="{{ $contractor['guid'] }}">{{ $contractor['name'] }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                    <div class="flex-col">
                        <label class="pad-x-5" for="addres">Ваше имя
                            <span class="color-danger">*</span></label>
                        <input class="input" type="text" name="addres" id="addres" value="{{ old('addres') }}"
                            placeholder="Как к вам обращаться?" autocomplete="street-address">
                    </div>

                    <div class="flex-col">
                        <label class="pad-x-5" for="addres">Ваш телефон
                            <span class="color-danger">*</span></label>
                        <input class="input" type="text" name="addres" id="addres" value="{{ old('addres') }}"
                            placeholder="Для оперативной связи" autocomplete="street-address">
                    </div>

                    <div class="flex-col">
                        <label class="pad-x-5" for="addres">Ваш email
                            <span class="color-danger">*</span></label>
                        <input class="input" type="text" name="addres" id="addres" value="{{ old('addres') }}"
                            placeholder="Для оперативной связи" autocomplete="street-address">
                    </div>

                    <div class="flex-col">
                        <label class="pad-x-5" for="commentary">Сообщение</label>
                        <textarea class="input" name="commentary" id="commentary" rows="3">{{ old('commentary') }}</textarea>
                    </div>
                </div>

                <div class="flex-row-5 jc-end">
                    <a class="button-other">Условия доставки</a>
                    <button class="button-main" type="submit">Отправить</button>
                </div>
            </form>
            </section>
        </div>

        <div class="col col-4 offset-1">
            <div class="flex-col ai-center jc-center">
                <img width="128" height="128" src="https://img.icons8.com/fluency-systems-regular/128/marker--v1.png"
                    alt="marker--v1" />
            </div>
        </div>
    </div>
@endsection
