@extends('layouts.container')

@section('container-content')
    <div class="row">
        <div class="col">
            <div class="flex-col-13">
                <div class="flex-col-5 pad-x-5">
                    <h1 class="font-xxl font-bold">API Расширение для 1С</h1>
                    <p class="font-lg">Кастомные методы web-публикации базы</p>
                    <p class="font-md">Статический список API методов. Добавляется путем установки и включения расширения в конфигурацию 1С Предприятия</p>
                </div>

                <div class="flex-col-8">
                    @foreach ($methods as $method)
                        <div class="flex-col-8 frame-other pad-13">
                            <p class="flex-row-8">
                                <span class="flex-grow">{{ $method['name'] }}</span>
                                <span class="color-second">{{ $method['path'] }}</span>
                                <span>{{ $method['method'] }}</span>
                            </p>

                            <ul class="pad-x-8">
                                @foreach ($method['params'] as $param)
                                    <li class="flex-row-8">
                                        <span class="flex-row-8 flex-grow">
                                            <span class="color-second">{{ $param['type'] }}</span>


                                            <span>{{ $param['name'] }}</span>

                                            @isset($param['default'])
                                                <span class="color-second"> = {{ $param['default'] }}</span>
                                            @endisset
                                        </span>

                                        @isset($param['description'])
                                            <span class="font-sm color-second">{{ $param['description'] }}</span>
                                        @endisset
                                    </li>
                                @endforeach
                            </ul>

                            @isset($method['return'])
                                <ul class="pad-x-8">
                                    @foreach ($method['return'] as $return)
                                        <li>
                                            <span class="color-second">{{ $return['type'] }}</span>
                                            {{ $return['name'] }}

                                            @isset($return['default'])
                                                <span class="color-second"> = {{ $return['default'] }}</span>
                                            @endisset

                                            @isset($return['description'])
                                                <span class="font-sm color-second"> - {{ $return['description'] }}</span>
                                            @endisset
                                        </li>
                                    @endforeach
                                </ul>
                            @endisset
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col col-4 offset-1">
                <div class="flex-col-13">
                    <div class="flex-col-5 pad-x-5">
                        <h2 class="font-xl font-bold">Web-формы</h2>
                        <p class="font-md">Типовое отображение работы методов</p>
                        <p class="font-sm">Готовые формы которые отражают результат работы методов</p>
                    </div>

                    <div class="flex-col-5">
                        <a class="item-other" href="{{ route('catalogs.index') }}">Каталоги</a>
                        <a class="item-other" href="{{ route('offers.index') }}">Номенклатура</a>
                        <a class="item-other" href="{{ route('contractors.index') }}">Контрагенты</a>
                    </div>
                </div>
        </div>
    </div>
@endsection
