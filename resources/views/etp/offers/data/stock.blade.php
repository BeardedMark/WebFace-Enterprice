@if (isset($totalStock) && $totalStock > 0)
    <x-number :value="$freeStock" />

    {{ $unit ?? '' }}
@else
    Под заказ
@endif
