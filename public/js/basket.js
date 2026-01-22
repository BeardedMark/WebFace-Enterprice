class Basket {
    static getItems() {
        return JSON.parse(localStorage.getItem("basket") || "{}");
    }

    static save(items) {
        localStorage.setItem("basket", JSON.stringify(items));
    }

    static add(offerGuid, variantGuid = null, quantity = 1) {
        let items = this.getItems();
        let key = offerGuid + (variantGuid ? "-" + variantGuid : "");
        if (!items[key]) {
            items[key] = { offerGuid, variantGuid, quantity };
        } else {
            items[key].quantity += quantity;
        }
        this.save(items);
    }

    static update(id, quantity) {
        let items = this.getItems();
        if (items[id]) {
            if (quantity <= 0) {
                delete items[id];
            } else {
                items[id].quantity = quantity;
            }
            this.save(items);
        }
    }

    static remove(id) {
        let items = this.getItems();
        delete items[id];
        this.save(items);
    }

    static clear() {
        localStorage.removeItem("basket");
    }

    static togglePostpone(id) {
        let items = this.getItems();
        if (items[id]) {
            items[id].postponed = !(items[id].postponed || false);
            this.save(items);
        }
    }
}

window.Basket = Basket;

// document.addEventListener("DOMContentLoaded", () => {
//     document.querySelectorAll(".product-card").forEach((card) => {
//         const offerGuid = card.dataset.offer;
//         const variantGuid = card.dataset.variant || null;
//         const input = card.querySelector(".qty-input");
//         const btnMinus = card.querySelector(".btn-minus");
//         const btnPlus = card.querySelector(".btn-plus");

//         // загрузка количества из корзины
//         let basketItems = Basket.getItems();
//         let key = offerGuid + (variantGuid ? "-" + variantGuid : "");
//         if (basketItems[key]) {
//             input.value = basketItems[key].quantity;
//         }

//         // кнопка +
//         // btnPlus.addEventListener("click", () => {
//         //     let qty = parseInt(input.value) || 0;
//         //     qty++;
//         //     input.value = qty;
//         //     Basket.add(offerGuid, variantGuid, 1); // add уже прибавляет
//         // });

//         // кнопка -
//         // btnMinus.addEventListener("click", () => {
//         //     let qty = parseInt(input.value) || 0;
//         //     qty--;
//         //     if (qty <= 0) {
//         //         qty = 0;
//         //         Basket.remove(key);
//         //     } else {
//         //         Basket.update(key, qty);
//         //     }
//         //     input.value = qty;
//         // });

//         // ввод вручную
//         // input.addEventListener("input", () => {
//         //     let qty = parseInt(input.value) || 0;
//         //     if (qty <= 0) {
//         //         input.value = 0;
//         //         Basket.remove(key);
//         //     } else {
//         //         Basket.update(key, qty);
//         //     }
//         // });
//     });
// });
