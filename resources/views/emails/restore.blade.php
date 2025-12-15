<h1>{{ $subject }}</h1>

<p>
    <b>Логин:</b> {{ $params['login'] ?? '—' }}<br>
    <b>Пароль:</b> {{ $params['password'] ?? '—' }}<br>
</p>

<p>
    <b>Телефон:</b> {{ $params['phone'] ?? '—' }}<br>
    <b>Email:</b> {{ $params['email'] ?? '—' }}<br>
</p>

@isset($params['message'])
    <p><b>Сообщение: </b>{{ $params['message'] ?? '—' }}</p>
@endisset
