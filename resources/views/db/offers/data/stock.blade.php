@if (isset($totalStock) && $totalStock > 0)
    @if ($freeStock <= 10)
        Мало
    @else
        <x-number :value="$freeStock" />
    @endif

    {{ $unit ?? '' }}
@else
    Под заказ
@endif
