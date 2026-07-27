@extends('auth.layouts.sidebar')
@section('title', 'История заказов')
@section('description', 'Список созданных заказов покупателя')
@section('canonical', route('contractors.orders'))

@section('sidebar-content')
    <x-code :code="compact('contractors', 'orders')" />

    <div class="flex-col-34">
        <div class="flex-col-21 flex-grow">
            <x-breadcrumbs :items="$breadcrumbs" />
            <x-header tag='h1' size='xxl' title="История заказов"  description="Список ваших заказов покупателя"/>
        </div>

        <form method="GET" action="{{ route('contractors.orders') }}" class="flex-col-5 pad-x-8">
            <select class="input" name="contractor" onchange="this.form.submit()">
                <option value="">Выберите контрагента</option>
                @foreach ($contractors as $contractor)
                    <option value="{{ $contractor['guid'] }}"
                        {{ request('contractor') == $contractor['guid'] ? 'selected' : '' }}>{{ $contractor['name'] }}
                    </option>
                @endforeach
            </select>

            {{-- если у тебя в запросе есть еще параметры (например, page, search), их надо сохранить --}}
            @foreach (request()->except('contractor') as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            <button class="d-none" type="submit" class="btn">Найти</button>
        </form>


        @if (count($orders) > 0)
            <div class="pad-x-13">
                <div class="flex-col-5 pad-x-5">
                    @for ($i = 0; $i < count($orders); $i++)
                        @if ($i > 0)
                            <div class="cut"></div>
                        @endif

                        <p class="row ai-center">
                            <a class="link col-4" href="{{ route('orders.show', $orders[$i]['guid']) }}">
                                № {{ $orders[$i]['number'] }}</a>
                            <span class="col-4 font-sm color-second">
                                {{ $orders[$i]['status'] }}</span>
                            <span class="col-2 font-sm font-end color-second">
                                <x-number :value="$orders[$i]['itemsCount']" /> тов.</span>
                            <span class="col-2 font-sm font-end">
                                <x-number :value="$orders[$i]['amount']" /> ₽</span>
                        </p>
                    @endfor
                </div>
            </div>
        @endif
    </div>
@endsection
