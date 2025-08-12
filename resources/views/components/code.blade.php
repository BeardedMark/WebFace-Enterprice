@if(env('APP_DEBUG') && isset($code))
    {{-- <details class="flex-col-5" style="">
        <summary class="item-other">Json content ({{ count($code) }})</summary> --}}
    <div class="flex-col">
        @foreach ($code as $key => $value)
            @php
                $count = is_iterable($value) ? count((array) $value) : 0;
                $isArray = is_array($value) && array_keys($value) === range(0, $count - 1);
                $brackets = $isArray ? "[{$count}]" : "";
            @endphp

            <details class="flex-col-5">
                <summary class="item-other font-sm">
                    {{ $key }} {{ $brackets }}
                </summary>
                <pre><code>{{ htmlspecialchars_decode(json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</code></pre>
            </details>
        @endforeach
    </div>
    {{-- </details> --}}
@endif
