<style>
    .share-popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
</style>

<span class="flex-row-5">
    <button id="open-share" class="icon" data-tooltip="Поделиться" title="Поделиться">
        <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/share.png"
            alt="share" />
    </button>
</span>

<div id="share-overlay" class="share-popup-overlay" style="display: none;">
    <div class="flex-col-13 bord-rad-13 back-prime pad-8">
        @php $url = urlencode(request()->fullUrl()); @endphp

        <div class="flex-row-5 jc-center">
            <a class="icon" data-tooltip="Telegram" target="_blink" href="https://t.me/share/url?url={{ $url }}&text=Смотри сюда!">
                <img width="20" height="20"
                    src="https://img.icons8.com/fluency-systems-regular/20/telegram-app.png" alt="telegram-app" />
            </a>
            <a class="icon" data-tooltip="WhatsApp" target="_blink" href="https://wa.me/?text={{ $url }}%20Смотри+сюда!">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/whatsapp.png"
                    alt="whatsapp" />
            </a>
            <a class="icon" data-tooltip="ВКонтакте" target="_blink" href="https://vk.com/share.php?url={{ $url }}">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/vkontakte.png"
                    alt="vkontakte" />
            </a>
            <a class="icon" data-tooltip="Email" target="_blink" href="mailto:?subject=Заголовок&body=Текст%20и%20ссылка">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/email--v1.png"
                    alt="email--v1" />
            </a>
            <button id="share-btn" class="icon" data-tooltip="Еще варианты">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/more.png"
                    alt="more" /></button>
        </div>

        {{-- <div class="flex-row-5 jc-center">
            <a class="icon" target="_blink" href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}">
                <img width="20" height="20"
                    src="https://img.icons8.com/fluency-systems-regular/20/facebook-f.png" alt="facebook-f" />
            </a>
            <a class="icon" target="_blink"
                href="https://twitter.com/intent/tweet?url={{ $url }}&text=Смотри сюда!">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/twitter.png"
                    alt="twitter" />
            </a>
            <a class="icon" target="_blink"
                href="https://www.linkedin.com/shareArticle?url={{ $url }}&title=...">
                <img width="20" height="20" src="https://img.icons8.com/fluency-systems-regular/20/linkedin.png"
                    alt="linkedin" />
            </a>
            <a class="icon" target="_blink" href="https://connect.ok.ru/offer?url={{ $url }}">
                <img width="20" height="20"
                    src="https://img.icons8.com/fluency-systems-regular/20/odnoklassniki.png" alt="odnoklassniki" />
            </a>
        </div> --}}

        <div class="flex-col-5">
            <button id="copy-btn" class="item-other">Копировать ссылку</button>
            <button id="close-share" class="item-other color-danger" title="Закрыть">Закрыть</button>
        </div>

    </div>
</div>

<script>
    const openBtn = document.getElementById('open-share');
    const closeBtn = document.getElementById('close-share');
    const overlay = document.getElementById('share-overlay');
    const copyBtn = document.getElementById('copy-link');

    openBtn.addEventListener('click', () => overlay.style.display = 'flex');
    closeBtn.addEventListener('click', () => overlay.style.display = 'none');

    copyBtn.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(window.location.href);
            alert('Ссылка скопирована!');
        } catch {
            alert('Не удалось скопировать ссылку');
        }
    });
</script>

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
