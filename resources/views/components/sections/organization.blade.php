<section class="row g-4">
    <div class="col">
        <div class="flex-col-13">
            <x-header tag='h2' size='xl' color='brand' :title="$section['title']" :description="$section['description']" />

            @foreach ($section['organizations'] as $organization)
                @component('enterprise.organizations.components.card', compact('organization'))
                @endcomponent
            @endforeach
        </div>
    </div>

    {{-- @isset($page['manager']['name'])
        <div class="col col-4 col-md-6 offset-md-1">
            <div class="flex-col-13 ai-center jc-center">
                <x-header tag='h3' size='lg' color='brand' title="Контактное лицо" />

                <p class="flex-col font-center d-print-none">
                    <span class="font-lg">{{ $page['manager']['name'] }}</span>
                    <span class="font-sm color-second">Отсканируйте код с помощью телефона</span>
                </p>
            </div>
        </div>
    @endisset --}}
</section>
