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
        // Данные избранного хранятся в localStorage на клиенте
        // На сервере просто возвращаем пустой список
        $offers = [];
        return view('db.offers.favorites', compact('offers'));
    }

    public function compare()
    {
        // Данные сравнения хранятся в localStorage на клиенте
        // На сервере просто возвращаем пустой список
        $offers = [];
        return view('db.offers.compare', compact('offers'));
    }

    // Batch endpoint для получения товаров из избранного и сравнения
    public function items(Request $request)
    {
        $guids = $request->input('guids', []);
        $items = [];

        foreach ($guids as $guid) {
            $offer = $this->extansion->getOffer(['guid' => $guid]);
            if ($offer) {
                $items[] = [
                    'guid' => $guid,
                    'offer' => $offer,
                ];
            }
        }

        return response()->json(['items' => $items]);
    }
}
