class Compare {
    static key = 'compare';

    static getItems() {
        return JSON.parse(localStorage.getItem(this.key) || '[]');
    }

    static save(items) {
        localStorage.setItem(this.key, JSON.stringify(items));
        this.updateIndicators();
    }

    static toggle(guid, event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        let items = this.getItems();
        const isCompared = items.includes(guid);
        if (isCompared) {
            items = items.filter(id => id !== guid);
        } else {
            items.push(guid);
        }
        this.save(items);
        this.updateIcon(guid, !isCompared);
    }

    static has(guid) {
        return this.getItems().includes(guid);
    }

    static clear() {
        localStorage.removeItem(this.key);
        this.updateIndicators();
    }

    static updateIcon(guid, isCompared) {
        // Обновляем иконку в карточке товара
        const iconSpan = document.getElementById('cmp-' + guid);
        if (iconSpan) {
            const icon = iconSpan.querySelector('img');
            if (icon) {
                icon.src = `https://img.icons8.com/fluency-systems-${isCompared ? 'filled' : 'regular'}/20/similar-items.png`;
            }
        }
        // Обновляем класс кнопки
        const button = iconSpan?.closest('button');
        if (button) {
            if (isCompared) {
                button.classList.remove('icon');
                button.classList.add('icon-second');
            } else {
                button.classList.remove('icon-second');
                button.classList.add('icon');
            }
        }
    }

    static updateIndicators() {
        // Обновляем индикатор в хедере
        const headerIcon = document.getElementById('header-compare');
        if (headerIcon) {
            const items = this.getItems();
            const img = headerIcon.querySelector('img');
            if (img) {
                img.src = `https://img.icons8.com/fluency-systems-${items.length > 0 ? 'filled' : 'regular'}/20/similar-items.png`;
            }
            if (items.length > 0) {
                headerIcon.setAttribute('data-notice', items.length);
            } else {
                headerIcon.removeAttribute('data-notice');
            }
        }
    }
}
window.Compare = Compare;
