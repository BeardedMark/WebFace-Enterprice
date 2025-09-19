<h1>Новый заказ покупателя</h1>

<p>
    <b>Имя:</b> {{ $params['name'] ?? '—' }}<br>
    <b>Телефон:</b> {{ $params['phone'] ?? '—' }}<br>
    <b>Email:</b> {{ $params['email'] ?? '—' }}<br>
    <b>ИНН:</b> {{ $params['inn'] ?? '—' }}<br>
</p>

<p>
    @isset($params['addres'])
        <b>Адрес доставки:</b> {{ $params['addres'] ?? '—' }}<br>
    @endisset

    @isset($params['date'])
        <b>Дата доставки:</b> {{ $params['date'] ?? '—' }}<br>
    @endisset

    @if ($params['fromTime'] || $params['toTime'])
        <b>Время доставки:</b> с {{ $params['fromTime'] ?? '—' }} по {{ $params['toTime'] ?? '—' }}<br>
    @endif
</p>

@isset($params['commentary'])
    <p><b>Комментарий: </b>{{ $params['commentary'] ?? '—' }}</p>
@endisset

<p>
    <b>Итого:
        {{ number_format(collect($params['items'])->sum(fn($i) => $i['count'] * $i['price']), 2, '.', ' ') }} ₽</b>
</p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Товар</th>
            <th>Кол-во</th>
            <th>Цена</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($params['items'] as $item)
            <tr>
                <td><a href="{{ route('offers.show', $item['guidOffer']) }}">
                        {{ $item['guidOffer'] }}
                        @isset($item['guidVariant'])
                            <br><small>{{ $item['guidVariant'] }}</small>
                        @endisset
                    </a>
                </td>

                <td><x-number :value="$item['count']" /> {{ $item['unit'] ?? 'ед' }}</td>
                <td><b><x-number :value="$item['price']" /> ₽</b></td>
            </tr>
        @endforeach
    </tbody>
</table>
