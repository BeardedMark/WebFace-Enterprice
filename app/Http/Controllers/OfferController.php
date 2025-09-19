<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ExtensionService;

class OfferController extends Controller
{
    protected $extansion;

    public function __construct(ExtensionService $extansion)
    {
        $this->extansion = $extansion;
    }

    public function index()
    {
        $offers = $this->extansion->indexOffers();
        return view('db.offers.index', compact('offers'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $id)
    {
        $offer = $this->extansion->getOffer(['guid' => $id]);
        $variants = $this->extansion->getVariants(['offerGuid' => $id]);

        $breadcrumbs = [['title' => 'Каталог', 'url' => route('catalogs.index')]];
        if (count($offer['parents']) > 1) {
            $breadcrumbs[] = ['title' => '...'];
        }
        if ($offer['parent']) {
            $breadcrumbs[] = ['title' => $offer['parent']['name'], 'url' => route('catalogs.show', $offer['parent']['guid'])];
        }
        $breadcrumbs[] = ['title' => $offer['name']];

        return view('db.offers.show', compact('offer', 'variants', 'breadcrumbs'));
    }

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}

    public function price()
    {
        $prices = $this->extansion->listPriceByUser(['userGuid' => session('user')['guid']]);
        return view('db.offers.price', compact('prices'));
    }

    public function favorites()
    {
        $ids = session('favorites', []);

        $offers = [];

        return view('db.offers.favorites', compact('offers'));
    }

    // Добавление/удаление из избранного
    public function toggleFavorite(string $id)
    {
        $favorites = session()->get('favorites', []);
        if (in_array($id, $favorites)) {
            $favorites = array_values(array_diff($favorites, [$id]));
        } else {
            $favorites[] = $id;
        }
        session(['favorites' => $favorites]);

        return back();
    }

    public function compare()
    {
        $ids = session('compare', []);

        $offers = [];

        return view('db.offers.compare', compact('offers'));
    }

    public function toggleCompare(string $id)
    {
        $compare = session()->get('compare', []);
        if (in_array($id, $compare)) {
            $compare = array_values(array_diff($compare, [$id]));
        } else {
            $compare[] = $id;
        }
        session(['compare' => $compare]);

        return back();
    }
}
