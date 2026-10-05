<header class="back-light bord-b-other pad-y-13 d-print-none" style="position: sticky; top: 0; z-index: 100;">
    <div class="container">

        <div class="flex-row-13 pad-x-8 ai-center">

            {{-- Логотип --}}
            <a style="height: 32px" onclick="showPreloader()" data-tooltip="{{ $baseData['title'] }}"
                href="{{ route('pages.main') }}">
                <img class="h-100" width="auto" height="100%"
                    src="{{ asset('storage/images/logotypes/logo-ru.png') }}" alt="{{ $baseData['title'] }}" />
            </a>

            <div class="flex-row-5 flex-grow ai-center">

                {{-- Меню --}}
                {{-- <a class="icon" onclick="showPreloader()" data-tooltip="Меню"
                    href="{{ route('pages.page', 'sitemap') }}">
                    <img width="20" height="20" src="{{ asset('storage/images/icons/menu--v1.png') }}"
                        alt="Меню" />
                </a> --}}

                <button type="button" onclick="openModal('menu')" class="icon" data-tooltip="Меню">
                    <img width="20" height="20" src="{{ asset('storage/images/icons/menu--v1.png') }}"
                        alt="Меню" />
                </button>


                {{-- Основная навигация --}}
                @isset($baseData['headerLinks'])
                    <div class="flex-row-5 ai-center d-none d-lg-flex">
                        @foreach ($baseData['headerLinks'] as $link)
                            <a class="{{ $link['style'] }}" onclick="showPreloader()"
                                data-tooltip="{{ $link['description'] }}" href="{{ $link['url'] }}">
                                {{ $link['title'] }}
                            </a>
                        @endforeach
                    </div>
                @endisset

                {{-- Поиск --}}
                <x-search action="{{ route('pages.search') }}" name="search" placeholder="Поиск по сайту"
                    value="{{ request('search') }}" />

            </div>

            <div class="flex-row-5">

                {{-- Контакты --}}
                <a class="icon" onclick="showPreloader()" data-tooltip="Контакты"
                    href="{{ route('pages.page', 'contacts') }}">
                    <img width="20" height="20" src="{{ asset('storage/images/icons/phone-book.png') }}"
                        alt="Контакты" />
                </a>

                {{-- Телефон --}}
                @if ($baseData['phone'])
                    <a class="item-other d-none d-lg-inline" data-tooltip="Позвонить"
                        href="tel:{{ $baseData['phone'] }}">
                        {{ $baseData['phone'] }}
                    </a>
                @endif

                {{-- Сравнение --}}
                {{-- <a class="icon" id="header-compare" onclick="showPreloader()" data-tooltip="Сравнение"
                    href="{{ route('offers.compare') }}">
                    <img width="20" height="20" src="{{ asset('storage/images/icons/similar-items.png') }}"
                        alt="Сравнение" />
                </a> --}}

                {{-- Избранное --}}
                {{-- <a class="icon" id="header-favorites" onclick="showPreloader()" data-tooltip="Избранное"
                    href="{{ route('offers.favorites') }}">
                    <img width="20" height="20" src="{{ asset('storage/images/icons/bookmark-ribbon.png') }}"
                        alt="Избранное" />
                </a> --}}

                {{-- Корзина --}}
                <a class="icon d-none d-lg-block" id="basket" onclick="showPreloader()" data-tooltip="Корзина"
                    href="{{ route('orders.basket') }}">
                    <img width="20" height="20"
                        src="{{ asset('storage/images/icons/shopping-basket--v1.png') }}" alt="Корзина" />
                </a>

                {{-- Личный кабинет --}}
                @if ($baseData['account'])
                    @if (session('user'))
                        <a class="icon" onclick="showPreloader()" data-tooltip="{{ session('user.name') }}"
                            href="{{ route('auth.main') }}">
                            <img width="20" height="20" src="{{ asset('storage/images/icons/user--v1.png') }}"
                                alt="Личный кабинет" />
                        </a>
                    @else
                        <button type="button" onclick="openModal('login')" class="icon" data-tooltip="Вход">
                            <img width="20" height="20" src="{{ asset('storage/images/icons/enter-2.png') }}"
                                alt="Вход" />
                        </button>
                    @endif
                @endif

            </div>

        </div>

    </div>
</header>


{{-- Мобильная навигация --}}
<nav class="d-lg-none back-light bord-t-other d-print-none"
    style="position: fixed; left: 0; right: 0; bottom: 0; z-index: 110; padding: 8px 12px calc(8px + env(safe-area-inset-bottom));">
    <div class="container">

        <div class="flex-row-5 jc-ev ai-center">

            @isset($baseData['headerLinks'])
                @foreach ($baseData['headerLinks'] as $link)
                    <a class="{{ $link['style'] }}" onclick="showPreloader()" data-tooltip="{{ $link['description'] }}"
                        href="{{ $link['url'] }}">
                        {{ $link['title'] }}
                    </a>
                @endforeach
            @endisset

        </div>

    </div>
</nav>


{{-- Модальное окно авторизации --}}
<x-modal name="login" title="Вход в личный кабинет">
    @component('auth.frames.login-form')
    @endcomponent
</x-modal>

{{-- Модальное окно меню --}}
<x-modal name="menu" title="Главное меню" position="left">
    <p class="flex-col-5 flex-grow ai-start">
        @isset($baseData['menuLinks'])
            @foreach ($baseData['menuLinks'] as $footerLink)
                <a class="item-other w-100" href="{{ $footerLink['url'] }}">{{ $footerLink['title'] }}</a>
            @endforeach
        @endisset
    </p>
</x-modal>
