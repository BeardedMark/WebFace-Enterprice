@if (session('error') || session('warning') || session('success') || $errors->any())
    <div class="flex-col">
        @if (session('error'))
            <span class="color-danger">{{ session('error') }}</span>
        @endif

        @if (session('success'))
            <span class="color-success">{{ session('success') }}</span>
        @endif

        @if (session('warning'))
            <span class="color-warning">{{ session('warning') }}</span>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="flex-col">
                    <span class="color-second">{{ $error }}</span>
                </div>
            @endforeach
        @endif
    </div>
@endif
