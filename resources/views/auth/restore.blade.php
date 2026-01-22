@extends('layouts.container')

@section('container-content')
    <section class="flex-col-21">

        <div class="row g-4 jc-center">
            <div class="col col-12 col-lg-4 order-2 order-lg-1">
                <div class="flex-col-21">
                    <x-header tag='h1' size='xxl' title="Восстановление доступа к профилю"
                        description="Заполните заявку на восстановление доступа к вашему профилю"
                        note="После отправки мы свяжемся с вами для подтверждения действий и смены пароля"/>

                    <div class="flex-row-5 pad-x-8">
                        <a class="button-second" href="{{ route('auth.login') }}">Вход</a>
                        <a class="button-other" href="{{ route('auth.register') }}">Регистрация</a>
                    </div>
                </div>
            </div>

            <div class="col order-1 order-lg-2 offset-lg-1">
                    <form class="flex-col-21 pad-x-8" action="{{ route('auth.restore') }}" method="POST">
                        @csrf

                        <div class="flex-col-8">
                            <div class="flex-col">
                                <label class="pad-x-5" for="login">Имя пользователя
                                    <span class="color-danger">*</span></label>
                                <input class="input" type="text" name="name" id="login"
                                    value="{{ old('login') }}" placeholder="Персональный логин для входа в систему"
                                    required>
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="email">Email <span class="color-danger">*</span></label>
                                <input class="input" type="text" name="email" id="email"
                                    value="{{ old('email') }}"
                                    placeholder="Электронная почта для деловой коммуникации и обмена файлами" required>
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="phone">Телефон <span class="color-danger">*</span></label>
                                <input class="input" type="number" name="phone" id="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="Быстрый способ связи для оперативной коммуникации" required>
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="password">Новый желаемый пароль
                                    <span class="color-danger">*</span></label>
                                <input class="input" type="password" name="password" id="password"
                                    value="{{ old('password') }}"
                                    placeholder="Обычно имеет от 6 символов, содержит буквы в нижнем и верхнем регистре, числа и символы"
                                    required>
                            </div>


                            <div class="flex-col-5">
                                <label class="pad-x-5" for="message">Сообщение</label>
                                <textarea class="input" name="message" id="message" rows="3">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <div class="flex-row-5 jc-end">
                            <span class="ai-center flex-grow pad-x-5 font-sm"><x-antibot /></span>
                            <button class="button-main" type="submit">Восстановить</button>
                        </div>
                    </form>
            </div>
        </div>
    </section>
@endsection
