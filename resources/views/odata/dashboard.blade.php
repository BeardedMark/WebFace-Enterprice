@extends('layouts.container')

@section('container-content')
    <div class="row">
        <div class="col">
            <section class="flex-col-34">
                <div class="flex-col-5 pad-x-5">
                    <h1 class="font-xxl font-bold">OData Публикации</h1>
                    <p class="font-lg">Типовой инструмент обращения к данным</p>
                    <p class="font-md">Динамичный список сырых данных. Доступ настраивается на стороне 1С путем
                        включения публикаций</p>
                    <p class="font-sm color-second">Опубликовано объектов конфигурации: {{ count($entities) }}</p>
                </div>

                <div class="flex-col-5 pad-x-5">
                    @foreach ($entities as $entity)
                        <div class="cut"></div>
                        <p class="flex-row-8 ai-center">
                            <a class="link flex-grow" href="{{ route('odata.index', $entity->url) }}">{{ $entity->getName() }}</a>

                            <span class="color-second">{{ $entity->getType() }}</span>
                        </p>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
