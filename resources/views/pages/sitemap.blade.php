@extends('layouts.container')
@section('title', 'Карта сайта')
@section('description', 'Полная карта сайта с ссылками на все страницы')
@section('canonical', route('pages.sitemap'))

@section('container-content')

    <section class="flex-col-21">
        <x-header tag='h1' size='xxl' color='brand' title="Карта сайта"
            description="Полная карта сайта с ссылками на все страницы" />
    </section>

    <section class="flex-col-21 pad-x-13">
        <div class="row">
            <div class="col">
                <div class="flex-col-21">
                    <ul>
                        <li><a class="link" href="{{ route('pages.main') }}">Главная</a></li>
                        <li><a class="link" href="{{ route('pages.about') }}">О компании</a></li>
                        <li><a class="link" href="{{ route('pages.contacts') }}">Контакты</a></li>
                        <li><a class="link" href="{{ route('pages.search') }}">Поиск</a></li>
                    </ul>

                    <ul>
                        <li><a class="link" href="{{ route('catalogs.index') }}">Каталог</a></li>
                        <li><a class="link" href="{{ route('manufacturers.index') }}">Производители</a></li>
                        <li><a class="link" href="{{ route('brands.index') }}">Марки (бренды)</a></li>
                        <li><a class="link" href="{{ route('posts.index') }}">Статьи</a></li>
                    </ul>

                    <ul>
                        <li><a class="link" href="{{ route('auth.main') }}">Личный кабинет</a></li>
                        <li><a class="link" href="{{ route('orders.create') }}">Корзина</a></li>
                    </ul>

                    <ul>
                        <li><a class="link-second" href="{{ route('pages.privacy') }}">Политика конфиденциальности</a></li>
                        <li><a class="link-second" href="{{ route('pages.sitemap') }}">Карта сайта</a></li>
                    </ul>
                </div>
            </div>

            <div class="col col-4 offset-1">


                {{-- <div class="row g-4">

                    <div class="col">
                        <p class="flex-col bord-rad-13 hover-up h-100 pad-13">
                            <span class="font-xl font-center"><x-number :value="$statistics['characteristicsCount']" /></span>
                            <span class="font-md font-center">характеристик</span>
                        </p>
                    </div>

                    <div class="col">
                        <p class="flex-col bord-rad-13 hover-up h-100 pad-13">
                            <span class="font-xl font-center"><x-number :value="$statistics['catalogsCount']" /></span>
                            <span class="font-md font-center">категорий</span>
                        </p>
                    </div>

                    <div class="col">
                        <p class="flex-col bord-rad-13 hover-up h-100 pad-13">
                            <span class="font-xl font-center"><x-number :value="$statistics['contractorsCount']" /></span>
                            <span class="font-md font-center">контрагентов</span>
                        </p>
                    </div>
                </div> --}}
                {{-- <div class="flex-col ai-center jc-center">
                    <img width="128" height="128" src="https://img.icons8.com/fluency-systems-regular/128/waypoint-map.png"
                        alt="web-globe" />
                </div> --}}
            </div>
        </div>
    </section>
@endsection
