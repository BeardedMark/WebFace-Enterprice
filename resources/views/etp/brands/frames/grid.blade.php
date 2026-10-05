<section class="row g-2">
    @foreach ($brands as $brand)
        <div class="col-12 col-md-6 col-lg-2">
            @component('enterprise.brands.frames.card', ['brand' => $brand])
            @endcomponent
        </div>
    @endforeach
</section>
