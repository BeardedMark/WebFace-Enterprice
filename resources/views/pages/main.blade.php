@extends('layouts.container')

@section('container-content')
    <div class="row g-4 ai-center">
        <div class="col">
            <section class="flex-col-21">
                <div class="flex-col-5 pad-x-5">
                    <h1 class="font-xxl font-bold">DNL</h1>
                    {{-- <p class="font-lg">{{ $baseData['description'] }}</p>
                    <p class="font-md">{{ $baseData['fullName'] }}</p>
                    <p class="font-lg">{{ $baseData['phone'] }}</p> --}}
                </div>

                <div class="flex-row-8">
                    <div class="flex-row-5 flex-grow">
                        <a class="button-brand" href="{{ route('catalogs.index') }}">Посмотреть каталог</a>
                        <a class="button-second" href="{{ route('pages.about') }}">Подробнее</a>
                    </div>
                </div>
            </section>
        </div>

        <div class="col col-4 offset-1">
            <div class="flex-col jc-center ai-center">
                <img src="https://png.pngtree.com/png-clipart/20240602/original/pngtree-house-cleaning-product-png-image_15223549.png"
                    alt="face-id" />
            </div>
        </div>
    </div>

    <div class="row g-4 ai-center">
        <div class="col">
            <section class="flex-col-21">
                <div class="flex-col-5 pad-x-5">
                    <h2 class="font-xxl font-bold">Хиты продаж</h2>
                    <p class="font-lg">Товары которые имеют наивысшую популярность</p>
                </div>
            </section>
        </div>
    </div>

    <div class="row g-4 ai-center">
        <div class="col">
            <section class="flex-col-21">
                <div class="flex-col-5 pad-x-5">
                    <h2 class="font-xxl font-bold">Наши новинки</h2>
                    <p class="font-lg">Советуем вам обратить внимание</p>
                </div>
            </section>
        </div>
    </div>

    <div class="row g-4 ai-center">
        <div class="col">
            <section class="flex-col-21">
                <div class="flex-col-5 pad-x-5">
                    <h2 class="font-xxl font-bold">Бренды и производители</h2>
                    <p class="font-lg">Наши производители, поставщики и просто коллеги</p>
                </div>
            </section>
        </div>
    </div>

    <x-code :code="compact('baseData')" />
@endsection
