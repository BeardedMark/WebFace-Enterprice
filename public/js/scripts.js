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

        if (localBasket.length > 0) {
            basket.setAttribute("data-notice", localBasket.length);
        } else {
            basket.removeAttribute("data-notice");
        }
    };

    updateBasket();

    const getProductCardsActions = () => {
        console.log('2222');
        document.querySelectorAll(".product-card").forEach((card) => {
            const input = card.querySelector(".qty-input");
            const btnMinus = card.querySelector(".btn-minus");
            const btnPlus = card.querySelector(".btn-plus");
            const offerBtn = card.querySelector(".offer-button");
            const offerCounter = card.querySelector(".offer-counter");
            const totalPrice = card.querySelector(".totalPrice");

            const offerGuid = card.getAttribute('data-offer');
            const variantGuid = card.getAttribute('data-variant');
            const price = card.getAttribute('data-price');
            const guid = offerGuid && variantGuid ? `${offerGuid}#${variantGuid}` : offerGuid;

            const startSetting = () => {
                let localBasket = JSON.parse(localStorage.getItem('basket') || '[]');
                const startQuantity = localBasket.find((item) => item.guid === guid)?.quantity || 0;
                input.value = startQuantity;

                if (startQuantity > 0) {
                    offerBtn.classList.add('d-none');
                    offerCounter.classList.remove('d-none');
                }

                totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
            };

            console.log(card);

            startSetting();

            offerBtn.addEventListener("click", () => {
                offerBtn.classList.add('d-none');
                offerCounter.classList.remove('d-none');

                input.value = +input.value + 1;
                addToBasket(guid);
                updateBasket();
                totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
            });

            btnPlus.addEventListener("click", () => {
                input.value = +input.value + 1;
                addToBasket(guid);
                updateBasket();
                totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
            });

            btnMinus.addEventListener("click", () => {
                if (Number(input.value) > 1) {
                    input.value = +input.value - 1;
                } else {
                    input.value = 0;
                    offerBtn.classList.remove('d-none');
                    offerCounter.classList.add('d-none');
                }

                deleteFromBasket(guid);
                updateBasket();
                totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
            });

            input.addEventListener("change", () => {
                if (Number(input.value) === 0) {
                    offerBtn.classList.remove('d-none');
                    offerCounter.classList.add('d-none');
                }

                inputCount(guid, Number(input.value));
                updateBasket();
                totalPrice.innerHTML = `${updateTotalPrice(guid, price)} ₽`;
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
