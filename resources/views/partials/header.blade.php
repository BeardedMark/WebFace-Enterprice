<header class="back-light bord-b-other pad-y-13 d-print-none" style="position: sticky; top: 0; z-index: 100;">
    <div class="container">
        <div class="flex-row-13 pad-x-8 ai-center">
            <a style="height: 32px" onclick="showPreloader()" data-tooltip="{{ $baseData['name'] }}"
                href="{{ route('pages.main') }}">
                <img class="h-100" width="auto" height="100%"
                    src="{{ asset('storage/images/logotypes/logo-ru.png') }}"
                    alt="{{ asset('storage/images/logotypes/logo-ru.png') }}" />
            </a>

            <p class="flex-row-5 flex-grow ai-center">
                {{-- <a class="button-brand" onclick="showPreloader()" data-tooltip="Главная страница"
                    href="{{ route('pages.main') }}">{{ $baseData['shortName'] ?? '1С: Сайт' }}</a> --}}


                <a class="icon" onclick="showPreloader()" data-tooltip="Меню" href="{{ route('pages.sitemap') }}">
                    <img width="20" height="20" src="{{ asset('storage/images/icons/menu--v1.png') }}"
                        alt="marker--v1" />
                </a>

                <a class="item-other" onclick="showPreloader()" data-tooltip="Подробнее о нас"
                    href="{{ route('pages.about') }}">О компании</a>

                <a class="item-second d-none d-lg-block" onclick="showPreloader()" data-tooltip="Все предложения"
                    href="{{ route('catalogs.index') }}">Каталог</a>

                <a class="icon d-none d-lg-block" onclick="showPreloader()" data-tooltip="Поиск"
                    href="{{ route('pages.search') }}">
                    <img width="20" height="20" src="{{ asset('storage/images/icons/search.png') }}"
                        alt="help" />
                </a>

                {{-- @if ($baseData['phone'])
                    <span class="d-none d-lg-inline color-second font-sm pad-x-8">{{ $baseData['description'] }}</span>
                @endif --}}
            </p>

            <div class="flex-row-5">
                <a class="icon" onclick="showPreloader()" data-tooltip="Контакты"
                    href="{{ route('pages.contacts') }}">
                    <img width="20" height="20" src="{{ asset('storage/images/icons/phone-book.png') }}"
                        alt="call-list" />
                </a>

                @if ($baseData['phone'])
                    <a class="item-other d-none d-lg-inline" data-tooltip="Позвонить"
                        href="tel:{{ $baseData['phone'] }}">
                        {{ $baseData['phone'] }}</a>
                @endif

                {{-- <a class="icon" id="header-compare" onclick="showPreloader()" data-tooltip="Сравнение" href="{{ route('offers.compare') }}">
                    <img width="20" height="20"
                        src="{{ asset('storage/images/icons/similar-items.png') }}"
                        alt="similar-items" />
                </a> --}}

                {{-- <a class="icon" id="header-favorites" onclick="showPreloader()" data-tooltip="Избранное"
                    href="{{ route('offers.favorites') }}">
                    <img width="20" height="20"
                        src="{{ asset('storage/images/icons/bookmark-ribbon.png') }}"
                        alt="bookmark-ribbon" />
                </a> --}}

                <a class="icon d-none d-lg-block" id="basket" onclick="showPreloader()" data-tooltip="Корзина"
                    href="{{ route('orders.basket') }}">
                    <img width="20" height="20"
                        src="{{ asset('storage/images/icons/shopping-basket--v1.png') }}" alt="shopping-basket--v1" />
                </a>

                @if (session('user'))
                    <a class="icon" onclick="showPreloader()" data-tooltip="{{ session('user.name') }}"
                        href="{{ route('auth.main') }}">
                        <img width="20" height="20" src="{{ asset('storage/images/icons/user--v1.png') }}"
                            alt="user--v1" />
                    </a>
                @else
                    {{-- <a class="icon" onclick="showPreloader()" data-tooltip="Вход" href="{{ route('auth.login') }}">
                        <img width="20" height="20" src="{{ asset('storage/images/icons/enter-2.png') }}"
                            alt="enter-2" />
                    </a> --}}
                    <button onclick="openModal('login')" class="icon" data-tooltip="Вход"
                        href="{{ route('auth.login') }}">
                        <img width="20" height="20" src="{{ asset('storage/images/icons/enter-2.png') }}"
                            alt="enter-2" />
                    </button>
                @endif
            </div>
        </div>
    </div>
</header>

<nav class="d-lg-none back-light bord-t-other d-print-none"
    style="position: fixed; left: 0; right: 0; bottom: 0; z-index: 110; padding: 8px 12px calc(8px + env(safe-area-inset-bottom));">
    <div class="container">
        <div class="flex-row-5 jc-ev ai-center">
            <a class="icon" onclick="showPreloader()" data-tooltip="Поиск" href="{{ route('pages.search') }}">
                <img width="20" height="20" src="{{ asset('storage/images/icons/search.png') }}"
                    alt="help" />
            </a>

            <a class="item-second" onclick="showPreloader()" data-tooltip="Все предложения"
                href="{{ route('catalogs.index') }}">Каталог</a>

            <a class="icon" id="basket" onclick="showPreloader()" data-tooltip="Корзина"
                href="{{ route('orders.basket') }}">
                <img width="20" height="20" src="{{ asset('storage/images/icons/shopping-basket--v1.png') }}"
                    alt="shopping-basket--v1" />
            </a>
        </div>
    </div>
</nav>

<x-modal name="login" title="Вход в личный кабинет">
    @component('auth.frames.login-form')
    @endcomponent
</x-modal>
