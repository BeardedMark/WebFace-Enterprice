<?php

namespace App\Http\Controllers\Etp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [['title' => 'Производители']];
        $manufacturers = $this->etp->GetManufacturersList();

        return view('etp.manufacturers.index', compact('breadcrumbs', 'manufacturers'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $manufacturer, Request $request)
    {
        $manufacturer = $this->etp->GetManufacturerCard($manufacturer);
        $breadcrumbs = [['title' => 'Производители', 'url' => route('manufacturers.index')], ['title' => $manufacturer['name']]];

        $meta = [
            'title' => "{$manufacturer['name']} - производитель товаров",
            'description' => $manufacturer['description'],
            'canonical' => route('manufacturers.show', $manufacturer['guid'])
        ];

        $brands = $this->etp->GetBrandsList(["manufacturer" => $manufacturer['guid']]);
        $offers = $this->etp->GetOffersList(['sort' => $request['sort'] ?? 'rating-desc', "manufacturer" => $manufacturer['guid'], "brand" => $request->input('brand'), "hierarchy" => true]);

        return view('etp.manufacturers.show', compact('breadcrumbs', 'manufacturer', 'brands', 'offers', 'meta'));
    }

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
