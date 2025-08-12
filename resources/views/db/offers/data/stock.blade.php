@if (isset($totalStock) && $totalStock > 0)
    @if ($freeStock <= 0)
        Нет в наличии
    @elseif ($freeStock <= 1)
        Мало
    @else
        {{ $freeStock ?? '' }}
    @endif

    {{ $unit ?? '' }}
@else
    Под заказ
@endif
