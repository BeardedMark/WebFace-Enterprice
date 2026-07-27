@php
    // Определяем, показывать ли счетчик по умолчанию (для корзины)
    $showCounter = isset($showCounter) ? $showCounter : false;
    $initialQuantity = isset($initialQuantity) ? $initialQuantity : 0;
@endphp

<div class="flex-row-5 offer-counter {{ $showCounter ? '' : 'd-none' }}">
    <button class="btn-minus icon-other font-md font-bold">–</button>
    <input type="number" name="qty" class="qty-input input font-center pad-5" value="{{ $initialQuantity }}" min="0" style="width: 80px" data-tooltip="{{ $offerGuid }}" data-variant="{{ $variantGuid ?? '' }}">
    <button class="btn-plus icon-other font-md font-bold">+</button>
</div>

<button class="icon-main offer-button {{ $showCounter ? 'd-none' : '' }}" data-tooltip="В корзину" type="button">
    <img width="20" height="20" class="lock" src="https://img.icons8.com/fluency-systems-filled/FCFBFB/20/buy--v1.png"
        alt="buy--v1" />

</button>
