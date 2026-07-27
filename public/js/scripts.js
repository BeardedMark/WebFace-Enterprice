const addToBasket = (guid) => {
    let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');

    const curLocalProductIdx = localBasket.findIndex(item => item.guid === guid);

    if (curLocalProductIdx !== -1) {
        localBasket[curLocalProductIdx] = {
            ...localBasket[curLocalProductIdx],
            quantity: localBasket[curLocalProductIdx].quantity + 1,
        };
    } else {
        localBasket.push({
            guid,
            quantity: 1,
        });
    }

    localStorage.setItem("basket", JSON.stringify(localBasket));
};

const deleteFromBasket = (guid) => {
    let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');

    const curLocalProductIdx = localBasket.findIndex(item => item.guid === guid);

    if (curLocalProductIdx !== -1) {
        if (localBasket[curLocalProductIdx].quantity > 1) {
            localBasket[curLocalProductIdx] = {
                ...localBasket[curLocalProductIdx],
                quantity: localBasket[curLocalProductIdx].quantity - 1,
            };

            localStorage.setItem("basket", JSON.stringify(localBasket));
        } else {
            const localBasketUpd = localBasket.filter((item) => item.guid !== guid);

            localStorage.setItem("basket", JSON.stringify(localBasketUpd));
        }
    }
};

const updateTotalPrice = (guid, price) => {
    let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');

    const quantity = localBasket.find(item => item.guid === guid)?.quantity || 0;
    const total = quantity * price;

    return total.toFixed(2);
};

const inputCount = (guid, count) => {
    let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');

    const curLocalProductIdx = localBasket.findIndex(item => item.guid === guid);

    if (count > 0) {
        localBasket[curLocalProductIdx] = {
            ...localBasket[curLocalProductIdx],
            quantity: count,
        };

        localStorage.setItem("basket", JSON.stringify(localBasket));
    } else {
        const localBasketUpd = localBasket.filter((item) => item.guid !== guid);

        localStorage.setItem("basket", JSON.stringify(localBasketUpd));
    }
};

const getProductCount = (guid) => {
    let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');

    return localBasket.find((item) => item.guid === guid)?.quantity
};

