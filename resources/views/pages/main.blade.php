@extends('layouts.container')
@section('title', $meta['title'])
@section('description', $meta['description'])
@section('canonical', $meta['canonical'])

@section('container-content')
    <x-code :code="compact('page')" />

    <section class="row g-4 align-items-center">
        <div class="col">
            <div class="flex-col-21">
                <x-header tag='h1' size='xxl' color='brand' :title="$page['data']['header']" :description="$page['data']['description']" :note="$page['data']['content']" />

                <div class="flex-row-5 pad-x-8">
                    <a class="item-second" href="{{ route('pages.about') }}">Подробнее о нас</a>
                    <a class="item-other" href="{{ route('pages.contacts') }}">Наши контакты</a>
                </div>
            </div>
        </div>

        <div class="col col-3 col-md-4 offset-md-1">
            <div class="flex jc-center pad-x-13">
                <img max-height="50px" src="{{ asset('storage/images/logotypes/full-logotype-ru-3.png') }}" />
            </div>
        </div>
    </section>

    <section class="row g-4 jc-center">

        <div class="col col-12 col-md-6">
            @component('pages.frames.banner', [
                'title' => 'Диспенсеры и бумажные полотенца Focus',
                'description' => 'Экономия до 30%',
                'image' => asset('storage/images/promo/Frame-31.png'),
                'link' => route('pages.search', ['brand' => '47589ab0-f8ad-11ee-811d-00155d629f03']),
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-6">
            @component('pages.frames.banner', [
                'title' => 'Бумажные стаканы с Вашим логотипом',
                'description' => 'от 3000 шт в короткие сроки',
                'image' => asset('storage/images/promo/Frame-12.png'),
                'link' => route('pages.search', ['search' => 'Стакан']),
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-4">
            @component('pages.frames.banner', [
                'title' => 'Жироудалитель “Grill” Professional от Grass',
                'description' => 'Мощное оружие против cтойких загрязнений',
                'image' => asset('storage/images/promo/Frame-30.png'),
                'link' => route('pages.search', [
                    'search' => 'Жироудалитель',
                    'manufacturer' => '8c7c3154-7f5e-11ed-80e8-00155d629f03',
                ]),
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-4">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/promo/Frame-29.png'),
                'title' => 'Контейнеры для торта в современном дизайне',
                'description' => 'Абсолютная прозрачность',
                'link' => route('pages.search', ['search' => 'Контейнер для торта']),
            ])
            @endcomponent
        </div>

        <div class="col col-6 col-md-4">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/promo/Frame-32.png'),
                'title' => 'Щетки для мытья посуды Hillbrush',
                'description' => 'Из высокоплотного пластика Разрешена санпином',
                'link' => route('pages.search', ['search' => 'Щетка', 'manufacturer' => '3ab8e81c-0210-11ef-811d-00155d629f03']),
            ])
            @endcomponent
        </div>
    </section>

    <div class="cut"></div>

    @if (count($page['posts']) > 0)
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-row ai-end">
                        <x-header tag='h2' size='xxl' color='brand' title="Новости и статьи"
                            description="Эта информация будет полезна для вас" />

                        <a class="item-other" href="{{ route('posts.index') }}">Все статьи</a>
                    </div>

                    <div class="row g-4">
                        @foreach ($page['posts'] as $post)
                            <div class="col-6 col-md-4 col-lg-3">
                                @component('etp.posts.frames.card', compact('post'))
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="row g-4 ai-center">
        <div class="col">
            <div class="flex-col-34">
                <div class="flex-row ai-end">
                    <x-header tag='h2' size='xxl' color='brand' title="Рекомендуемые товары"
                        description="Предложения, которые мы советуем к вашему вниманию" />

                    <a class="item-other" href="{{ route('catalogs.index') }}">Изучить каталог</a>
                </div>

                <div class="row g-4">
                    @foreach ($recommendedOffers as $recommendedOffer)
                        <div class="col-6 col-md-4 col-lg-3">
                            @component('etp.offers.frames.card', ['offer' => $recommendedOffer])
                            @endcomponent
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="row g-4">

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Крышки от производителя ВЗЛП',
                'description' => 'Обновленная форма: плавные линии. Стала прочнее и надежнее',
                'image' => asset('storage/images/promo/banner-kryshka-3025.jpg'),
                'link' => route('manufacturers.show', '6f264b79-f62b-11ee-811d-00155d629f03'),
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Полипропиленовые стаканы',
                'description' => 'Глянцевые и матовые, 375мл, 500мл, 650мл, возможность брендирования',
                'image' => asset('storage/images/promo/image-150.jpg'),
                'link' => route('pages.search', ['brand' => '6923c265-f62b-11ee-811d-00155d629f03']),
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Полипропиленовые стаканы с U-образным дном Ø90мм',
                'description' => 'Оригинальная форма, безопасно и экологично',
                'image' => asset('storage/images/promo/image-149.png'),
                'link' => route('offers.show', '14a0600e-ba0d-11ec-80c8-00155d62e314'),
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Щелочное моющее средство с ополаскивающим эффектом',
                'description' =>
                    'Применяется для автоматической и полуавтоматической очистки рабочей камеры конвекционной печи и аналогичного теплового оборудования',
                'image' => 'https://i.postimg.cc/85PH7Kjn/B1-(1).jpg',
                'link' => route('offers.show', '2357ab5c-2dad-11f1-81e8-3cecef0ccd3d'),
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Моющее средство (таблетки) с ополаскивающим эффектом',
                'description' =>
                    'Предназначено для автоматической и полуавтоматической очистки рабочей камеры конвекционной печи и аналогичного теплового оборудования',
                'image' => 'https://i.postimg.cc/pTGBzfFZ/B5-(1).jpg',
                'link' => route('offers.show', '4aa993a1-2db0-11f1-81e8-3cecef0ccd3d'),
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Кислотное средство (таблетки)',
                'description' =>
                    'Применяется для ополаскивания и декальцинации поверхности рабочей камеры пароконвектомата, бойлера и тепловых элементов',
                'image' => 'https://i.postimg.cc/xCxPMvz5/B6.jpg',
                'link' => route('offers.show', 'df0aac59-2db1-11f1-81e8-3cecef0ccd3d'),
            ])
            @endcomponent
        </div>
    </section>

    <div class="cut"></div>

    <section class="row g-4 ai-center">
        <div class="col">
            <div class="flex-col-34">
                <div class="flex-row ai-end">
                    <x-header tag='h2' size='xxl' color='brand' title="Хиты продаж"
                        description="Товары которые имеют наивысшую популярность" />

                    <a class="item-other" href="{{ route('catalogs.index') }}">Изучить каталог</a>
                </div>

                @isset($page['popularOffers'])
                    <div class="row g-4">
                        @foreach ($page['popularOffers'] as $popularOffer)
                            <div class="col-6 col-md-4 col-lg-2">
                                @component('etp.offers.frames.card', ['offer' => $popularOffer])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </section>

    <section class="row g-4">

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Пенка Эко Crispi GRASS для мытья посуды',
                'description' => 'Экологичное и безопасное моющее средство, не оставляет разводов на посуде',
                'image' => asset('storage/images/promo/a079e917c2732e21f729d265c29fd499.jpg'),
                'link' => route('offers.show', '14bf9612-60e5-11ec-80c8-00155d588b1f'),
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Контейнер бумажный',
                'description' => 'Прямоугольный с прозрачной ПЭТ крышкой OSQ OPSALAD 500мл',
                'image' => asset('storage/images/promo/d15870dd6b1ac8aa8d1c82456a8176e2.jpg'),
                'link' => route('pages.search', ['search' => 'Контейнер бум']),
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-lg-4 col-md-6">
            @component('pages.frames.card', [
                'title' => 'Контейнер алюминиевый ',
                'description' => 'Прямоугольный L-край Formacia 1500мл',
                'image' => asset('storage/images/promo/64a8491903307d192276993f752c212a.jpeg'),
                'link' => route('catalogs.show', '2f7a824a-8fde-11ed-80ea-00155d629f03'),
            ])
            @endcomponent
        </div>
    </section>

    <div class="cut"></div>

    <section class="row g-4 ai-center">
        <div class="col">
            <div class="flex-col-34">
                <div class="flex-row ai-end">
                    <x-header tag='h2' size='xxl' color='brand' title="Наши новинки"
                        description="Новые позиции в нашем ассортименте" />

                    <a class="item-other" href="{{ route('pages.search') }}">Открыть каталог</a>
                </div>

                @isset($page['newOffers'])
                    <div class="row g-4">
                        @foreach ($page['newOffers'] as $newOffer)
                            <div class="col-6 col-md-4 col-lg-2">
                                @component('etp.offers.frames.card', ['offer' => $newOffer])
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </section>

    <section class="row g-4 jc-center">

        <div class="col col-12 col-md-6">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/promo/Frame-33.png'),
                'title' => 'Юнилевер Professional',
                'description' => 'Мировой лидер в области чистоты и гигиены',
                'link' => route('pages.search', ['brand' => '20e89615-5bc8-11f0-81be-3cecef0ccd3d']),
            ])
            @endcomponent
        </div>

        <div class="col col-12 col-md-6">
            @component('pages.frames.banner', [
                'image' => asset('storage/images/promo/Frame-34.png'),
                'title' => 'Resto Pro',
                'description' => 'Новая линейка профессиональной химии',
                'link' => route('pages.search', ['brand' => '45469658-f8c6-11ee-811d-00155d629f03']),
            ])
            @endcomponent
        </div>
    </section>

    <div class="cut"></div>

    @if (count($page['manufacturers']) > 0)
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-row ai-end">
                        <x-header tag='h2' size='xxl' color='brand' title="Производители наших товаров"
                            description="Наши производители, поставщики и партнеры" />

                        <a class="item-other" href="{{ route('manufacturers.index') }}">Все производители</a>
                    </div>

                    <div class="row g-4">
                        @foreach ($page['manufacturers'] as $manufacturer)
                            <div class="col-6 col-md-4 col-lg-3">
                                @component('etp.manufacturers.frames.card', compact('manufacturer'))
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (count($page['brands']) > 0)
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-row ai-end">
                        <x-header tag='h3' size='xl' color='brand' title="Бренды производителей"
                            description="Крупные линейки марок (брендов) товаров" />

                        <a class="item-other" href="{{ route('brands.index') }}">Все бренды</a>
                    </div>

                    <div class="row g-4">
                        @foreach ($page['brands'] as $brand)
                            <div class="col-6 col-md-4 col-lg-3">
                                @component('etp.brands.frames.card', compact('brand'))
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (count($moreLinks) > 0)
        <section class="row g-4 ai-center">
            <div class="col">
                <div class="flex-col-34">
                    <div class="flex-row ai-end">
                        <x-header tag='h2' size='xxl' color='brand' title="Полезные ссылки"
                            description="Дополнительная информация которая может быть полезна" />

                        <a class="item-other" href="{{ route('pages.search') }}">Поиск по сайту</a>
                    </div>

                    <div class="row g-4">
                        @foreach ($moreLinks as $moreLink)
                            <div class="col-6 col-md-4 col-lg-4">
                                @component('pages.frames.card', $moreLink)
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @isset ($page['data']['content'])
        <section class="html pad-x-13">
            {!! $page['data']['content'] !!}
        </section>
    @endisset
@endsection
