@extends('layouts.container')
@section('title', $meta['title'])
@section('description', $meta['description'])
@section('canonical', $meta['canonical'])

@section('container-content')
    <x-code :code="compact('page', 'meta')" />

    <section class="row g-4">
        <div class="col">
            <div class="flex-col-34">

                <x-header tag='h1' size='xxl' color='brand' :title="$page['data']['header']" :description="$page['data']['description']" :note="$page['data']['content']" />

                <div class="flex-col-21">
                    <p class="flex-col-5 pad-x-13">
                        @isset($baseData['email'])
                            <span class="font-lg">{{ $baseData['email'] }}</span>
                        @endisset

                        @isset($baseData['phone'])
                            <span class="font-lg">{{ $baseData['phone'] }}</span>
                        @endisset
                    </p>

                    <p class="flex-col pad-x-13">
                        @isset($baseData['address'])
                            <span class="font-sm">{{ $baseData['address'] }}</span>
                        @endisset
                    </p>


                    <div class="flex-row-5 d-print-none pad-x-8">
                        @foreach ($baseData['links'] as $link)
                            <x-linkicon href="{{ $link['url'] }}">{{ $link['title'] }}</x-linkicon>
                        @endforeach

                        {{-- <button class="icon" data-tooltip="Печать" onclick="window.print()"><img width="20"
                                height="20" src="https://img.icons8.com/fluency-systems-regular/20/print.png"
                                alt="print" /></button>
                        <x-share /> --}}
                    </div>
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

    @isset($baseData['email'])
        <div id="message" class="cut"></div>

        <section class="row g-4 d-print-none">
            <div class="col">
                <div class="flex-col-34">
                    <x-header tag='h2' size='xl' color='brand' title="Отправить сообщение"
                        description="Мы открыты для связи" note="Отправте нам сообщение удобным для вас способом" />
                </div>
            </div>

            <div class="col col-12 col-md-6 offset-md-1">
                <form class="flex-col-21 pad-x-8" action="{{ route('pages.message') }}" method="POST">
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
                            <a class="link" href="{{ route('pages.privacy') }}">пользовательским соглашением</a>
                        </p>
                    </div>

                    <div class="flex-row-5 jc-end">
                        <span class="ai-center flex-grow pad-x-5 font-sm"><x-antibot /></span>

                        <button class="button-main" type="submit">Отправить</button>
                    </div>
                </form>
            </div>
        </section>
    @endisset

    @isset($baseData['address'])
        <div id="geo" class="cut"></div>

        <section class="row g-4 d-print-none">
            <div class="col-12">
                <div class="flex-col-34">
                    <x-header tag='h2' size='xl' color='brand' title="Мы на карте"
                        description="Где фактически мы находимся" :note="$baseData['address']" />

                    <iframe class="bord-rad-13 back-other bord-other w-100" height="500" loading="lazy" allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q={{ $baseData['address'] }}<&output=embed">
                    </iframe>

                </div>
            </div>
        </section>
    @endisset

    @isset($page['data']['content'])
        <section class="html pad-x-13">
            {!! $page['data']['content'] !!}
        </section>
    @endisset
@endsection
