<?php

return [
    'base_url' => 'https://' . env('ETP_DOMAIN') . '/' . env('ETP_PUBLISH') . '/hs/',
    'base' => 'https://' . env('ETP_DOMAIN') . '/' . env('ETP_PUBLISH') . '/',
    'username' => env('ETP_LOGIN'),
    'password' => env('ETP_PASSWORD')
];
