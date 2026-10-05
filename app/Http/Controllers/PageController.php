<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AntibotService;

class PageController extends Controller
{
    public function main()
    {
        $page = $this->etp->GetPageCard("main");

        $meta = [
            'title' => $page['title'] ?? $page['seo']['title'] ?? 'Главная страница',
            'description' => $page['description'] ?? $page['seo']['description'] ?? null,
            'seo' => [
                'title' => $page['seo']['title'] ?? $page['title'] ?? 'Главная страница',
                'description' => $page['seo']['description'] ?? $page['description'] ?? null,
                'canonical' => route('pages.main')
            ]
        ];

        $template = $page['template'] ?: "page";

        return view('pages.' . $template, compact('page', 'meta'));
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

    public function page(string $page)
    {
        $page = $this->etp->GetPageCard($page);

        $meta = [
            'title' => $page['title'] ?? $page['seo']['title'] ?? 'Страница контактов',
            'description' => $page['description'] ?? $page['seo']['description'] ?? null,
            'seo' => [
                'title' => $page['seo']['title'] ?? $page['title'] ?? 'Страница контактов',
                'description' => $page['seo']['description'] ?? $page['description'] ?? null,
                'canonical' => $page['seo']['canonical'] ?? "/"
            ]
        ];

        return view('pages.' . ($page['template'] ?: 'page'), compact('page', 'meta'));
    }
}
