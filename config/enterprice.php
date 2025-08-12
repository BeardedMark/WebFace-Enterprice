<?php

return [
    'base_url' => 'http' . (env('ETP_SSL') ? 's' : '') . '://' . env('ETP_DOMAIN') . '/' . env('ETP_BASE_NAME') . '/' . env('ETP_API_PATH') . '/',
    'username' => env('ETP_LOGIN'),
    'password' => env('ETP_PASSWORD'),
    'deliverySumm' => 10000,
    'base_name' => '1SWEB',
    'base_description' => 'Дистрибьютер знакомых товаров',
    'catalog_title' => 'Каталог',
    'organization' => [
        'name' => 'ООО «ДНЛ Упаковка»',
        'addres' => [
            'country' => 'Россия',
            'city' => 'Новосибирск',
            'street' => 'Дзержинского',
            'building' => '35',
        ],
        'phone' => '8 (383) 285-33-11',
        'email' => 'sales@dnl.bz',
    ]
];
