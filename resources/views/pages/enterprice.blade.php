@extends('layouts.container')

@section('container-content')
    <div class="row">
        <div class="col">
            <section class="flex-col-34">
                <div class="flex-col-5 pad-x-5">
                    <h1 class="font-xxl font-bold">1С Предприятие</h1>
                    <p class="font-lg">Подробная информация о соединении с сервером</p>
                    <p class="font-md">При открытии страницы, данные берутся сразу из 1С. Это позволяет быстро влиять на
                        контент сайта и автоматически поддерживать актуальность информации на сайте</p>
                </div>

                <div class="flex-row-5 flex-grow">
                    <a class="button-main" href="https://1s.dnlmarket.ru/ut/ru/">Открыть в браузере</a>
                    <a class="button-second" href="https://1s.dnlmarket.ru/ut/ru/">Скачать клиент</a>
                </div>
            </section>
        </div>

        <div class="col col-4 offset-1">
            <div class="flex-col ai-center jc-center">
                <img width="128" height="128" src="https://img.icons8.com/fluency-systems-regular/128/web-globe.png"
                    alt="web-globe" />

                <p class="font-md">Время отклика 1С</p>
                <x-ping />
            </div>
        </div>
    </div>
@endsection
