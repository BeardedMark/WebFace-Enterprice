@if (
    session()->has('success') ||
    session()->has('error') ||
    session()->has('warning') ||
    session()->has('info') ||
    $errors->any()
)
    <div id="alerts-container" class="flex-col-8 ai-end pad-21 pos-fix" style="top: 0; right: 0;">
        {{-- Flash-сообщения --}}
        @foreach (['success' => 'success', 'error' => 'danger', 'warning' => 'warning', 'info' => 'main'] as $type => $color)
            @if (session($type))
                @php
                    $messages = session($type);
                    if (!is_array($messages)) {
                        $messages = [$messages];
                    }
                @endphp

                @foreach ($messages as $message)
                    <div class="back-light pad-8 flex-row bord-rad-13 shadow-real color-{{ $color }}"
                        data-alert>
                        <span class="pad-x-13 pad-y-5">{{ $message }}</span>
                        <button type="button" class="icon-other"
                            onclick="this.closest('[data-alert]').remove()">
                            ✕
                        </button>
                    </div>
                @endforeach
            @endif
        @endforeach

        {{-- Ошибки валидации --}}
        @if ($errors->any())
            @foreach ($errors->all() as $message)
                <div class="back-light pad-8 flex-row bord-rad-13 shadow-real color-danger"
                    data-alert>
                    <span class="pad-x-13 pad-y-5">{{ $message }}</span>
                    <button type="button" class="icon-other"
                        onclick="this.closest('[data-alert]').remove()">
                        ✕
                    </button>
                </div>
            @endforeach
        @endif
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll('[data-alert]').forEach((el) => {
            setTimeout(() => {
                el.remove();
            }, 5000); // автоудаление через 5 секунд
        });
    });
</script>
