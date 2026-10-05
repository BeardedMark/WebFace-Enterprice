<footer class="back-light bord-t-other pad-y-55 d-print-none">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="flex-row-8 pad-x-13 h-100">
                    @isset($baseData['menuLinks'])
                        <p class="flex-col flex-grow ai-start">
                            @foreach ($baseData['menuLinks'] as $footerLink)
                                <a class="link-second font-sm"
                                    href="{{ $footerLink['url'] }}">{{ $footerLink['title'] }}</a>
                            @endforeach
                        </p>
                    @endisset

                    @if($baseData['account'])
                        <p class="flex-col flex-grow ai-start">
                            <a class="link-second font-sm" href="{{ route('auth.main') }}">Личный кабинет</a>
                            <a class="link-second font-sm" href="{{ route('orders.create') }}">Корзина</a>
                            <a class="link-second font-sm" href="{{ route('auth.logout') }}">Выйти из профиля</a>
                        </p>
                    @endif
                </div>
            </div>

            <div class="col col-12 col-md-4 offset-md-1">
                <div class="flex-col-8 flex-grow">
                    <p class="flex-col jc-end font-end pad-x-13">
                        @isset($baseData['title'])
                            <span class="font-md font-bold">{{ $baseData['title'] }}</span>
                        @endisset

                        @isset($baseData['phone'])
                            <span class="font-sm">{{ $baseData['phone'] }}</span>
                        @endisset

                        @isset($baseData['email'])
                            <span class="font-sm">{{ $baseData['email'] }}</span>
                        @endisset

                        @isset($baseData['address'])
                            <span class="font-sm">{{ $baseData['address'] }}</span>
                        @endisset
                    </p>

                    @isset($baseData['socialLinks'])
                        <div class="flex-row-5 jc-end pad-x-8">
                            @foreach ($baseData['socialLinks'] as $link)
                                <x-linkicon href="{{ $link['url'] }}">{{ $link['title'] }}</x-linkicon>
                            @endforeach
                        </div>
                    @endisset

                    <p class="font-xs color-second font-end pad-x-13">
                        <a class="link-second" href="https://devirs.ru">ДЕВИРС</a> &copy; 2026
                    </p>
                </div>
            </div>
        </div>

        {{-- <x-code :code="compact('baseData')" /> --}}
    </div>
</footer>
