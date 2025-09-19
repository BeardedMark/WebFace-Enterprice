@if (config('settings.debug.code') && isset($code))
    @dump($code)

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
@endif
