<div class="cut"></div>

<div class="flex-row-13 ai-center">
    <div class="flex-col flex-grow">
        <a class="link flex-col" href="{{ route('offers.show', $item['offerGuid']) }}">
            {{ $item['offer']['name'] }}
            <span class="font-sm">{{ $item['variantGuid'] }}</span>
        </a>
    </div>
    <p class="font-bold">{{ $item['offer']['price'] }} ₽</p>

    <form action="{{ route('basket.postpone', $key) }}" method="POST">
        @csrf
        <button class="button-other font-sm" type="submit">
            {{-- {{ !empty($item['postponed']) && $item['postponed'] ? 'К закзку' : 'Отложить' }} --}}
            @if (!empty($item['postponed']) && $item['postponed'])
                <img width="20" height="20"
                    src="https://img.icons8.com/fluency-systems-regular/20/delete-sign--v1.png" alt="Удалить" />
            @else
                <img width="20" height="20"
                    src="https://img.icons8.com/fluency-systems-regular/20/delete-sign--v1.png" alt="Удалить" />
            @endif
        </button>
    </form>

    <form action="{{ route('basket.update', $key) }}" method="POST" class="flex-row-5 ai-center">
        @csrf
        <input type="number" data-tooltip="{{ $item['offer']['unit'] }}" name="quantity"
            value="{{ $item['quantity'] }}" min="1" class="input font-center" style="width: 80px;">
        <button class="button-other font-sm" data-tooltip="Сохранить" type="submit">Обновить</button>
    </form>

    <form action="{{ route('basket.remove', $key) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="icon" data-tooltip="Удалить из корзины" type="submit">
            <img width="20" height="20"
                src="https://img.icons8.com/fluency-systems-regular/20/delete-sign--v1.png" alt="Удалить" />
        </button>
    </form>
</div>
