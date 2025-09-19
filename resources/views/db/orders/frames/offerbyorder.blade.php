{{-- <div class="cut mar-x-5"></div> --}}

<div class="flex-row-13 ai-center">
    <a href="{{ route('offers.show', $item['offer']['guid']) }}" onclick="showPreloader()"
        class="flex-center bord-other bord-rad-5 back-light pad-3" style="width: 64px; height: 64px;">
        @empty($item['offer']['imageGuid'])
            <img class="lock" src="https://img.icons8.com/fluency-systems-regular/EFEDEB/48/no-image.png" alt="no-image">
        @else
            <img class="lock"
                src="{{ config('enterprice.base_url') }}Extensions/Image/get?guid={{ $item['offer']['imageGuid'] }}"
                alt="{{ $item['offer']['imageGuid'] }}">
        @endempty
    </a>

    <div class="flex-col flex-grow pad-x-5">
        <a class="link flex-col" href="{{ route('offers.show', $item['offerGuid']) }}">
            {{ $item['offer']['name'] }}
            @isset($item['variant'])
                <span class="font-sm color-second">{{ $item['variant']['name'] }}</span>
            @endisset
        </a>
    </div>

    <p class="font-bold"><x-number :value="$item['variant'] ? $item['variant']['price'] : $item['offer']['maxPrice']" /> ₽</p>

    <div class="flex-row-5">
        <form action="{{ route('basket.update', $key) }}" method="POST" class="flex-row-5 ai-center">
            @csrf
            <input type="number" data-tooltip="{{ $item['offer']['unit'] }}" name="quantity"
                value="{{ $item['quantity'] }}" min="1" class="input font-center" style="width: 80px;">
            {{-- <button class="button-other font-sm" data-tooltip="Сохранить" type="submit">Обновить</button> --}}
        </form>

        <form action="{{ route('basket.postpone', $key) }}" method="POST">
            @csrf
            <button class="icon" type="submit"
                data-tooltip="{{ !empty($item['postponed']) && $item['postponed'] ? 'К закзку' : 'Отложить' }}"onclick="showPreloader()">

                @if (!empty($item['postponed']) && $item['postponed'])
                    <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/up.png"
                        alt="Удалить" />
                @else
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/down--v1.png" alt="Удалить" />
                @endif
            </button>
        </form>

        <form action="{{ route('basket.remove', $key) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="icon" data-tooltip="Удалить из корзины" type="submit"onclick="showPreloader()">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/cancel.png"
                    alt="Удалить" />
            </button>
        </form>
    </div>
</div>
