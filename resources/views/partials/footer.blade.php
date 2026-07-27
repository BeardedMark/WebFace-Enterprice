<footer class="back-light bord-t-other pad-y-55 d-print-none">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="flex-row-8 pad-x-13 h-100">
                    <p class="flex-col flex-grow ai-start">
                        <a class="link-second font-sm" href="{{ route('pages.main') }}">Главная</a>
                        <a class="link-second font-sm" href="{{ route('pages.about') }}">О проекте</a>
                        <a class="link-second font-sm" href="{{ route('pages.search') }}">Поиск</a>
                        <a class="link-second font-sm" href="{{ route('pages.contacts') }}">Контакты</a>
                    </p>

                    <p class="flex-col flex-grow ai-start">
                        <a class="link-second font-sm" href="{{ route('catalogs.index') }}">Каталог</a>
                        <a class="link-second font-sm" href="{{ route('manufacturers.index') }}">Производители</a>
                        <a class="link-second font-sm" href="{{ route('brands.index') }}">Марки (Бренды)</a>
                        <a class="link-second font-sm" href="{{ route('posts.index') }}">Статьи</a>
                    </p>

                    <p class="flex-col flex-grow ai-start">
                        <a class="link-second font-sm" href="{{ route('auth.main') }}">Личный кабинет</a>
                        <a class="link-second font-sm" href="{{ route('orders.create') }}">Корзина</a>
                    </p>
                </div>
            </div>

            <div class="col col-12 col-md-4 offset-md-1">
                <div class="flex-col-8 flex-grow">
                    <p class="flex-col jc-end font-end pad-x-13">
                        @isset ($baseData['name'])
                            <span class="font-md font-bold">{{ $baseData['name'] }}</span>
                        @endisset

                        @isset ($baseData['phone'])
                            <span class="font-sm">{{ $baseData['phone'] }}</span>
                        @endisset

                        @isset ($baseData['email'])
                            <span class="font-sm">{{ $baseData['email'] }}</span>
                        @endisset

                        @isset ($baseData['address'])
                            <span class="font-sm">{{ $baseData['address'] }}</span>
                        @endisset
                    </p>

                    <div class="flex-row-5 jc-end pad-x-8">
                        @foreach ($baseData['links'] as $link)
                            <x-linkicon href="{{ $link['url'] }}">{{ $link['title'] }}</x-linkicon>
                        @endforeach
                    </div>

                    <p class="font-xs color-second font-end pad-x-13">
                        <a class="link-second" href="https://devirs.ru">ДЕВИРС</a> &copy; 2026
                    </p>
                </div>
            </div>
        </div>

        {{-- <x-code :code="compact('baseData')" /> --}}
    </div>
</footer>

