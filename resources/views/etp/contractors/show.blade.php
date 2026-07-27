@extends('auth.layouts.sidebar')
@section('title', $contractor['name'])
@section('description', 'Карточка контрагента')
@section('canonical', route('contractors.show', $contractor['guid']))

@section('sidebar-content')
    <x-code :code="compact('contractor')" />

    <div class="flex-col-34">
        <section class="flex-row-8 pad-e-8">
            <div class="flex-col-21 flex-grow">
                <x-breadcrumbs :items="$breadcrumbs" />
                <x-header tag='h1' size='xxl' title="Карточка контрагента" :description="$contractor['name']"/>
            </div>

            <div class="flex-row-5">
                <button onclick="openModal('more')" data-tooltip="Еще" class="icon">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/more.png" alt="more" />
                </button>
            </div>
        </section>

        <div class="flex-col-21 pad-x-13">
            <div class="row">
                <div class="col-auto">
                    <p class="flex-col pad-x-5 font-sm">
                        <span><span class="color-second">КОД:</span> {{ $contractor['code'] }}</span>
                        <span><span class="color-second">ИНН:</span> {{ $contractor['inn'] }}</span>
                        <span><span class="color-second">КПП:</span> {{ $contractor['kpp'] }}</span>
                        <span><span class="color-second">ОГРН(ИП):</span> {{ $contractor['ogrn'] }}</span>
                    </p>
                </div>

                <div class="col">
                    <p class="flex-col-5 pad-x-5 font-sm font-end">
                        @foreach ($contractor['contacts'] as $contact)
                            <span class="flex-col">
                                <span class="color-second">{{ $contact['name'] }}:</span>
                                {{ $contact['value'] }}
                            </span>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        @isset($contractor['manager'])
            <div class="flex-col-21 pad-x-5">
                <h2 class="font-xl font-bold">Персональный менеджер</h2>

                <div class="flex-col-5 pad-x-5">
                    <p class="font-lg">{{ $contractor['manager']['name'] }}</p>
                    <p class="flex-col-5 font-sm">
                        @foreach ($contractor['manager']['contacts'] as $contact)
                            <span class="flex-col">
                                {{ $contact['value'] }}
                            </span>
                        @endforeach
                    </p>
                </div>

            </div>
        @endisset
    </div>
@endsection
