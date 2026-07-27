@if (config('settings.debug.code') && isset($code))
    <button onclick="openModal('devtools')" data-tooltip="DevTools" class="icon">
        <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/source-code.png"
            alt="more" />
    </button>

    {{-- <div class="bord-rad-8 over-hide">
        @dump($code)
    </div> --}}

    {{-- <div class="flex-col back-main color-prime bord-rad-5 pad-13">
        @foreach ($code as $key => $value)
            @php
                $count = is_iterable($value) ? count((array) $value) : 0;
            @endphp

            <details>
                <summary class="font-sm">
                    {{ $key }} ({{ $count }})
                </summary>
                <pre><code>{{ htmlspecialchars_decode(json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</code></pre>
            </details>
        @endforeach
    </div> --}}

    <x-modal name="devtools" title="Инструменты разработчика">
        <div class="bord-rad-5 over-hide">
            @dump($code)
        </div>
    </x-modal>
@endif
