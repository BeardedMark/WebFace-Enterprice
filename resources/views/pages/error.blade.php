@extends('layouts.container')
@section('title', 'Ошибка 1С')

@section('container-content')
    <div class="row">
        <div class="col">
            <section class="flex-col-34">
                <div class="flex-col-5 pad-x-5">
                    <h1 class="font-xxl font-bold">Ошибка ответа от 1С</h1>
                    <p class="font-lg">При обращении к базе возникли ошибки</p>
                </div>
                <iframe srcdoc='{{ $response }}' class="bord-rad-5 bord-other pad-x-5"></iframe>

                <div class="flex-col-5">

                    <input class="input" type="text" name="resource" id="resource" value="{{ $url }}"
                        placeholder="Resource">
                    <div class="flex-col">
                        <div class="bord-rad-5 pad-13 bord-other">
                            <p>{{ mb_strtoupper($method) }}</p>
                            <pre><code>{{ htmlspecialchars_decode(json_encode($request, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</code></pre>
                        </div>
                    </div>
                </div>

            </section>
        </div>

        <div class="col col-4 offset-1">
            <div class="flex-col-21 ai-center jc-center">
                <img width="128" height="128" src="https://img.icons8.com/fluency-systems-regular/128/error.png"
                    alt="web-globe" />

                <p class="flex-col bord-rad-5 pad-13 bord-danger">
                    <span class="color-danger">Код ошибки {{ $code }}</span>
                    <span class="color-second">{{ $message }}</span>
                </p>
            </div>
        </div>
    </div>
@endsection
