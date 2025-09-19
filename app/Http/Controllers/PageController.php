<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ExtensionService;
use App\Services\AntibotService;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

use App\Mail\MessageMail;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    protected $extansion;

    public function __construct(ExtensionService $extansion)
    {
        $this->extansion = $extansion;
    }

    public function main()
    {
        $stats = []; //$this->extansion->getBaseStatistics();

        $topOffers = $this->extansion->indexOffers(['sort' => 'rating-desc', 'hierarchy' => true, 'limit' => 4]);
        $newOffers = $this->extansion->indexOffers(['sort' => 'createDate-desc', 'hierarchy' => true, 'limit' => 4]);
        $randomOffers = $this->extansion->indexOffers(['sort' => 'price-desc', 'hierarchy' => true, 'limit' => 12]);

        $popularBrands = [
            [
                'title' => 'Комус',
                'description' => 'Упаковка и канцтовары',
                'link' => 'https://komus.ru/',
                'offersCount' => '100 000',
                'image' => 'https://dnlmarket.ru/upload/iblock/b2c/b2ca4c463330671dee4c20510b98b85f.jpg'
            ],
            [
                'title' => 'Grass',
                'description' => 'Средства уборки и гигиены',
                'link' => 'https://grass.su/',
                'offersCount' => '10 000',
                'image' => 'https://dnlmarket.ru/upload/iblock/6f8/6f8f6d2a1779e7b429abc850e5f884f9.jpg'
            ],
            [
                'title' => 'Focus',
                'description' => 'Бумажная продукция',
                'link' => 'https://www.focusprofessional.ru/',
                'offersCount' => '1 000',
                'image' => 'https://dnlmarket.ru/upload/iblock/4f0/4f03b4e2eeb6eff59bc9d6fc998e8c81.jpg'
            ],
            [
                'title' => 'Upax-unity',
                'description' => 'Пищевая упаквока',
                'link' => 'https://upax.ru/',
                'offersCount' => '100',
                'image' => 'https://dnlmarket.ru/upload/iblock/ac5/ac5dd5f16030dcf09ec99cc2265c7e5f.jpg'
            ]
        ];

        $moreLinks = [
            [
                'title' => 'Часто задаваемые вопросы',
                'description' => 'Мы попытались ответить на все популярные вопросы',
                'link' => route('pages.about') . '#faq',
                'icon' => 'https://img.icons8.com/fluency-systems-regular/32/faq.png'
            ],
            [
                'title' => 'Наши приемущества',
                'description' => 'То, что отличает нас от остальных в нашей сфере',
                'link' => route('pages.about') . '#advantages',
                'icon' => 'https://img.icons8.com/fluency-systems-regular/32/star--v1.png'
            ],
            [
                'title' => 'Написать нам сообщение',
                'description' => 'Напишите нам сообщение удобным для вас способом',
                'link' => route('pages.contacts') . '#message',
                'icon' => 'https://img.icons8.com/fluency-systems-regular/32/chat--v1.png'
            ]
        ];

        return view('pages.main', compact('popularBrands', 'topOffers', 'newOffers', 'randomOffers', 'moreLinks'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contacts()
    {
        $organisation = []; //$this->extansion->getBaseStatistics();

        $contacts = config('settings.contacts');
        $messangers = config('settings.messangers');

        $vcard = "BEGIN:VCARD\n";
        $vcard .= "VERSION:3.0\n";

        // $vcard .= "N:Синельщиков;Марк;;;\n";
        $vcard .= $contacts['title'] ? ("TITLE:" . $contacts['title'] . "\n") : '';
        $vcard .= $contacts['phone'] ? ("TEL:+7" . $contacts['phone'] . "\n") : '';
        $vcard .= $contacts['email'] ? ("EMAIL:" . $contacts['email'] . "\n") : '';
        $vcard .= $contacts['person'] ? ("FN:" . $contacts['person'] . "\n") : '';
        $vcard .= $contacts['organization'] ? ("ORG:" . $contacts['organization'] . "\n") : '';
        $vcard .= $contacts['note'] ? ("NOTE:" . $contacts['note'] . "\n") : '';
        $vcard .= $contacts['geo'] ? ("ADR:" . $contacts['geo'] . "\n") : '';
        $vcard .= "URL:" . route('pages.main') . "\n";

        $vcard .= "END:VCARD";

        $builder = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $vcard,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 200,
            margin: 13,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            logoPath: public_path('logo.png'),
        );

        $result = $builder->build();
        $qrDataUri = $result->getDataUri();

        // $token = "4582fa317a5f61db6f755a3c39655c94b0d19187";
        // $inn = "7707083893"; // тестовый ИНН (Сбербанк)

        // $response = Http::withOptions([
        //     'verify' => false, // отключаем SSL-проверку
        // ])->withHeaders([
        //     'Authorization' => "Token {$token}",
        //     'Content-Type' => 'application/json',
        //     'Accept' => 'application/json'
        // ])->post('https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party', [
        //     'query' => $inn,
        //     'branch_type' => 'MAIN',
        //     'status' => ['ACTIVE']
        // ]);

        // $dadata = $response->json();

        return view('pages.contacts', compact('qrDataUri', 'contacts', 'messangers'));
    }

    public function message(Request $request)
    {
        AntibotService::check($request);

        $email = config('settings.contacts.email');
        Mail::to($email)->send(new MessageMail($request));

        return back()->with('success', 'Сообщение отправлено нам на почту. Мы дадим обратную связь по указанным вами контакатам');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }
}
