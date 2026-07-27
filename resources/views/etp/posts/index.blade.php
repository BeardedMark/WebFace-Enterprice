@extends('layouts.container')
@section('title', 'Статьи')
@section('description', 'Блог полезной инофрмаии')
@section('canonical', route('posts.index'))

@section('container-content')
    <x-code :code="compact('posts')" />

    <section class="flex-col-21">
        {{-- <x-breadcrumbs :items="$breadcrumbs" /> --}}

        <x-header tag='h1' size='xxl' color='brand' title="Статьи" description="Блог полезной информации"
            note="{{ count($posts) > 0 ? count($posts) . ' статей' : '' }}" />
    </section>

    @if (count($posts) > 0)
        <section class="row g-2">
            @foreach ($posts as $post)
                <div class="col-12 col-md-3">
                    @component('etp.posts.frames.card', ['post' => $post])
                    @endcomponent
                </div>
            @endforeach
        </section>
    @endif

@endsection
