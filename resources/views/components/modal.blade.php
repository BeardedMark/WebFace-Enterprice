@props([
    'name',
    'width' => '500px',
    'title' => 'Дополнительно',
    'position' => 'center', // center, top, bottom, left, right
])

@php
    $modalClass = match ($position) {
        'top' => 'modal-top',
        'bottom' => 'modal-bottom',
        'left' => 'modal-left',
        'right' => 'modal-right',
        default => 'modal-center',
    };

    $contentClass = match ($position) {
        'top' => 'modal-content-top',
        'bottom' => 'modal-content-bottom',
        'left' => 'modal-content-left',
        'right' => 'modal-content-right',
        default => '',
    };
@endphp

<div id="modal-{{ $name }}" class="modal {{ $modalClass }}">
    <div class="modal-overlay" onclick="closeModal('{{ $name }}')"></div>

    <div
        class="modal-content back-light flex-col-13 shadow-real pad-8 {{ $contentClass }}"
        style="width: {{ $width }}"
    >
        <div class="flex-row-8">
            <p class="font-lg ai-center flex-grow pad-x-5">
                {{ $title }}
            </p>

            <button
                type="button"
                class="modal-close icon"
                title="Закрыть"
                onclick="closeModal('{{ $name }}')"
            >
                <img
                    width="20"
                    height="20"
                    src="https://img.icons8.com/fluency-systems-regular/20/delete-sign--v1.png"
                    alt="Закрыть"
                >
            </button>
        </div>

        <div class="flex-col-13">
            {{ $slot }}
        </div>
    </div>
</div>

<style>
    .modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
    }

    .modal.active {
        display: flex;
    }

    .modal-center {
        align-items: center;
        justify-content: center;
    }

    .modal-top {
        align-items: flex-start;
        justify-content: center;
    }

    .modal-bottom {
        align-items: flex-end;
        justify-content: center;
    }

    .modal-left {
        align-items: center;
        justify-content: flex-start;
    }

    .modal-right {
        align-items: center;
        justify-content: flex-end;
    }

    .modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .6);
    }

    .modal-content {
        position: relative;
        z-index: 1;

        max-width: 100vw;
        max-height: 100vh;
        overflow: auto;

        border-radius: 13px;
    }

    .modal-content-top {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .modal-content-bottom {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .modal-content-left {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;

        height: 100vh;
        max-height: 100vh;
    }

    .modal-content-right {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;

        height: 100vh;
        max-height: 100vh;
    }

    .modal-close {
        border: none;
        background: none;
        cursor: pointer;
    }
</style>

@once
    @push('scripts')
        <script>
            function getScrollbarWidth() {
                return window.innerWidth - document.documentElement.clientWidth;
            }

            function openModal(name) {
                const modal = document.getElementById('modal-' + name);

                if (!modal) {
                    return;
                }

                const scrollbarWidth = getScrollbarWidth();

                document.body.style.paddingRight = scrollbarWidth + 'px';
                document.body.style.overflow = 'hidden';

                modal.classList.add('active');
            }

            function closeModal(name) {
                const modal = document.getElementById('modal-' + name);

                if (!modal) {
                    return;
                }

                modal.classList.remove('active');

                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            }

            document.addEventListener('keydown', function(e) {
                if (e.key !== 'Escape') {
                    return;
                }

                document
                    .querySelectorAll('.modal.active')
                    .forEach(modal => modal.classList.remove('active'));

                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        </script>
    @endpush
@endonce
