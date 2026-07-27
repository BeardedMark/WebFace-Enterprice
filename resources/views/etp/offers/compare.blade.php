@extends('layouts.container')
@section('title', 'Сравнение предложений')
@section('description', 'Список товаров для сравнения')
@section('canonical', route('offers.compare'))

@section('container-content')
    <section class="flex-col-34">
        <div class="flex-col-5 pad-x-5">
            <h1 class="font-xxl font-bold">Сравнение предложений</h1>
            <p class="font-lg">Список товаров для сравнения</p>
        </div>

        <div class="flex-col-13">
            <div class="flex-col-5" id="compare-container">
                <div id="empty-compare-message" class="pad-x-5" style="display: none;">
                    <p class="color-second">Список сравнения пуст</p>
                    <a href="{{ route('catalogs.index') }}" class="button-second">Перейти в каталог</a>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let compare = JSON.parse(localStorage.getItem('compare') || '[]');
                const container = document.getElementById('compare-container');
                const emptyMessage = document.getElementById('empty-compare-message');

                if (compare.length === 0) {
                    emptyMessage.style.display = 'block';
                    return;
                }

                // Загружаем товары из localStorage с прелоадерами
                let loadedCount = 0;
                compare.forEach((guid, index) => {
                    // Создаем прелоадер для каждого товара
                    const preloaderId = 'preloader-cmp-' + index;
                    const preloaderHTML = `
                        <div class="cut"></div>
                        <div class="flex-row-13 ai-center product-card-loading" id="${preloaderId}" style="padding: 20px; min-height: 100px; align-items: center; justify-content: center;">
                            <div class="preloader-spinner-small"></div>
                        </div>
                    `;
                    container.innerHTML += preloaderHTML;

                    fetch('/basket/offerbyorder?guid=' + encodeURIComponent(guid) + '&quantity=1')
                        .then(res => res.text())
                        .then(html => {
                            const preloader = document.getElementById(preloaderId);
                            if (preloader) {
                                preloader.outerHTML = html;
                            }

                            loadedCount++;
                            if (loadedCount === compare.length) {
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
                            if (loadedCount === compare.length && container.querySelectorAll('.product-card').length === 0) {
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
