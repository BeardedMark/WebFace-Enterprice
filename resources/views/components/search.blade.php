<form class="input flex-row-5 d-flex" action="{{ $action ?? route('pages.search') }}" method="{{ $method ?? 'POST' }}">
    @csrf

    <div style="position: relative; flex: 1;">
        <input type="text" name="{{ $name ?? 'search' }}" id="{{ $id ?? 'search' }}"
            value="{{ $value ?? old('search') }}" placeholder="{{ $placeholder ?? 'Поиск по сайту' }}"
            autocomplete="search" required>

        <button type="button"
            onclick="
                const input = this.previousElementSibling;
                input.value = '';
                input.focus();
                this.style.display = 'none';
            "
            style="
                display: {{ !empty($value ?? old('search')) ? 'block' : 'none' }};
                position: absolute;
                right: 5px;
                top: 50%;
                transform: translateY(-50%);
                border: 0;
                background: none;
                cursor: pointer;
            ">
            <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/clear-symbol.png" alt="search" />
        </button>
    </div>

    <button type="submit">
        <img width="20" height="20" src="{{ asset('storage/images/icons/search.png') }}" alt="search" />
    </button>
</form>

<script>
    (() => {
        const input = document.getElementById('{{ $id ?? 'search' }}');
        const clear = input.nextElementSibling;

        input.addEventListener('input', () => {
            clear.style.display = input.value ? 'block' : 'none';
        });
    })();
</script>
