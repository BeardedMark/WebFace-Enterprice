<footer class="bord-t-other pad-y-55 d-print-none">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="flex-row-8 pad-x-5">
                    <p class="flex-col flex-grow ai-start">
                        <a class="link-second font-sm" href="{{ route('pages.main') }}">Главная</a>
                        <a class="link-second font-sm" href="{{ route('pages.about') }}">О проекте</a>
                        <a class="link-second font-sm" href="{{ route('catalogs.index') }}">Каталог</a>
                        <a class="link-second font-sm" href="{{ route('pages.contacts') }}">Контакты</a>
                    </p>

                    <p class="flex-col flex-grow ai-start">
                        <a class="link-second font-sm" href="{{ route('auth.main') }}">Личный кабинет</a>

                        @if (session('user'))
                            <a class="link-second font-sm" href="{{ route('auth.logout') }}">Выйти из профиля</a>
                        @endif

                        <a class="link-second font-sm" href="{{ route('basket.index') }}">Корзина</a>
                    </p>
                </div>
            </div>

            <div class="col col-4 offset-1">
                <div class="flex-col-8 flex-grow pad-x-13">
                    <p class="flex-col jc-end font-end">
                        @if (config('settings.contacts.title'))
                            <span class="font-md font-bold">{{ config('settings.contacts.organization') }}</span>
                        @endif

                        @if (config('settings.contacts.phone'))
                            <span class="font-md">{{ config('settings.contacts.phone') }}</span>
                        @endif

                        @if (config('settings.contacts.email'))
                            <span class="font-md">{{ config('settings.contacts.email') }}</span>
                        @endif
                    </p>

                    <p class="font-sm color-second font-end">
                        <a class="link-second" href="https://1sweb.ru">1SWEB</a> &copy; 2025
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
