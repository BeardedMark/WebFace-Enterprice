<?php

namespace App\Http\Controllers\Etp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = $this->etp->GetOffersList();

        return view('etp.offers.index', compact('offers'));
    }

    // public function create() {}

    // public function store(Request $request) {}

    public function show(string $id)
    {
        $offer = $this->etp->GetOfferCard($id);
        $variants = $this->etp->GetVariantsList(['offerGuid' => $offer['guid']]);

        $breadcrumbs = [['title' => 'Каталог', 'url' => route('catalogs.index')]];

        if (count($offer['parents']) > 1) {
            $breadcrumbs[] = ['title' => '...'];
        }

        if ($offer['parent']) {
            $breadcrumbs[] = ['title' => $offer['parent']['name'], 'url' => route('catalogs.show', $offer['parent']['guid'])];
        }

        $breadcrumbs[] = ['title' => $offer['name']];

        return view('etp.offers.show', compact('offer', 'variants', 'breadcrumbs'));
    }

    // public function edit(string $id) {}

    // public function update(Request $request, string $id) {}

    // public function destroy(string $id) {}

    public function price()
    {
        $prices = $this->etp->getOffersByUser(session('user')['guid']);
        return view('etp.offers.price', compact('prices'));
    }

    public function favorites()
    {
        $offers = $this->etp->GetOffersListByGuids(['offers' => [
            'b2eea75f-ba2f-11ec-80c8-00155d62e314',
            '6c5648a6-5f45-11ec-80c8-00155d588b1f#383d903c-d745-11ec-80d1-00155d62e314'
        ]]);
        return view('etp.offers.favorites', compact('offers'));
    }

    public function compare()
    {
        $offers = [];
        return view('etp.offers.compare', compact('offers'));
    }

    public function card(string $guid)
    {
        $offer = $this->etp->GetOfferCard($guid);
        if (!$offer) {
            return response()->json(['success' => false, 'html' => ''], 404);
        }
        $variant = null;
        $html = view('etp.offers.frames.card', compact('offer', 'variant'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function items(Request $request)
    {
        $items = $request->input('items', []);
        if (empty($items)) {
            return response()->json(['success' => true, 'html' => '']);
        }

        $guids = array_values(
            array_unique(
                array_filter(
                    array_column($items, 'guid')
                )
            )
        );

        $offers = $this->etp->GetOffersListByGuids(['offers' => $guids]);
        $offersList = is_array($offers) && isset($offers['offers']) ? $offers['offers'] : (is_array($offers) ? $offers : []);
        $html = view('etp.orders.frames.offers-list', ['offers' => $offersList])->render();

        return response()->json(['success' => true, 'html' => $html]);
    }


    public function offerbyorder(Request $request)
    {
        $guid = $request->input('guid');
        $quantity = (int)($request->input('quantity', 1));

        $guidParts = explode('#', $guid);
        $offerGuid = $guidParts[0];
        $variantGuid = isset($guidParts[1]) ? $guidParts[1] : null;

        $variant = $variantGuid ? $this->etp->GetVariantCard($variantGuid) : null;
        $offer = $this->etp->GetOfferCard($offerGuid);

        $item = [
            'offer' => $offer,
            'variant' => $variant,
            'quantity' => $quantity,
        ];

        return view('etp.orders.frames.offerbyorder', ['item' => $item]);
    }
}
