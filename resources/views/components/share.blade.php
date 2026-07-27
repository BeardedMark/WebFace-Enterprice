<button onclick="openModal('share')" data-tooltip="Поделиться" class="icon">
    <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/share.png" alt="share" />
</button>

<x-modal name="share" title="Поделиться ссылкой на страницу">
    <div class="flex-col-5">
        @php
            $url = request()->fullUrl();
            $urlencode = urlencode($url);
        @endphp

        <div class="flex-row-5">
            <input type="text" class="input flex-grow" readonly value="{{ request()->fullUrl() }}">

            <button id="copy-btn" title="Копировать ссылку" class="icon">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/copy--v1.png"
                    alt="email--v1" />
            </button>
        </div>

        <div class="flex-row-8">
            <div class="flex-row-5 flex-grow">
                <a class="icon" target="_blink" title="Telegram"
                    href="https://t.me/share/url?url={{ $urlencode }}&text=Смотри сюда!">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/telegram-app.png" alt="telegram-app" />
                </a>

                <a class="icon" target="_blink" title="WhatsApp"
                    href="https://wa.me/?text={{ $urlencode }}%20Смотри+сюда!">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/whatsapp.png" alt="whatsapp" />
                </a>

                <a class="icon" target="_blink" title="ВКонтакте"
                    href="https://vk.com/share.php?url={{ $urlencode }}">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/vkontakte.png" alt="vkontakte" />
                </a>

                <a class="icon" target="_blink" title="Email"
                    href="mailto:?subject=Заголовок&body=Текст%20и%20ссылка">
                    <img width="20" height="20"
                        src="https://img.icons8.com/fluency-systems-regular/20/email--v1.png" alt="email--v1" />
                </a>
            </div>

            <button id="share-btn" class="item-other">Другие варианты</button>
        </div>
    </div>
</x-modal>

@push('scripts')
    <script>
        document.getElementById('share-btn').addEventListener('click', async () => {
            if (navigator.share) {
                try {
                    await navigator.share({
                        title: document.title,
                        text: 'Посмотри это!',
                        url: window.location.href,
                    });
                } catch (err) {
                    console.error('Ошибка при шаринге:', err);
                }
            } else {
                alert('Функция «Поделиться» не поддерживается на этом устройстве.');
            }
        });

        document.getElementById('copy-btn').addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(window.location.href);
                alert('Ссылка скопирована в буфер обмена');
            } catch (err) {
                alert('Не удалось скопировать ссылку');
            }
        });
    </script>
@endpush
