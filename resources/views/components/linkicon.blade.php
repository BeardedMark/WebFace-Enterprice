@props(['href'])

@php
    $rawHref = trim($href);

    // Если нет схемы — добавляем https://
    $normalizedHref = preg_match('#^https?://#i', $rawHref)
        ? $rawHref
        : 'https://' . ltrim($rawHref, '/');

    // Получаем домен
    $domain = parse_url($normalizedHref, PHP_URL_HOST);

    // fallback если parse_url не справился (например "google.com/path")
    if (!$domain) {
        $domain = preg_replace('#/.*$#', '', $rawHref);
    }

    $faviconUrl = $domain
        ? "https://www.google.com/s2/favicons?domain={$domain}&sz=32"
        : null;

    $fallbackIcon = "https://www.google.com/s2/favicons?domain=example.com&sz=32";
@endphp

<a
    class="icon"
    data-tooltip="{{ $slot->isEmpty() ? $domain : $slot }}"
    href="{{ $normalizedHref }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 hover:underline']) }}
    target="_blank"
    rel="noopener noreferrer"
>
    @if($faviconUrl)
        <img
            height="20px"
            width="20px"
            src="{{ $faviconUrl }}"
            alt="{{ $domain }}"
            class="w-4 h-4 rounded-sm"
            loading="lazy"
            referrerpolicy="no-referrer"
            onerror="this.onerror=null;this.src='{{ $fallbackIcon }}';"
        >
    @endif
</a>
