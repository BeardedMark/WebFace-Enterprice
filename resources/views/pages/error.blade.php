@extends('layouts.container')
@section('title', 'Ошибка 1С')
@section('description', 'Ошибка ответа от 1С')
{{-- @section('canonical', route('pages.error')) --}}

@section('container-content')
    <section class="flex-col-34">
        <x-header tag='h1' size='xxl' title="Ошибка ответа от 1С"
            description="При обращении к базе возникли ошибки!" />

        <div class="row">
            <div class="col">
                <div class="flex-col-5">

                    <label class="pad-x-5 color-second">Адрес запроса:</label>
                    <input class="input" type="text" name="resource" id="resource" value="{{ $url }}"
                        placeholder="Resource">

                    <label class="pad-x-5 color-second">Параметры запроса:</label>
                    <div class="flex-col">
                        <div class="bord-rad-5 pad-13 bord-other">
                            <p>{{ mb_strtoupper($method) }}</p>
                            <pre><code>{{ htmlspecialchars_decode(json_encode($request, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-5 offset-1">
                <div class="flex-col-21 ai-center jc-center">
                    <img width="128" height="128" src="https://img.icons8.com/fluency-systems-regular/128/error.png"
                        alt="web-globe" />
                    <span class="color-danger font-bold font-lg">{{ $code }}</span>
                </div>
                <iframe srcdoc='{{ $response }}' class="w-100 h-100"></iframe>
            </div>
        </div>
    </section>
@endsection
