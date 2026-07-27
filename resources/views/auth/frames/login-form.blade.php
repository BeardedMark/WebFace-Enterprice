
<form class="flex-col-21" action="{{ route('auth.login') }}" method="POST">
    @csrf

    <div class="flex-col-8">
        <div class="flex-col">
            <label class="pad-x-5" for="login">Имя пользователя
                <span class="color-danger">*</span></label>
            <input class="input" type="text" name="login" id="login" value="{{ old('login') }}"
                placeholder="Персональный логин для входа в систему" required>
        </div>

        <div class="flex-col">
            <label class="pad-x-5" for="password">Пароль пользователя
                <span class="color-danger">*</span></label>
            <input class="input" type="password" name="password" id="password"
                value="{{ old('password') }}"
                placeholder="Обычно имеет от 6 символов, содержит буквы в нижнем и верхнем регистре, числа и символы"
                required>
        </div>

    </div>

    <div class="flex-row-5 jc-end ai-center">
        <span class="ai-center flex-grow pad-x-5 font-sm"><x-antibot /></span>
        <button class="button-main" type="submit">Войти</button>
    </div>
</form>
