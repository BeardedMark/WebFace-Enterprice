@extends('layouts.container')

@section('container-content')
    <section class="flex-col-34">
        <div class="flex-col-5">
            <h1 class="font-xxl font-bold">{{ $item['Ref_Key'] }}</h1>
        </div>

        <x-code :code="compact('item')" />
    </section>
@endsection
