<section class="row g-4 d-print-none">
    <div class="col">
        <div class="flex-col-34">
            <x-header tag='h2' size='xl' color='brand' :title="$section['title']"
                :description="$section['description']" />
        </div>
    </div>

    <div class="col col-12 col-md-6 offset-md-1">
        <form class="flex-col-21 pad-x-8" action="{{ route('message.send') }}" method="POST">
            @csrf

            <div class="flex-col-13">
                <input type="hidden" name="email" value="{{ $section['parameters']['email'] }}">
                <input type="hidden" name="subject" value="Сообщение со страницы контактов">

                <div class="flex-col-5">
                    <p class="pad-x-5" for="name">Ваши контактные данные для обратной связи
                        <span class="color-danger">*</span>
                    </p>
                    <input class="input" type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="Имя" autocomplete="name" required>

                    <input class="input" type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        placeholder="Телефон" autocomplete="phone" required>

                    <input class="input" type="email" name="email" id="email" value="{{ old('email') }}"
                        placeholder="Email" autocomplete="email" required>
                </div>

                <div class="flex-col-5">
                    <label class="pad-x-5" for="message">Сообщение</label>
                    <textarea class="input" name="message" id="message" rows="3">{{ old('message') }}</textarea>
                </div>

                <p class="color-second pad-x-5 font-sm">
                    Отправляя форму вы подтверждаете свое согласие с
                    <a class="link" href="{{ route('pages.page', 'privacy') }}">пользовательским соглашением</a>
                </p>
            </div>

            <div class="flex-row-5 jc-end">
                <span class="ai-center flex-grow pad-x-5 font-sm"><x-antibot /></span>

                <button class="button-main" type="submit">Отправить</button>
            </div>
        </form>
    </div>
</section>
