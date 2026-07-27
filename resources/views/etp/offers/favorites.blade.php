@extends('layouts.container')
@section('title', 'Избранные предложения')
@section('description', 'Список товаров, добавленных в избранное')
@section('canonical', route('offers.favorites'))

@section('container-content')
    <x-code :code="compact('offers')" />

    <section class="flex-col-34">
        <x-header tag='h1' size='xxl' color='brand' title="Избранные предложения"
            description="Список товаров, добавленных в избранное" />

        <div class="flex-col-13">
            <div class="flex-row-5" id="favorites-container">
                <div id="empty-favorites-message" class="pad-x-5" style="display: none;">
                    <p class="color-second">Список избранного пуст</p>
                    <a href="{{ route('catalogs.index') }}" class="button-second">Перейти в каталог</a>
                </div>
            </div>
        </div>

        <div class="flex-col-13">
            @component('etp.orders.frames.offers-list', compact('offers'))
            @endcomponent
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
                const container = document.getElementById('favorites-container');
                const emptyMessage = document.getElementById('empty-favorites-message');

                if (favorites.length === 0) {
                    emptyMessage.style.display = 'block';
                    return;
                }

                // Загружаем товары из localStorage с прелоадерами
                let loadedCount = 0;
                favorites.forEach((guid, index) => {
                    // Создаем прелоадер для каждого товара
                    const preloaderId = 'preloader-fav-' + index;
                    const preloaderHTML = `
                        <div class="cut"></div>
                        <div class="flex-row-13 ai-center product-card-loading" id="${preloaderId}" style="padding: 20px; min-height: 100px; align-items: center; justify-content: center;">
                            <div class="preloader-spinner-small"></div>
                        </div>
                    `;
                    container.innerHTML += preloaderHTML;

                    fetch('/offers/' + encodeURIComponent(guid) + '/card')
                        .then(res => res.json())
                        .then(data => {
                            const preloader = document.getElementById(preloaderId);
                            if (preloader && data.success && data.html) {
                                preloader.outerHTML = data.html;
                            } else if (preloader && !data.success) {
                                preloader.remove();
                                const cutDiv = preloader.previousElementSibling;
                                if (cutDiv && cutDiv.classList.contains('cut')) cutDiv.remove();
                            }

                            loadedCount++;
                            if (loadedCount === favorites.length) {
                                if (container.querySelectorAll('.product-card').length === 0) {
                                    emptyMessage.style.display = 'block';
                                }
                                setTimeout(() => {
                                    if (typeof window.getProductCardsActions === 'function') {
                                        window.getProductCardsActions();
                                    }
                                }, 200);
                            }
                        })
                        .catch(err => {
                            console.error('Ошибка загрузки товара:', err);
                            const preloader = document.getElementById(preloaderId);
                            if (preloader) {
                                const cutDiv = preloader.previousElementSibling;
                                if (cutDiv && cutDiv.classList.contains('cut')) {
                                    cutDiv.remove();
                                }
                                preloader.remove();
                            }
                            loadedCount++;
                            if (loadedCount === favorites.length && container.querySelectorAll(
                                    '.product-card').length === 0) {
                                emptyMessage.style.display = 'block';
                            }
                        });
                });
            });
        </script>

        <style>
            .preloader-spinner-small {
                width: 24px;
                height: 24px;
                border: 3px solid var(--color-other, #e5e5e5);
                border-top-color: var(--color-brand, #007bff);
                border-radius: 50%;
                animation: spin 0.8s linear infinite;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            .product-card-loading {
                opacity: 0.6;
            }
        </style>
    </section>
@endsection
