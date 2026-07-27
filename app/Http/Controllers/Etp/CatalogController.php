<?php

namespace App\Http\Controllers\Etp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $page = $this->etp->GetCatalogPage();
        $catalogs = $this->etp->GetCatalogsList();
        $offers = $this->etp->GetOffersList(['sort' => $request['sort'] ?? 'rating-desc']);

        $meta = [
            'title' => $page['data']['seoTitle'] ?? $page['data']['header'] ?? 'Основные категории товаров',
            'description' => $page['data']['seoDescription'] ?? $page['data']['description'] ?? null,
            'canonical' => route('catalogs.index')
        ];

        $breadcrumbs = [['title' => 'Каталог']];

        return view('etp.catalogs.index', compact('catalogs', 'offers', 'breadcrumbs', 'meta', 'page'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $guid, Request $request)
    {
        $catalog = $this->etp->GetCatalogCard($guid);
        $catalogs = $this->etp->GetCatalogsList(['catalogGuid' => $guid]);
        $offers = $this->etp->GetOffersList(['catalogGuid' => $guid, 'sort' => $request['sort'] ?? 'rating-desc', 'storage' => $request['storage'] ?? '']);

        $meta = [
            'title' => !empty($catalog['fullName']) ? $catalog['fullName'] : ($catalog['name'] . ' - купить товары категории' ),
            'description' => !empty($catalog['description']) ? $catalog['description'] : ('Каталог наших товаров из категории ' . $catalog['name']),
            'canonical' => route('catalogs.show', $catalog['guid'])
        ];

        $breadcrumbs = [['title' => 'Каталог', 'url' => route('catalogs.index')]];
        foreach ($catalog['parents'] as $parent) {
            $breadcrumbs[] = [
                'title' => $parent['name'],
                'url' => route('catalogs.show', $parent['guid']),
            ];
        }
        $breadcrumbs[] = ['title' => $catalog['name']];

        return view('etp.catalogs.show', compact('catalog', 'catalogs', 'offers', 'breadcrumbs', 'meta'));
    }

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
