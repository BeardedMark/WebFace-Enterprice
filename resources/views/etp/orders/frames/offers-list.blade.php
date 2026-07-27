<div class="flex-col-5">
    @for ($i = 0; $i < count($offers); $i++)
        @if ($i > 0)
            <div class="cut"></div>
        @endif

        @component('etp.orders.frames.offer-by-order', ['offer' => $offers[$i]])
        @endcomponent
    @endfor
</div>
