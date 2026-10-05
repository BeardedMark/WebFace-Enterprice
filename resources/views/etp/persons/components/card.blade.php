<div class="back-light bord-other bord-rad-13 flex-col-13 flex-grow pad-13 h-100">
    <div class="flex-row-8 ai-start">
        @if (!empty($person['photoGuid']))
            <img width="48" height="48" class="bord-rad-5 lock"
                src="{{ route('images.proxy', ['type' => 'file', 'guid' => $person['photoGuid']]) }}"
                alt="{{ $person['name'] ?? '' }}" />
        @elseif (!empty($person['imageGuid']))
            <img width="48" height="48" class="bord-rad-5 lock"
                src="{{ route('images.proxy', ['type' => 'file', 'guid' => $person['imageGuid']]) }}"
                alt="{{ $person['name'] ?? '' }}" />
        @endif

        <div class="flex-col-8 flex-grow">
            @isset($person['name'])
                <h3 class="font-lg">{{ $person['name'] }}</h3>
            @endisset

            @if (!empty($person['position']))
                <p class="font-sm color-second">{{ $person['position'] }}</p>
            @elseif (!empty($person['description']))
                <p class="font-sm color-second">{{ $person['description'] }}</p>
            @endif

            @if (!empty($person['contacts']))
                <p class="flex-col-5 font-md">
                    @foreach ($person['contacts'] as $contact)
                        @php
                            $value = $contact['value'] ?? '';
                            $label = $contact['name'] ?? null;
                            $type = strtolower($contact['type'] ?? '');
                        @endphp

                        <span class="flex-col">
                            @if ($label)
                                <span class="font-sm color-second">{{ $label }}</span>
                            @endif

                            @if ($value !== '' && (str_contains($type, 'mail') || str_contains($value, '@')))
                                <a class="link" href="mailto:{{ $value }}">{{ $value }}</a>
                            @elseif ($value !== '' && (str_contains($type, 'tel') || str_contains($type, 'phone')))
                                <a class="link" href="tel:{{ $value }}">{{ $value }}</a>
                            @elseif ($value !== '')
                                <span>{{ $value }}</span>
                            @endif
                        </span>
                    @endforeach
                </p>
            @endif

            @isset($person['inn'])
                <p class="font-sm color-second">
                    <span>ИНН: {{ $person['inn'] }}</span>
                </p>
            @endisset
        </div>

        <button onclick="openModal('qrcode-{{ $person['guid'] }}')" class="icon" data-tooltip="QR-Код"
            href="{{ route('auth.login') }}">
            <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/qr-code.png"
                alt="enter-2" />
        </button>
    </div>
</div>

<x-modal name="qrcode-{{ $person['guid'] }}" title="Добавить в контакты">
    <div class="flex-row-13">

        <div class="flex-col-8 flex-grow">
            @isset($person['name'])
                <h3 class="font-lg">{{ $person['name'] }}</h3>
            @endisset

            @if (!empty($person['position']))
                <p class="font-sm color-second">{{ $person['position'] }}</p>
            @elseif (!empty($person['description']))
                <p class="font-sm color-second">{{ $person['description'] }}</p>
            @endif

            <span class="font-sm color-second">Отсканируйте код с помощью телефона</span>
        </div>

        <img width="200px" height="200px"
            src="{{ route('images.qrcode', [
                'data' => $person,
            ]) }}">
    </div>
</x-modal>
