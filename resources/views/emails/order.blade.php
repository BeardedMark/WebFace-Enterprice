<h1>Новый заказ покупателя</h1>

<p>
    <b>Имя:</b> {{ $params['name'] ?? '—' }}<br>
    <b>Телефон:</b> {{ $params['phone'] ?? '—' }}<br>
    <b>Email:</b> {{ $params['email'] ?? '—' }}<br>
    @if (!empty($params['inn']))
        <b>ИНН:</b> {{ $params['inn'] }}<br>
    @endif
</p>

<p>
    <b>Способ получения:</b> {{ $params['deliveryType'] === 'delivery' ? 'Доставка' : 'Самовывоз' }}<br>

    @if ($params['deliveryType'] === 'delivery')
        @if (!empty($params['address']))
            <b>Адрес доставки:</b> {{ $params['addres'] }}<br>
        @endif

        @if (!empty($params['date']))
            <b>Дата доставки:</b> {{ $params['date'] }}<br>
        @endif

        @if (!empty($params['fromTime']) || !empty($params['toTime']))
            <b>Время доставки:</b>
            @if (!empty($params['fromTime']) && !empty($params['toTime']))
                с {{ $params['fromTime'] }} по {{ $params['toTime'] }}
            @elseif (!empty($params['fromTime']))
                с {{ $params['fromTime'] }}
            @elseif (!empty($params['toTime']))
                до {{ $params['toTime'] }}
            @endif
            <br>
        @endif
    @endif
</p>

@if (!empty($params['commentary']))
    <p><b>Комментарий:</b> {{ $params['commentary'] }}</p>
@endif

<h2>Состав заказа:</h2>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f5f5f5;">
            <th style="text-align: left; padding: 8px; border: 1px solid #ddd;">Товар</th>
            <th style="text-align: center; padding: 8px; border: 1px solid #ddd;">Количество</th>
            <th style="text-align: right; padding: 8px; border: 1px solid #ddd;">Цена за ед.</th>
            <th style="text-align: right; padding: 8px; border: 1px solid #ddd;">Сумма</th>
        </tr>
    </thead>

    <tbody>
        @php
            $totalSum = 0;
        @endphp
        @foreach ($params['items'] as $item)
            @php
                $itemSum = isset($item['sum']) ? $item['sum'] : ($item['count'] * $item['price']);
                $totalSum += $itemSum;
            @endphp
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    <b>{{ $item['offerName'] ?? $item['guidOffer'] }}</b>
                    @if (!empty($item['variantName']))
                        <br><small style="color: #666;">{{ $item['variantName'] }}</small>
                    @endif
                </td>
                <td style="text-align: center; padding: 8px; border: 1px solid #ddd;">
                    {{ number_format($item['count'], 0, '.', ' ') }} {{ $item['unit'] ?? 'ед' }}
                </td>
                <td style="text-align: right; padding: 8px; border: 1px solid #ddd;">
                    {{ number_format($item['price'], 2, '.', ' ') }} ₽
                </td>
                <td style="text-align: right; padding: 8px; border: 1px solid #ddd;">
                    <b>{{ number_format($itemSum, 2, '.', ' ') }} ₽</b>
                </td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr style="background-color: #f5f5f5; font-weight: bold;">
            <td colspan="3" style="text-align: right; padding: 8px; border: 1px solid #ddd;">Итого:</td>
            <td style="text-align: right; padding: 8px; border: 1px solid #ddd;">
                {{ number_format($totalSum, 2, '.', ' ') }} ₽
            </td>
        </tr>
    </tfoot>
</table>
