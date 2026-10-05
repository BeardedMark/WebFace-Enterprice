<?php

namespace App\Http\Controllers\Enterprice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        $manufacturers = $this->etp->GetManufacturersList();

        $breadcrumbs = [
            ['title' => 'Производители']
        ];

        return view('enterprise.manufacturers.index', compact('breadcrumbs', 'manufacturers'));
    }

    // public function create() {}

    // public function store(Request $request) {}

    public function show(string $manufacturer, Request $request)
    {
        $manufacturer = $this->etp->GetManufacturerCard($manufacturer);

        $brands = $this->etp->GetBrandsList([
            "manufacturer" => $manufacturer['guid']
        ]);

        $offers = $this->etp->GetOffersList([
            'sort' => $request['sort'] ?? 'rating-desc',
            'manufacturer' => $manufacturer['guid'],
            'brand' => $request->input('brand'),
            'hierarchy' => true
        ]);

        $meta = [
            'title' => "{$manufacturer['name']} - производитель товаров",
            'description' => $manufacturer['description'],
            'canonical' => route('manufacturers.show', $manufacturer['guid'])
        ];

        $breadcrumbs = [
            ['title' => 'Производители', 'url' => route('manufacturers.index')],
            ['title' => $manufacturer['name']]
        ];

        return view('enterprise.manufacturers.show', compact('breadcrumbs', 'manufacturer', 'brands', 'offers', 'meta'));
    }

    // public function edit(string $id) {}

    // public function update(Request $request, string $id) {}

    // public function destroy(string $id) {}
}
