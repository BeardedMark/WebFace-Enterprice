<?php

return [
    'base_url' => 'http' . (env('ETP_SSL') ? 's' : '') . '://' . env('ETP_DOMAIN') . '/' . env('ETP_BASE_NAME') . '/' . env('ETP_API_PATH') . '/',
    'username' => env('ETP_LOGIN'),
    'password' => env('ETP_PASSWORD')
];
