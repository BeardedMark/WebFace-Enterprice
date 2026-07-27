<div class="flex-col-8">
    <p class="flex-col pad-x-13">
        @isset($organization['name'])
            <span>{{ $organization['name'] }}</span>
        @endisset
    </p>

    <p class="flex-col pad-x-13">
        @isset($organization['email'])
            <span>{{ $organization['email'] }}</span>
        @endisset

        @isset($organization['phone'])
            <span>{{ $organization['phone'] }}</span>
        @endisset
    </p>

    <p class="flex-col pad-x-13 font-sm">
        @isset($organization['inn'])
            <span>ИНН: {{ $organization['inn'] }}</span>
        @endisset

        @isset($organization['ogrn'])
            <span>ОГРН: {{ $organization['ogrn'] }}</span>
        @endisset

        @isset($organization['kpp'])
            <span>КПП: {{ $organization['kpp'] }}</span>
        @endisset

        @isset($organization['okpo'])
            <span>ОКПО: {{ $organization['okpo'] }}</span>
        @endisset
    </p>

    <p class="flex-col pad-x-13">
        @isset($organization['legalAddress'])
            <span>Юр. адрес: {{ $organization['legalAddress'] }}</span>
        @endisset
    </p>
</div>
