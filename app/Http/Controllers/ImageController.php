<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;


use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

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
            $url = match ($type) {
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

    public function qrcode(Request $request)
    {
        $data = $request->input('data', []);

        $vcard = "BEGIN:VCARD\n";
        $vcard .= "VERSION:3.0\n";

        $fields = [
            'N'     => 'name',
            'FN'    => 'fullName',
            'ORG'   => 'organization',
            'TITLE' => 'position',
            'TEL'   => 'phone',
            'EMAIL' => 'email',
            'ADR'   => 'address',
            'URL'   => 'url',
            'NOTE'  => 'description',
        ];

        foreach ($fields as $field => $key) {
            if (!empty($data[$key])) {
                $vcard .= $field . ':' . $data[$key] . "\n";
            }
        }

        $vcard .= "END:VCARD";


        $result = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $vcard,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: $request->input('size', 200),
            margin: $request->input('margin', 13),
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
        );


        return response($result->build()->getString())
            ->header('Content-Type', 'image/png');
    }
}
