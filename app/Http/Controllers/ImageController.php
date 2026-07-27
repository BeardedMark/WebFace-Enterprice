<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class ImageController extends Controller
{
    /**
     * Прокси для получения изображений с сервера 1С с авторизацией
     *
     * @param string $type Тип изображения: 'offer' или 'extension'
     * @param string $guid GUID изображения
     * @return \Illuminate\Http\Response
     */
    public function proxy(string $type, string $guid)
    {
        try {
            // Определяем URL в зависимости от типа
            $url = match($type) {
                'offer' => config('enterprice.base_url') . 'offers/image/' . $guid,
                'file' => config('enterprice.base_url') . 'file/' . $guid,
                'extension' => config('enterprice.base_url') . 'Extensions/Image/get?guid=' . $guid,
                default => null,
            };

            if (!$url) {
                abort(404, 'Invalid image type');
            }

            // dd($url);
            // Делаем запрос к 1С с авторизацией
            $response = Http::withOptions(['verify' => false])
                ->withBasicAuth(config('enterprice.username'), config('enterprice.password'))
                ->timeout(30)
                ->get($url);

            if (!$response->successful()) {
                abort($response->status(), 'Failed to fetch image');
            }

            // Получаем содержимое изображения
            $imageContent = $response->body();

            // Определяем MIME тип из заголовков ответа или по умолчанию
            $contentType = $response->header('Content-Type') ?: 'image/jpeg';

            // Возвращаем изображение с правильными заголовками
            return response($imageContent, 200)
                ->header('Content-Type', $contentType)
                ->header('Cache-Control', 'public, max-age=3600')
                ->header('Content-Length', strlen($imageContent));

        } catch (RequestException $e) {
            abort(500, 'Error fetching image: ' . $e->getMessage());
        }
    }
}
