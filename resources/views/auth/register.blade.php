@extends('layouts.container')

@section('container-content')
    <section class="flex-col-21">

        <div class="row g-4 jc-center">
            <div class="col-12 col-md-7 order-2 order-md-1">
                <div class="flex-col-34">
                    <div class="flex-col-5 pad-x-5">
                        <h1 class="font-xxl font-bold">Регистрация профиля</h1>
                        <p class="font-lg">Авторизация на сайте для доступа своему профилю</p>
                    </div>

                    <form class="flex-col-21" action="{{ route('auth.login') }}" method="POST">
                        @csrf



                <div class="flex-col-8">

                    <div class="flex-col">
                        <label class="pad-x-5" for="name">Логин <span class="color-danger">*</span></label>
                        <input class="input" type="text" name="name" id="name" value="{{ old('name') }}"
                            required>
                        <p class="pad-x-5 font-xs color-second">Будет использоваться для входа на сайт и 1С</p>
                    </div>

                    <div class="flex-col">
                        <label class="pad-x-5" for="email">Email <span class="color-danger">*</span></label>
                        <input class="input" type="text" name="email" id="email" value="{{ old('email') }}"
                            required>
                        <p class="pad-x-5 font-xs color-second">Электронная почта для деловой коммуникации и обмена файлами</p>
                    </div>

                    <div class="flex-col">
                        <label class="pad-x-5" for="phone">Телефон <span class="color-danger">*</span></label>
                        <input class="input" type="number" name="phone" id="phone" value="{{ old('phone') }}"
                            required>
                        <p class="pad-x-5 font-xs color-second">Быстрый способ связи для оперативной коммуникации</p>
                    </div>

                    <div class="flex-col">
                        <label class="pad-x-5" for="inn">ИНН организации <span class="color-danger">*</span></label>
                        <input class="input" type="text" name="inn" id="inn" value="{{ old('inn') }}"
                            required>
                        <p class="pad-x-5 font-xs color-second">Для определения вашей организации и создания карточки</p>
                    </div>

                    <div class="flex-col">
                        <label class="pad-x-5" for="password">Пароль <span class="color-danger">*</span></label>
                        <input class="input" type="password" name="password" id="password" value="{{ old('password') }}">
                        <p class="pad-x-5 font-xs color-second">Минимум 6 символов. Должен содержать символ, цифру,
                            заглавную и прописную букву</p>
                    </div>

                    <div class="flex-col">
                        <label class="pad-x-5" for="password_confirmation">Подтверждение пароля <span class="color-danger">*</span></label>
                        <input class="input" type="password" name="password_confirmation" id="password_confirmation"
                            value="{{ old('password_confirmation') }}">
                        <p class="pad-x-5 font-xs color-second">Повторите пароль введеный в предыдущем окне</p>
                    </div>
                </div>

                <div class="flex-row-5 jc-end">
                    <a class="button-other">Политика конфедициальности</a>
                    <a class="button-second" href="{{ route('auth.login') }}">Вход</a>
                    <button class="button-main" type="submit">Зарегестрироваться</button>
                </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-4 order-1 order-md-2 offset-md-1">
                <div class="flex-col jc-center ai-center">
                    <img width="128" height="128"
                        src="https://img.icons8.com/fluency-systems-regular/128/handshake-heart.png"
                        alt="handshake-heart" />
                </div>
            </div>
        </div>
    </section>
@endsection
