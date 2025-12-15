class Favorites {
    static key = 'favorites';

    static getItems() {
        return JSON.parse(localStorage.getItem(this.key) || '[]');
    }

    static save(items) {
        localStorage.setItem(this.key, JSON.stringify(items));
    }

    static toggle(guid) {
        let items = this.getItems();
        if (items.includes(guid)) {
            items = items.filter(id => id !== guid);
        } else {
            items.push(guid);
        }
        this.save(items);
    }

    static has(guid) {
        return this.getItems().includes(guid);
    }

    static clear() {
        localStorage.removeItem(this.key);
    }
}
window.Favorites = Favorites;
