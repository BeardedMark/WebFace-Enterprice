<footer class="bord-t-other pad-y-13">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="flex-row-8 pad-x-5">
                    <p class="flex-col flex-grow">
                        <a class="link-second font-sm" href="{{ route('pages.main') }}">Главная</a>
                        <a class="link-second font-sm" href="{{ route('pages.about') }}">О проекте</a>
                        <a class="link-second font-sm" href="{{ route('catalogs.index') }}">Каталог</a>
                        <a class="link-second font-sm" href="{{ route('pages.contacts') }}">Контакты</a>
                    </p>

                    <p class="flex-col flex-grow">
                        <a class="link-second font-sm" href="{{ route('auth.main') }}">Личный кабинет</a>
                        <a class="link-second font-sm" href="{{ route('pages.enterprice') }}">1С Предприятие</a>
                        <a class="link-second font-sm" href="{{ route('odata.dashboard') }}">OData публикации</a>
                        <a class="link-second font-sm" href="{{ route('pages.extension') }}">API Расширение</a>
                    </p>
                </div>
            </div>

            <div class="col col-4 offset-1">

                <div class="flex-col-8 flex-grow">
                    <p class="flex-col jc-end font-end pad-x-5">
                        @isset($baseData['shortName'])
                            <span class="font-md font-bold">{{ $baseData['fullName'] }}</span>
                        @endisset
                        @isset($baseData['shortName'])
                            <span class="font-sm">{{ $baseData['addres'] }}</span>
                        @endisset
                        @isset($baseData['shortName'])
                            <span class="font-md">{{ $baseData['email'] }}</span>
                        @endisset
                        @isset($baseData['shortName'])
                            <span class="font-md color-brand">{{ $baseData['phone'] }}</span>
                        @endisset
                    </p>

                    <p class="font-sm color-second font-end pad-x-5">
                        <a class="link-second" href="#">1SWEB</a> &copy; 2025
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
