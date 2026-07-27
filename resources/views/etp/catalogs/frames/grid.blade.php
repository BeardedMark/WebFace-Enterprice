
<div class="row g-2">
    @foreach ($catalogs as $catalogItem)
        <div class="col-12 col-md-6 col-lg-3">
            @component('etp.catalogs.frames.card', ['catalog' => $catalogItem])
            @endcomponent
        </div>
    @endforeach
</div>
