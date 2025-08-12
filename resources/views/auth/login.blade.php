@extends('layouts.container')

@section('container-content')
    <section class="flex-col-21">

        <div class="row g-4 jc-center">
            <div class="col-12 col-md-7 order-2 order-md-1">
                <div class="flex-col-34">
                    <div class="flex-col-5 pad-x-5">
                        <h1 class="font-xxl font-bold">Вход в профиль</h1>
                        <p class="font-lg">Авторизация на сайте для доступа к своим организациям</p>
                    </div>

                    <form class="flex-col-21" action="{{ route('auth.login') }}" method="POST">
                        @csrf

                        <div class="flex-col-8">
                            <div class="flex-col">
                                <label class="pad-x-5" for="login">Имя пользователя
                                    <span class="color-danger">*</span></label>
                                <input class="input" type="text" name="login" id="login"
                                    value="{{ old('login') }}" required>
                                <p class="pad-x-5 font-xs color-second">Персональный логин для входа в систему</p>
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="password">Пароль пользователя
                                    <span class="color-danger">*</span></label>
                                <input class="input" type="password" name="password" id="password"
                                    value="{{ old('password') }}">
                                <p class="pad-x-5 font-xs color-second">Обычно имеет от 6 символов, содержит буквы в нижнем
                                    и верхнем регистре, числа и символы</p>
                            </div>
                        </div>

                        <div class="flex-row-5 jc-end">
                            <a class="button-other">Восстановить данные</a>
                            <a class="button-second" href="{{ route('auth.register') }}">Регистрация</a>
                            <button class="button-main" type="submit">Войти</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-4 order-1 order-md-2 offset-md-1">
                <div class="flex-col jc-center ai-center">
                    <img width="128" height="128" src="https://img.icons8.com/fluency-systems-regular/128/enter-2.png"
                        alt="enter-2" />
                </div>
            </div>
        </div>
    </section>
@endsection
