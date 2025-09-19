<h1>{{ $subject }}</h1>

<p>
    <b>Логин:</b> {{ $params['name'] ?? '—' }}<br>
    <b>Пароль:</b> {{ $params['password'] ?? '—' }}<br>
</p>

<p>
    <b>Телефон:</b> {{ $params['phone'] ?? '—' }}<br>
    <b>Email:</b> {{ $params['email'] ?? '—' }}<br>
    <b>ИНН:</b> {{ $params['inn'] ?? '—' }}<br>
</p>
