<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AntibotService;
use Illuminate\Support\Facades\Http;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

use App\Mail\MessageMail;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function main()
    {
        $recommendedOffers = [
            // $this->etp->GetOfferCard('12f92710-632e-11ec-80c8-00155d588b1f'),
            // $this->etp->GetOfferCard('b5a53957-6218-11ec-80c8-00155d588b1f'),
            // $this->etp->GetOfferCard('f9da1a69-7296-11ec-80bd-00155d62f000'),
            // $this->etp->GetOfferCard('84b1206d-64a2-11ec-80c8-00155d588b1f')
        ];

        // $topOffers = $this->etp->GetOffersList(['sort' => 'rating-desc', 'hierarchy' => true, 'limit' => 8]);
        // $newOffers = $this->etp->GetOffersList(['sort' => 'createDate-desc', 'hierarchy' => true, 'limit' => 8]);

        $page = $this->etp->GetMainPage();

        $moreLinks = [
            [
                'title' => 'Часто задаваемые вопросы',
                'description' => 'Мы попытались ответить на все популярные вопросы',
                'link' => route('pages.about') . '#faq',
                'icon' => 'https://img.icons8.com/fluency-systems-regular/32/faq.png'
            ],
            [
                'title' => 'Наши преимущества',
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

        $meta = [
            'title' => $page['data']['seoTitle'] ?? $page['data']['header'] ?? 'Главная страница',
            'description' => $page['data']['seoDescription'] ?? $page['data']['description'] ?? null,
            'canonical' => route('pages.main')
        ];

        return view('pages.main', compact('page', 'moreLinks', 'recommendedOffers', 'meta'));
    }

    public function about()
    {
        $page = $this->etp->GetAboutPage();

        $meta = [
            'title' => $page['data']['seoTitle'] ?? $page['data']['header'] ?? 'Страница описания',
            'description' => $page['data']['seoDescription'] ?? $page['data']['description'] ?? null,
            'canonical' => route('pages.about')
        ];

        return view('pages.about', compact('page', 'meta'));
    }

    public function contacts()
    {
        $page = $this->etp->GetContactsPage();
        $baseData = $this->etp->GetBaseData();

        $contact = $page['organization'];

        $vcard = "BEGIN:VCARD\n";
        $vcard .= "VERSION:3.0\n";

        // $vcard .= "N:Синельщиков;Марк;;;\n";
        $vcard .= isset($baseData['name']) ? ("N:" . $baseData['name'] . "\n") : '';
        $vcard .= isset($baseData['description']) ? ("TITLE:" . $baseData['description'] . "\n") : '';
        $vcard .= isset($baseData['phone']) ? ("TEL:" . $baseData['phone'] . "\n") : '';
        $vcard .= isset($baseData['email']) ? ("EMAIL:" . $baseData['email'] . "\n") : '';
        $vcard .= isset($baseData['address']) ? ("ADR:" . $baseData['address'] . "\n") : '';
        // $vcard .= isset($contact['fullName']) ? ("ORG:" . $contact['fullName'] . "\n") : '';
        // $vcard .= isset($contact['person']) ? ("FN:" . $contact['person'] . "\n") : '';
        // $vcard .= isset($contact['description']) ? ("NOTE:" . $contact['description'] . "\n") : '';
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
            // logoPath: public_path('logo.png'),
        );

        $result = $builder->build();
        $qrDataUri = $result->getDataUri();

        // $token = "4582fa317a5f61db6f755a3c39655c94b0d19187";
        // $inn = $contact['inn']; // тестовый ИНН (Сбербанк)

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


        $meta = [
            'title' => $page['data']['seoTitle'] ?? $page['data']['header'] ?? 'Страница контактов',
            'description' => $page['data']['seoDescription'] ?? $page['data']['description'] ?? null,
            'canonical' => route('pages.contacts')
        ];

        return view('pages.contacts', compact('qrDataUri', 'contact', 'page', 'meta'));
    }

    public function message(Request $request)
    {
        AntibotService::check($request);

        $email = $this->etp->GetBaseData()['email'];
        Mail::to($email)->send(new MessageMail($request));

        return back()->with('success', 'Сообщение отправлено нам на почту. Мы дадим обратную связь по указанным вами контакатам');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function sitemap()
    {
        $page = $this->etp->GetMainPage();
        // $statistics = $page['statistics'];

        return view('pages.sitemap');
    }

    public function search(Request $request)
    {
        $breadcrumbs = [
            ['title' => 'Каталог', 'url' => route('catalogs.index')],
            ['title' => 'Поиск']
        ];

        if ($request->filled('search') || $request->filled('manufacturer') || $request->filled('brand')) {

            $params = [
                'sort'      => $request->input('sort', 'rating-desc'),
                'search'    => $request->input('search'),
                'hierarchy' => true,
            ];

            if ($request->filled('manufacturer')) {
                $params['manufacturer'] = $request->input('manufacturer');
            }

            if ($request->filled('brand')) {
                $params['brand'] = $request->input('brand');
            }

            $offers = $this->etp->GetOffersList($params);
        } else {
            $offers = [];
        }

        $manufacturers = $this->etp->GetManufacturersList();
        $brands = $this->etp->GetBrandsList(["manufacturer" => $request->input('manufacturer') ?? '']);
        // $catalogs = $this->etp->GetCatalogsList(["search" => $request->input('search') ?? '', 'hierarchy' => true]);

        return view('pages.search', compact('breadcrumbs', 'offers', 'manufacturers', 'brands'));
    }
}
