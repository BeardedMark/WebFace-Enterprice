<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EnterpriceService
{
    protected function request(string $method, string $url, array $data = [], array $headers = [])
    {
        $client = Http::withOptions(['verify' => false])
            ->withBasicAuth(config('odata.username'), config('odata.password'))
            ->withHeaders($headers);

        $fullUrl = rtrim(config('odata.base_url'), '/') . '/' . ltrim($url, '/');

        return $client->{$method}($fullUrl, $data);
    }
}
