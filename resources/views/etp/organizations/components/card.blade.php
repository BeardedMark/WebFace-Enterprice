<div class="back-light bord-other bord-rad-13 flex-col-13 flex-grow pad-13 h-100">
    <div class="flex-row-8 ai-start">
        @if (!empty($organization['logoGuid']))
            <img width="48" height="48" class="bord-rad-5 lock"
                src="{{ route('images.proxy', ['type' => 'file', 'guid' => $organization['logoGuid']]) }}"
                alt="{{ $organization['name'] ?? '' }}" />
        @endif

        <div class="flex-col-8 flex-grow">
            @isset($organization['name'])
                <h3 class="font-lg">{{ $organization['name'] }}</h3>
            @endisset

            @if (!empty($organization['email']) || !empty($organization['phone']))
                <p class="flex-col-5 font-md">
                    @isset($organization['email'])
                        <a class="link" href="mailto:{{ $organization['email'] }}">{{ $organization['email'] }}</a>
                    @endisset

                    @isset($organization['phone'])
                        <a class="link" href="tel:{{ $organization['phone'] }}">{{ $organization['phone'] }}</a>
                    @endisset
                </p>
            @endif

            @if (
                !empty($organization['inn']) ||
                    !empty($organization['ogrn']) ||
                    !empty($organization['kpp']) ||
                    !empty($organization['okpo']))
                <p class="flex-col font-sm color-second">
                    @isset($organization['inn'])
                        <span>ИНН: {{ $organization['inn'] }}</span>
                    @endisset

                    @isset($organization['ogrn'])
                        <span>ОГРН: {{ $organization['ogrn'] }}</span>
                    @endisset

                    @isset($organization['kpp'])
                        <span>КПП: {{ $organization['kpp'] }}</span>
                    @endisset

                    @isset($organization['okpo'])
                        <span>ОКПО: {{ $organization['okpo'] }}</span>
                    @endisset
                </p>
            @endif

            @isset($organization['legalAddress'])
                <p class="font-sm color-second">
                    <span>Юр. адрес: {{ $organization['legalAddress'] }}</span>
                </p>
            @endisset
        </div>

        <button onclick="openModal('qr-{{ $organization['inn'] }}')" class="icon" data-tooltip="QR-Код"
            href="{{ route('auth.login') }}">
            <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/qr-code.png"
                alt="enter-2" />
        </button>
    </div>
</div>

<x-modal name="qr-{{ $organization['inn'] }}" title="Добавить в контакты">
    <div class="flex-row-13">

        <div class="flex-col-8 flex-grow">
            @isset($organization['name'])
                <h3 class="font-lg">{{ $organization['name'] }}</h3>
            @endisset

            @if (!empty($organization['position']))
                <p class="font-sm color-second">{{ $organization['position'] }}</p>
            @elseif (!empty($organization['description']))
                <p class="font-sm color-second">{{ $organization['description'] }}</p>
            @endif

            <span class="font-sm color-second">Отсканируйте код с помощью телефона</span>
        </div>

        <img src="{{ route('images.qrcode', [
            'data' => $organization,
        ]) }}">
    </div>
</x-modal>
