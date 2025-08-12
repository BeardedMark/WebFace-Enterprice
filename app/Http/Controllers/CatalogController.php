<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExtensionService;
use App\Domains\OData\Services\ODataService;

class CatalogController extends Controller
{
    protected $extansion;
    protected $odata;
    protected $odataEntity = "Catalog_Номенклатура";

    public function __construct(ExtensionService $extansion, ODataService $odata)
    {
        $this->extansion = $extansion;
        $this->odata = $odata;
    }

    public function index()
    {
        $catalog = $this->extansion->cardCatalog();
        $catalogs = $this->extansion->indexCatalogs();
        $offers = $this->extansion->indexOffers();
        $breadcrumbs = [['title' => 'Каталог']];

        return view('db.catalogs.show', compact('catalog', 'catalogs', 'offers', 'breadcrumbs'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $id)
    {
        $catalog = $this->extansion->cardCatalog(['catalogGuid' => $id]);
        $catalogs = $this->extansion->indexCatalogs(['catalogGuid' => $id]);
        $offers = $this->extansion->indexOffers(['catalogGuid' => $id]);

        $breadcrumbs = [['title' => 'Каталог', 'url' => route('catalogs.index')]];
        foreach ($catalog['parents'] as $parent) {
            $breadcrumbs[] = [
                'title' => $parent['name'],
                'url' => route('catalogs.show', $parent['guid']),
            ];
        }
        $breadcrumbs[] = ['title' => $catalog['name']];

        return view('db.catalogs.show', compact('catalog', 'catalogs', 'offers', 'breadcrumbs'));
    }

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}

    public function tree()
    {
        $catalogs = $this->extansion->treeCatalogs();
        $breadcrumbs = [['title' => 'Каталог', 'url' => route('catalogs.index')], ['title' => 'Все каталоги']];

        return view('db.catalogs.index', compact('catalogs', 'breadcrumbs'));
    }
}