document.addEventListener("DOMContentLoaded", () => {
    const updateBasket = () => {
        const basket = document.getElementById("basket");
        let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');
        const activeItems = localBasket.filter(item => !item.postponed && (item.quantity || 0) > 0);

        if (activeItems.length > 0) {
            basket.setAttribute("data-notice", activeItems.length);
            const img = basket.querySelector('img');
            if (img) {
                img.src = "https://img.icons8.com/fluency-systems-filled/20/shopping-basket--v1.png";
            }
        } else {
            basket.removeAttribute("data-notice");
            const img = basket.querySelector('img');
            if (img) {
                img.src = "https://img.icons8.com/fluency-systems-regular/20/shopping-basket--v1.png";
            }
        }
    };

    updateBasket();

    // Инициализируем индикаторы избранного и сравнения
    if (typeof Favorites !== 'undefined') {
        Favorites.updateIndicators();
    }
    if (typeof Compare !== 'undefined') {
        Compare.updateIndicators();
    }

    // Инициализируем иконки в карточках товаров
    document.querySelectorAll('.product-card').forEach(card => {
        const offerGuid = card.getAttribute('data-offer');
        if (offerGuid) {
            if (typeof Favorites !== 'undefined' && Favorites.has(offerGuid)) {
                Favorites.updateIcon(offerGuid, true);
            }
            if (typeof Compare !== 'undefined' && Compare.has(offerGuid)) {
                Compare.updateIcon(offerGuid, true);
            }
        }
    });

    window.getProductCardsActions = () => {
        console.log('Инициализация обработчиков карточек товаров');
        const cards = document.querySelectorAll(".product-card");
        console.log('Найдено карточек:', cards.length);

        cards.forEach((card, index) => {
            // Проверяем, были ли уже добавлены обработчики к этой карточке
            if (card.hasAttribute('data-handlers-initialized')) {
                console.log(`Карточка ${index} пропущена - обработчики уже инициализированы`);
                return;
            }

            const input = card.querySelector(".qty-input");
            const btnMinus = card.querySelector(".btn-minus");
            const btnPlus = card.querySelector(".btn-plus");
            const offerBtn = card.querySelector(".offer-button");
            const offerCounter = card.querySelector(".offer-counter");
            const totalPrice = card.querySelector(".totalPrice");

            // Проверяем наличие обязательных элементов
            if (!input || !btnMinus || !btnPlus || !offerBtn || !offerCounter) {
                console.warn(`Карточка ${index} пропущена - отсутствуют элементы:`, {
                    hasInput: !!input,
                    hasBtnMinus: !!btnMinus,
                    hasBtnPlus: !!btnPlus,
                    hasOfferBtn: !!offerBtn,
                    hasOfferCounter: !!offerCounter,
                    cardHTML: card.outerHTML.substring(0, 200)
                });
                return;
            }

            const offerGuid = card.getAttribute('data-offer');
            if (!offerGuid) {
                console.warn(`Карточка ${index} пропущена - нет data-offer`, card);
                return;
            }

            // Сначала берем variantGuid из карточки
            let variantGuid = card.getAttribute('data-variant') || '';
            // Если не нашли в карточке, берем из input
            if (!variantGuid && input) {
                variantGuid = input.getAttribute('data-variant') || '';
            }
            const price = parseFloat(card.getAttribute('data-price')) || 0;
            const guid = offerGuid && variantGuid ? `${offerGuid}#${variantGuid}` : offerGuid;

            console.log(`Карточка ${index} обработана:`, { offerGuid, variantGuid, guid, price });

            // Функция для пересчета итого на странице корзины
            const updateBasketTotal = () => {
                const totalElement = document.querySelector('.basket-total');
                const postponedTotalElement = document.querySelector('.postponed-total');
                const deliveryInfo = document.querySelector('.basket-delivery-info');
                const deliveryFree = document.querySelector('.basket-delivery-free');
                const deliveryRemaining = document.querySelector('.delivery-remaining');

                let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');
                let total = 0;
                let postponedTotal = 0;

                // Считаем активные товары (не отложенные)
                localBasket.forEach(item => {
                    if (!item.postponed && (item.quantity || 0) > 0) {
                        // Находим карточку товара на странице для получения цены
                        const cardOfferGuid = item.guid.split('#')[0];
                        const cardVariantGuid = item.guid.split('#')[1] || '';
                        const card = document.querySelector(`.product-card[data-offer="${cardOfferGuid}"][data-variant="${cardVariantGuid}"]`);
                        const cardPrice = card ? parseFloat(card.getAttribute('data-price')) || 0 : 0;
                        total += cardPrice * (item.quantity || 0);
                    } else if (item.postponed && (item.quantity || 0) > 0) {
                        // Считаем отложенные товары
                        const cardOfferGuid = item.guid.split('#')[0];
                        const cardVariantGuid = item.guid.split('#')[1] || '';
                        const card = document.querySelector(`.product-card[data-offer="${cardOfferGuid}"][data-variant="${cardVariantGuid}"]`);
                        const cardPrice = card ? parseFloat(card.getAttribute('data-price')) || 0 : 0;
                        postponedTotal += cardPrice * (item.quantity || 0);
                    }
                });

                // Если не нашли цены через карточки, используем альтернативный метод
                if (total === 0 && postponedTotal === 0) {
                    document.querySelectorAll('.product-card').forEach(card => {
                        const cardOfferGuid = card.getAttribute('data-offer');
                        const cardVariantGuid = card.getAttribute('data-variant') || '';
                        const cardPrice = parseFloat(card.getAttribute('data-price')) || 0;
                        const cardGuid = cardOfferGuid && cardVariantGuid ? `${cardOfferGuid}#${cardVariantGuid}` : cardOfferGuid;

                        let basketItem = localBasket.find(item => item.guid === cardGuid);
                        if (basketItem && !basketItem.postponed && (basketItem.quantity || 0) > 0) {
                            total += cardPrice * basketItem.quantity;
                        } else if (basketItem && basketItem.postponed && (basketItem.quantity || 0) > 0) {
                            postponedTotal += cardPrice * basketItem.quantity;
                        }
                    });
                }

                if (totalElement) {
                    totalElement.textContent = new Intl.NumberFormat('ru-RU').format(total.toFixed(2)) + ' ₽';
                }

                if (postponedTotalElement) {
                    postponedTotalElement.textContent = new Intl.NumberFormat('ru-RU').format(postponedTotal.toFixed(2)) + ' ₽';
                }

                // Пересчитываем сумму до бесплатной доставки
                const deliverySumm = parseFloat(document.querySelector('[data-delivery-summ]')?.getAttribute('data-delivery-summ')) || 10000;
                const remaining = deliverySumm - total;

                if (deliveryInfo && deliveryRemaining) {
                    if (remaining > 0 && total > 0) {
                        deliveryInfo.style.display = 'block';
                        if (deliveryFree) deliveryFree.style.display = 'none';
                        deliveryRemaining.textContent = new Intl.NumberFormat('ru-RU').format(remaining.toFixed(2));
                    } else if (total >= deliverySumm) {
                        deliveryInfo.style.display = 'none';
                        if (deliveryFree) deliveryFree.style.display = 'block';
                    } else {
                        deliveryInfo.style.display = 'none';
                        if (deliveryFree) deliveryFree.style.display = 'none';
                    }
                }
            };

            // Делаем функцию глобальной
            window.updateBasketTotal = updateBasketTotal;

            // Флаг для предотвращения обработки события change при программном изменении
            let isProgrammaticChange = false;

            const startSetting = () => {
                let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');
                const startQuantity = localBasket.find((item) => item.guid === guid)?.quantity || 0;

                isProgrammaticChange = true;
                input.value = startQuantity;
                isProgrammaticChange = false;

                if (startQuantity > 0) {
                    offerBtn.classList.add('d-none');
                    offerCounter.classList.remove('d-none');
                } else {
                    // Если количество 0, показываем кнопку "В корзину"
                    offerBtn.classList.remove('d-none');
                    offerCounter.classList.add('d-none');
                }

                // Обновляем totalPrice только если элемент существует (на странице корзины)
                if (totalPrice) {
                    totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
                }
            };

            startSetting();

            offerBtn.addEventListener("click", () => {
                console.log('Клик по кнопке добавления в корзину', { guid, price, offerGuid, variantGuid });
                offerBtn.classList.add('d-none');
                offerCounter.classList.remove('d-none');

                isProgrammaticChange = true;
                input.value = +input.value + 1;
                isProgrammaticChange = false;

                addToBasket(guid);
                updateBasket();
                console.log('Товар добавлен в корзину', guid);
                if (totalPrice) {
                    totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
                }
                if (typeof window.updateBasketTotal === 'function') {
                    window.updateBasketTotal();
                }
            });

            btnPlus.addEventListener("click", () => {
                isProgrammaticChange = true;
                input.value = +input.value + 1;
                isProgrammaticChange = false;

                addToBasket(guid);
                updateBasket();
                if (totalPrice) {
                    totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
                }
                if (typeof window.updateBasketTotal === 'function') {
                    window.updateBasketTotal();
                }
            });

            btnMinus.addEventListener("click", () => {
                isProgrammaticChange = true;
                if (Number(input.value) > 1) {
                    input.value = +input.value - 1;
                } else {
                    input.value = 0;
                    // Показываем кнопку "В корзину" вместо удаления товара
                    offerBtn.classList.remove('d-none');
                    offerCounter.classList.add('d-none');
                }
                isProgrammaticChange = false;

                deleteFromBasket(guid);
                updateBasket();
                if (totalPrice) {
                    totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
                }
                if (typeof window.updateBasketTotal === 'function') {
                    window.updateBasketTotal();
                }
            });

            input.addEventListener("change", () => {
                // Пропускаем обработку, если изменение было программным
                if (isProgrammaticChange) {
                    return;
                }

                const newQuantity = Number(input.value);

                if (newQuantity === 0) {
                    // Показываем кнопку "В корзину" вместо удаления товара
                    offerBtn.classList.remove('d-none');
                    offerCounter.classList.add('d-none');
                } else {
                    // Если количество больше 0, скрываем кнопку и показываем счетчик
                    offerBtn.classList.add('d-none');
                    offerCounter.classList.remove('d-none');
                }

                inputCount(guid, newQuantity);
                updateBasket();
                if (totalPrice) {
                    totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
                }
                if (typeof window.updateBasketTotal === 'function') {
                    window.updateBasketTotal();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (
                    !e.key.match(/[0-9]/) &&
                    e.key !== 'Backspace' &&
                    e.key !== 'Delete' &&
                    e.key !== 'ArrowLeft' &&
                    e.key !== 'ArrowRight' &&
                    e.key !== 'Tab' &&
                    e.key !== 'Enter'
                ) {
                    e.preventDefault();
                }
            });

            // Отмечаем, что обработчики для этой карточки уже инициализированы
            card.setAttribute('data-handlers-initialized', 'true');
        });
    };

    getProductCardsActions();

    const preorder = document.getElementById('preorder');

    const fetchPreorder = async () => {
        let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');

        // формируем массив промисов
        const requests = localBasket.map(item => {
            const guid = encodeURIComponent(item.guid);

            return fetch('/basket/offerbyorder?guid=' + guid)
                .then(res => res.text());
        });

        // ждём пока ВСЕ фетчи завершатся
        const results = await Promise.all(requests);

        // теперь добавляем их в DOM
        results.forEach(html => {
            preorder.innerHTML += html;
        });

        // и только теперь запускаем обработку карточек
        // getProductCardsActions();
        console.log('1111');
    };

    // запускаем асинхронную загрузку
    // fetchPreorder();

    const ggg = async () => {
        await fetchPreorder();
        getProductCardsActions();
    };

    ggg();

    const clearBtn = document.querySelector('.basket-clear');

    clearBtn.addEventListener('click', () => {
        localStorage.removeItem('basket');
        updateBasket();

        if (preorder) {
            preorder.innerHTML = '';
        }
    });
});
