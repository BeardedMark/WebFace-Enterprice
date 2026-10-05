<?php

namespace App\Http\Controllers\Enterprice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = $this->etp->GetBrandsList();

        $breadcrumbs = [
            ['title' => 'Производители', 'url' => route('manufacturers.index')],
            ['title' => 'Марки (бренды)']
        ];

        return view('enterprise.brands.index', compact('breadcrumbs', 'brands'));
    }

    // public function create() {}

    // public function store(Request $request) {}

    public function show(string $brand, Request $request)
    {
        $brand = $this->etp->GetBrandCard($brand);
        $manufacturer = $this->etp->GetManufacturerCard($brand['manufacturer']['guid']);

        $brands = $this->etp->GetBrandsList([
            'manufacturer' => $manufacturer['guid'],
        ]);

        $offers = $this->etp->GetOffersList([
            'sort' => $request['sort'] ?? 'rating-desc',
            'manufacturer' => $manufacturer['guid'],
            'brand' => $brand['guid'],
            'hierarchy' => true
        ]);

        $breadcrumbs = [
            ['title' => 'Производители', 'url' => route('manufacturers.index')],
            ['title' => $manufacturer['name'], 'url' => route('manufacturers.show', $manufacturer['guid'])],
            ['title' => $brand['name']]
        ];

        return view('enterprise.manufacturers.show', compact('breadcrumbs', 'manufacturer', 'brands', 'offers'));
    }

    // public function edit(string $id) {}

    // public function update(Request $request, string $id) {}

    // public function destroy(string $id) {}
}
