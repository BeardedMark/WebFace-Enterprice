<header class="bord-b-other pad-y-13">
    <div class="container">
        <div class="flex-col-8">
            <div class="flex-row-8">
                <p class="flex-row-5 flex-grow ai-center">
                    <a class="button-brand" data-tooltip="Главная страница"
                        href="{{ route('pages.main') }}">{{ $baseData['shortName'] ?? config('enterprice.base_name') }}</a>
                    <a class="button-second" data-tooltip="Все предложения"
                        href="{{ route('catalogs.index') }}">Каталог</a>
                    <a class="button-other" data-tooltip="Новости и изменения"
                        href="{{ route('pages.feed') }}">Лента</a>

                    <a class="icon" data-tooltip="О компании" href="{{ route('pages.about') }}">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-regular/20/help.png" alt="help" />
                    </a>
                    @isset ($baseData['shortName'])
                        <a class="d-none d-lg-inline color-second font-sm pad-x-8">{{ $baseData['description'] }}</a>
                    @endisset
                </p>

                <div class="flex-row-5">
                    <a class="icon" data-tooltip="Контакты"
                        href="{{ route('pages.contacts') }}">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-regular/20/marker--v1.png" alt="marker--v1" />
                    </a>

                    @isset ($baseData['phone'])
                    <a class="item-other d-none d-lg-inline" data-tooltip="Позвонить" href="">
                        {{ $baseData['phone'] }}</span>
                    </a>
                    @endisset

                    <a class="icon d-inline d-lg-none" data-tooltip="Позвонить" href="">
                        <span>
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-regular/20/phone.png" alt="phone" />
                        </span>
                    </a>

                    {{-- <a class="icon" href="{{ route('offers.compare') }}">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-{{ !empty(session('compare')) && count(session('compare')) > 0 ? 'filled' : 'regular' }}/20/similar-items.png"
                            alt="bar-chart" />
                    </a>

                    <a class="icon" href="{{ route('offers.favorites') }}">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-{{ !empty(session('favorites')) && count(session('favorites')) > 0 ? 'filled' : 'regular' }}/20/bookmark-ribbon.png"
                            alt="star--v1" />
                    </a> --}}

                    <a class="icon" data-tooltip="Корзина"
                        @if (session('basket') && count(session('basket')) > 0) data-notice="{{ count(session('basket')) }}" @endif
                        href="{{ route('basket.index') }}">
                        <img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-{{ !empty(session('basket')) && count(session('basket')) > 0 ? 'filled' : 'regular' }}/20/shopping-basket--v1.png"
                            alt="shopping-basket--v1" />
                    </a>

                    @if (session('user'))
                        <a class="icon" data-tooltip="{{ session('user.name') }}" href="{{ route('auth.main') }}">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-filled/20/user--v1.png" alt="user--v1" />
                        </a>
                    @else
                        <a class="icon" data-tooltip="Вход" href="{{ route('auth.login') }}">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-regular/20/enter-2.png" alt="user--v1" />
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
