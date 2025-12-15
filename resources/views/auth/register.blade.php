@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">

        <div class="row g-4 jc-center">
            <div class="col col-12 col-lg-4 order-2 order-lg-1">
                <div class="flex-col-21">
                    <x-header tag='h1' size='xxl' color='brand' title="Регистрация профиля"
                        description="Авторизация на сайте для доступа своему профилю"
                        note="Заполните обязательные поля для создания персонального профиля на нашем сайте" />

                    <div class="flex-row-5 pad-x-8">
                        <a class="button-second" href="{{ route('auth.login') }}">Вход</a>
                        <a class="button-other" href="{{ route('pages.privacy') }}">Политика конфедициальности</a>
                    </div>
                </div>
            </div>

            <div class="col order-1 order-lg-2 offset-lg-1">
                <form class="flex-col-21 pad-x-8" action="{{ route('auth.register') }}" method="POST">
                    @csrf

                    <div class="flex-col-8">
                        <div class="flex-col">
                            <label class="pad-x-5" for="name">Логин <span class="color-danger">*</span></label>
                            <input class="input" type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Будет использоваться для входа" required>
                        </div>

                        <div class="flex-col">
                            <label class="pad-x-5" for="password">Пароль <span class="color-danger">*</span></label>
                            <input class="input" type="password" name="password" id="password"
                                value="{{ old('password') }}"
                                placeholder="Минимум 6 символов. Должен содержать символ, цифру, заглавную и прописную букву">
                        </div>

                        <div class="flex-col">
                            <label class="pad-x-5" for="password_confirmation">Подтверждение пароля <span
                                    class="color-danger">*</span></label>
                            <input class="input" type="password" name="password_confirmation" id="password_confirmation"
                                value="{{ old('password_confirmation') }}"
                                placeholder="Повторный ввод пароля для подтверждения">
                        </div>

                        <div class="flex-col">
                            <label class="pad-x-5" for="email">Email <span class="color-danger">*</span></label>
                            <input class="input" type="text" name="email" id="email" value="{{ old('email') }}"
                                placeholder="Электронная почта для деловой коммуникации и обмена файлами" required>
                        </div>

                        <div class="flex-col">
                            <label class="pad-x-5" for="phone">Телефон <span class="color-danger">*</span></label>
                            <input class="input" type="number" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="Быстрый способ связи для оперативной коммуникации" required>
                        </div>

                        <div class="flex-col">
                            <label class="pad-x-5" for="inn">ИНН организации</label>
                            <input class="input" type="text" name="inn" id="inn" value="{{ old('inn') }}"
                                placeholder="Для определения вашей организации и создания карточки">
                        </div>
                    </div>

                    <div class="flex-row-5 jc-end">
                        <span class="ai-center flex-grow pad-x-5 font-sm"><x-antibot /></span>
                        <button class="button-main" type="submit">Зарегестрироваться</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
