@extends('layouts.container')

@section('container-content')
    <div class="row">
        <div class="col">
            <section class="flex-col-34">
                <div class="flex-col-5">
                    <h1 class="font-xxl font-bold">{{ $entity->getName() }}</h1>
                    <p class="font-lg">{{ $entity->getType() }}</p>
                    <p class="font-md">{{ $entity->code }}</p>
                </div>

                <div class="flex-col">
                    @foreach ($items as $item)
                        <a class="link" href="{{ route('odata.show', [$entity->code, $item['Ref_Key'] ?? $item['id']]) }}">
                            {{ $item['Description'] ?? 'Nsme' }}</a>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
