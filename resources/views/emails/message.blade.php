<h1>{{ $subject }}</h1>

<p>
    <b>Имя:</b> {{ $params['name'] ?? '—' }}<br>
    <b>Телефон:</b> {{ $params['phone'] ?? '—' }}<br>
    <b>Email:</b> {{ $params['email'] ?? '—' }}<br>
</p>

@isset($params['message'])
    <p><b>Сообщение: </b>{{ $params['message'] ?? '—' }}</p>
@endisset
