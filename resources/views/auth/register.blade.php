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

                    <form class="flex-col-21" action="{{ route('auth.register') }}" method="POST">
                        @csrf

                        <div class="flex-col-8">
                            <div class="flex-col">
                                <label class="pad-x-5" for="name">Логин <span class="color-danger">*</span></label>
                                <input class="input" type="text" name="name" id="name"
                                    value="{{ old('name') }}" placeholder="Будет использоваться для входа" required>
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="password">Пароль <span class="color-danger">*</span></label>
                                <input class="input" type="password" name="password" id="password"
                                    value="{{ old('password') }}" placeholder="Минимум 6 символов. Должен содержать символ, цифру, заглавную и прописную букву">
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="password_confirmation">Подтверждение пароля <span
                                        class="color-danger">*</span></label>
                                <input class="input" type="password" name="password_confirmation"
                                    id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Повторный ввод пароля для подтверждения">
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="email">Email <span class="color-danger">*</span></label>
                                <input class="input" type="text" name="email" id="email"
                                    value="{{ old('email') }}" placeholder="Электронная почта для деловой коммуникации и обмена файлами" required>
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="phone">Телефон <span class="color-danger">*</span></label>
                                <input class="input" type="number" name="phone" id="phone"
                                    value="{{ old('phone') }}" placeholder="Быстрый способ связи для оперативной коммуникации" required>
                            </div>

                            <div class="flex-col">
                                <label class="pad-x-5" for="inn">ИНН организации <span
                                        class="color-danger">*</span></label>
                                <input class="input" type="text" name="inn" id="inn"
                                    value="{{ old('inn') }}" placeholder="Для определения вашей организации и создания карточки" required>
                            </div>
                        </div>

                        <div class="flex-row-5 jc-end">
                            <a class="button-other" href="{{ route('pages.privacy') }}">Политика конфедициальности</a>
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
