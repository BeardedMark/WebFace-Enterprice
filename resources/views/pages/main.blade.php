@extends('layouts.container')
@section('title', 'Главная страница')

@section('container-content')
    <section class="row g-4">
        <div class="col">
            <div class="flex-col-21">
                <div class="flex-col-8 pad-x-13 flex-grow">
                    <h1 class="font-xxl flex-grow "><span class="color-brand">DNL</span>MARKET</h1>
                    <p class="font-lg">{{ config('settings.base.note') }}</p>
                </div>

                <div class="flex-row-5 pad-x-8">
                    <a class="button-second" href="{{ route('pages.about') }}">Подробнее о нас</a>
                    <a class="button-other" href="{{ route('pages.contacts') }}">Наши контакты</a>
                </div>
            </div>
        </div>

        <div class="col col-3 col-md-4 offset-md-1">
            <div class="flex jc-center pad-x-13">
                <img src="{{ asset('storage/images/logotypes/full-logotype.png') }}" />
            </div>
        </div>
    </section>

    <section class="row g-4 jc-center">
        <div class="col col-12 col-md-6">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/baners/Frame 31.png'),
                'title' => 'Диспенсеры и бумажные полотенца Focus',
                'description' => 'Экономия до 30%',
                'link' => route('catalogs.index'),
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-6">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/baners/Frame 12.png'),
                'title' => 'Бумажные стаканы с Вашим логотипом',
                'description' => 'от 3000 шт в короткие сроки',
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-4">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/baners/Frame 30.png'),
                'title' => 'Жироудалитель “Grill” Professional от Grass',
                'description' => 'Мощное оружие против cтойких загрязнений',
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-4">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/baners/Frame 29.png'),
                'title' => 'Контейнеры для торта в современном дизайне',
                'description' => 'Абсолютная прозрачность',
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-4">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/baners/Frame 32.png'),
                'title' => 'Щетки для мытья посуды Hillbrush',
                'description' => 'Из высокоплотного пластика Разрешена санпином',
            ])
            @endcomponent
        </div>
    </section>

    <section class="row g-4 ai-center">
        <div class="col">
            <div class="flex-col-34">
                <div class="flex-col-8 pad-x-13">
                    <h2 class="font-xl font-bold">Хиты продаж</h2>
                    <p class="font-lg">Товары которые имеют наивысшую популярность</p>
                </div>

                <div class="row g-4">
                    @foreach ($topOffers as $topOffer)
                        <div class="col-6 col-md-4 col-lg-3">
                            @component('db.offers.frames.card', ['offer' => $topOffer])
                            @endcomponent
                        </div>
                    @endforeach
                </div>

                <x-code :code="compact('topOffers')" />
            </div>
        </div>
    </section>

    <section class="row g-4">

        <div class="col col-12 col-md-4">
            @component('pages.frames.card', [
                'title' => 'ПЕНКА Эко Crispi GRASS для мытья посуды',
                'description' => 'Экологичное и безопасное моющее средство, не оставляет разводов на посуде',
                'image' => 'https://dnlmarket.ru/upload/iblock/a07/a079e917c2732e21f729d265c29fd499.jpg',
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-md-4">
            @component('pages.frames.card', [
                'title' => 'Контейнер PAP',
                'description' => 'Прямоугольный с прозрачной PET крышкой OSQ OPSALAD 500мл',
                'image' => 'https://dnlmarket.ru/upload/iblock/d15/d15870dd6b1ac8aa8d1c82456a8176e2.jpg',
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-md-4">
            @component('pages.frames.card', [
                'title' => 'Контейнер алюминиевый ',
                'description' => 'Прямоугольный L-край Formacia 1500мл',
                'image' => 'https://dnlmarket.ru/upload/iblock/64a/64a8491903307d192276993f752c212a.jpeg',
            ])
            @endcomponent
        </div>
    </section>

    <section class="row g-4 ai-center">
        <div class="col">
            <div class="flex-col-34">
                <div class="flex-col-8 pad-x-13">
                    <h2 class="font-xl font-bold">Наши новинки</h2>
                    <p class="font-lg">Новые позиции в нашем ассортименте</p>
                </div>

                <div class="row g-4">
                    @foreach ($newOffers as $newOffer)
                        <div class="col-6 col-md-4 col-lg-3">
                            @component('db.offers.frames.card', ['offer' => $newOffer])
                            @endcomponent
                        </div>
                    @endforeach
                </div>

                <x-code :code="compact('newOffers')" />
            </div>
        </div>
    </section>

    <section class="row g-4 jc-center">
        <div class="col col-12 col-md-6">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/baners/Frame 33.png'),
                'title' => 'Юнилевер Professional',
                'description' => 'Мировой лидер в области чистоты и гигиены',
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-md-6">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/baners/Frame 34.png'),
                'title' => 'Resto Pro',
                'description' => 'Новая линейка профессиональной химии',
            ])
            @endcomponent
        </div>
    </section>

    <div class="cut pad-x-13"></div>

    @if (count($randomOffers) > 0)
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-col-8 pad-x-13">
                        <h2 class="font-xl font-bold">Случайные предложения</h2>
                        <p class="font-lg">Возможно вам будет это интересно</p>
                    </div>

                    <div class="row g-4">
                        @foreach ($randomOffers as $randomOffer)
                            <div class="col-6 col-md-4 col-lg-2">
                                @component('db.offers.frames.card', ['offer' => $randomOffer])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>

                    <x-code :code="compact('randomOffers')" />
                </div>
            </div>
        </section>
    @endif

    <section class="row g-4 jc-center">
        <div class="col col-12 col-md-4">
            @component('pages.frames.banner', [
                'image' =>
                    'https://static-basket-01.wbbasket.ru/vol1/crm-bnrs/bnnrsdmn/image/1472x600/46bb5928-0f44-4d5f-b0b2-b715563c1c1b.webp',
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-4">
            @component('pages.frames.banner', [
                'image' =>
                    'https://static-basket-01.wbbasket.ru/vol1/crm-bnrs/bnnrsdmn/image/1472x600/d8111757-3126-4c78-9ca8-36f6da9a3a84.webp',
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-4">
            @component('pages.frames.banner', [
                'image' =>
                    'https://static-basket-01.wbbasket.ru/vol1/crm-bnrs/bnnrsdmn/image/1472x600/4e87d37b-92ce-49fb-8735-ea142ca23d1b.webp',
            ])
            @endcomponent
        </div>
    </section>

    @if (count($popularBrands) > 0)
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-col-8 pad-x-13">
                        <h2 class="font-xl font-bold">Крупные бренды</h2>
                        <p class="font-lg">Наши производители, поставщики и просто коллеги</p>
                    </div>

                    <div class="row g-4">
                        @foreach ($popularBrands as $popularBrand)
                            <div class="col-6 col-md-4 col-lg-3">
                                @component('db.brands.frames.card', $popularBrand)
                                @endcomponent
                            </div>
                        @endforeach
                    </div>

                    {{-- <div class="flex-row-5 flex-grow jc-end">
                        <a class="button-main" href="{{ route('catalogs.index') }}">Все бренды</a>
                    </div> --}}

                    <x-code :code="compact('popularBrands')" />
                </div>
            </div>
        </section>
    @endif

    <div class="cut"></div>

    @if (count($moreLinks) > 0)
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-col-8 pad-x-13">
                        <h2 class="font-xl font-bold">Полезные ссылки</h2>
                        <p class="font-lg">Дополнительная информация которая может быть полезна</p>
                    </div>

                    <div class="row g-4">
                        @foreach ($moreLinks as $moreLink)
                            <div class="col-6 col-md-4 col-lg-4">
                                @component('pages.frames.card', $moreLink)
                                @endcomponent
                            </div>
                        @endforeach
                    </div>

                    <x-code :code="compact('moreLinks')" />
                </div>
            </div>
        </section>
    @endif
@endsection
