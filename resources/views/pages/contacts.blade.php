@extends('layouts.container')
@section('title', 'Контакты')

@section('container-content')
    <section class="row g-4">
        <div class="col">
            <div class="flex-col-34">
                <div class="flex-col-8 pad-x-5">
                    <h1 class="font-xxl font-bold d-print-none">Контакты</h1>
                    <p class="font-lg">{{ $contacts['organization'] }}</p>

                    @if ($contacts['note'])
                        <p class="font-md">{{ $contacts['note'] }}</p>
                    @endif
                </div>

                <p class="flex-col-5 pad-x-5">
                    @if ($contacts['title'])
                        <span class="font-lg">{{ $contacts['title'] }}</span>
                    @endif

                    @if ($contacts['geo'])
                        <span class="font-md">{{ $contacts['geo'] }}</span>
                    @endif

                    @if ($contacts['email'])
                        <span class="font-lg">{{ $contacts['email'] }}</span>
                    @endif

                    @if ($contacts['phone'])
                        <span class="font-lg">{{ $contacts['phone'] }}</span>
                    @endif

                    @if ($contacts['person'])
                        <span class="font-md">{{ $contacts['person'] }}</span>
                    @endif
                </p>

                <div class="flex-row-5 d-print-none">
                    {{-- <button class="icon" data-tooltip="Копировать" onclick="window.print()"><img width="20"
                            height="20" src="https://img.icons8.com/fluency-systems-regular/20/copy.png"
                            alt="copy" /></button> --}}

                    <button class="icon" data-tooltip="Печать" onclick="window.print()"><img width="20" height="20"
                            src="https://img.icons8.com/fluency-systems-regular/20/print.png" alt="print" /></button>

                    {{-- <button class="icon" data-tooltip="Скачать" onclick="window.print()"><img width="20"
                            height="20" src="https://img.icons8.com/fluency-systems-regular/20/download.png"
                            alt="download" /></button> --}}

                    <x-share />
                </div>
            </div>
        </div>

        <div class="col col-4 col-md-6 offset-md-1">
            <div class="flex-col-34 ai-center jc-center">
                <img class="bord-rad-13 back-light shadow-real"
                    src="{{ $qrDataUri ?? 'https://img.icons8.com/fluency-systems-regular/128/qr-code.png' }}"
                    alt="web-globe" />

                <p class="flex-col font-center d-print-none">
                    <span class="font-lg">Добавить в контакты</span>
                    <span class="font-sm color-second">Отсканируйте код с помощью телефона</span>
                </p>
            </div>
        </div>
    </section>

    @if ($contacts['email'])
        <div id="message" class="cut"></div>

        <section class="row g-4 d-print-none">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-col-8 pad-x-5">
                        <h2 class="font-xl font-bold">Отправить сообщение</h2>
                        <p class="font-lg">Мы открыты для связи. Отправте нам сообщение удобным для вас способом</p>
                    </div>

                    <div class="flex-row-5">
                        @if ($messangers['telegram'])
                            <a class="icon" data-tooltip="Telegram" target="_blink"
                                href="https://t.me/+{{ $messangers['telegram'] }}">
                                <img width="20" height="20"
                                    src="https://img.icons8.com/fluency-systems-regular/20/telegram-app.png"
                                    alt="telegram-app" />
                            </a>
                        @endif

                        @if ($messangers['whatsapp'])
                            <a class="icon" data-tooltip="WhatsApp" target="_blink"
                                href="https://wa.me/+{{ $messangers['whatsapp'] }}">
                                <img width="20" height="20"
                                    src="https://img.icons8.com/fluency-systems-regular/20/whatsapp.png" alt="whatsapp" />
                            </a>
                        @endif

                        @if ($messangers['vkontakte'])
                            <a class="icon" data-tooltip="ВКонтакте" target="_blink"
                                href="https://vk.me/{{ $messangers['vkontakte'] }}">
                                <img width="20" height="20"
                                    src="https://img.icons8.com/fluency-systems-regular/20/vkontakte.png" alt="vkontakte" />
                            </a>
                        @endif

                        <a class="icon" data-tooltip="Email" href="mailto:{{ $contacts['email'] }}">
                            <img width="20" height="20"
                                src="https://img.icons8.com/fluency-systems-regular/20/email.png" alt="email" /></a>
                    </div>
                </div>
            </div>

            <div class="col col-12 col-md-6 offset-md-1">
                <form class="flex-col-21" action="{{ route('pages.message') }}" method="POST">
                    @csrf

                    <div class="flex-col-13">
                        <input type="hidden" name="subject" value="Сообщение со страницы контактов">

                        <div class="flex-col-5">
                            <p class="pad-x-5" for="name">Ваши контактные данные для обратной связи
                                <span class="color-danger">*</span>
                            </p>
                            <input class="input" type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Имя" autocomplete="name" required>

                            <input class="input" type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="Телефон" autocomplete="phone" required>

                            <input class="input" type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="Email" autocomplete="email" required>
                        </div>

                        <div class="flex-col-5">
                            <label class="pad-x-5" for="message">Сообщение</label>
                            <textarea class="input" name="message" id="message" rows="3">{{ old('message') }}</textarea>
                        </div>

                        <p class="color-second pad-x-5 font-sm">
                            Отправляя форму вы подтверждаете свое согласие с
                            <a class="link" href="{{ route('pages.privacy')}}">пользовательским соглашением</a>
                        </p>
                    </div>

                    <div class="flex-row-5 jc-end">
                            <span class="ai-center flex-grow pad-x-5 font-sm"><x-antibot /></span>

                        <button class="button-main" type="submit">Отправить</button>
                    </div>
                </form>
            </div>
        </section>
    @endif

    @if ($contacts['geo'])
        <div id="geo" class="cut"></div>

        <section class="row g-4 d-print-none">
            <div class="col-12">
                <div class="flex-col-34">
                    <div class="flex-col-8 pad-x-5">
                        <h2 class="font-xl font-bold d-print-none">Где мы находимся</h2>
                        <p class="font-lg">{{ $contacts['geo'] }}</p>
                    </div>

                    <iframe class="bord-rad-13 back-other bord-other w-100" height="500" loading="lazy" allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q={{ $contacts['geo'] }}<&output=embed">
                    </iframe>

                </div>
            </div>
        </section>
    @endif

    <x-code :code="compact('contacts')" />
@endsection
