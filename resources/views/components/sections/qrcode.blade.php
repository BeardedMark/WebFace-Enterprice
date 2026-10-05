<section class="row g-4">
    <div class="col">
        <div class="flex-col-34 pad-x-5">
            <x-header tag='h2' size='xl' color='brand' :title="$section['title']" :description="$section['description']" />

            <div class="flex-col-21">
                <p class="flex-col-5 pad-x-13">
                    @isset($baseData['email'])
                        <span class="font-lg">{{ $baseData['email'] }}</span>
                    @endisset

                    @isset($baseData['phone'])
                        <span class="font-lg">{{ $baseData['phone'] }}</span>
                    @endisset
                </p>

                <p class="flex-col pad-x-13">
                    @isset($baseData['address'])
                        <span class="font-sm">{{ $baseData['address'] }}</span>
                    @endisset
                </p>


                <div class="flex-row-5 d-print-none pad-x-8">
                    @foreach ($baseData['socialLinks'] as $link)
                        <x-linkicon href="{{ $link['url'] }}">{{ $link['title'] }}</x-linkicon>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col col-4 col-md-6 offset-md-1">
        <div class="flex-col-34 ai-center jc-center">
            <img class="bord-rad-13 back-light shadow-real"
                src="{{ route('images.qrcode', [
                    'data' => $baseData,
                ]) }}">
        </div>
    </div>
</section>
