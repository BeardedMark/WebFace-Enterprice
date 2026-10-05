
<section class="row g-4 d-print-none">
    <div class="col-12">
        <div class="flex-col-34">
            <x-header tag='h2' size='xl' color='brand' title="Мы на карте"
                description="Где фактически мы находимся" :note="$baseData['address']" />

            <iframe class="bord-rad-13 back-other bord-other w-100" height="500" loading="lazy" allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q={{ $baseData['address'] }}<&output=embed">
            </iframe>

        </div>
    </div>
</section>
