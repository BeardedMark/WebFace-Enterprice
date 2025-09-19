<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExtensionService;

class BasketController extends Controller
{
    protected $extansion;

    public function __construct(ExtensionService $extansion)
    {
        $this->extansion = $extansion;
    }

    public function index()
    {
        $basketSession = session('basket', []);

        $basket = [];
        $postponed = [];

        $basketSumm = 0;
        $postponedSumm = 0;
        $basketCount = 0;
        $postponedCount = 0;

        foreach ($basketSession as $key => $item) {
            $offer = $this->extansion->getOffer(['guid' => $item['offerGuid']]);
            $variant = $item['variantGuid'] ? $this->extansion->getVariant(['variantGuid' => $item['variantGuid']]) : null;

            $data = array_merge($item, [
                'offer' => $offer,
                'variant' => $variant,
            ]);

            if (!empty($item['postponed']) && $item['postponed'] === true) {
                $postponed[$key] = $data;
                $postponedSumm += $data['offer']['maxPrice'];
                $postponedCount += $data['quantity'];
            } else {
                $basket[$key] = $data;
                $basketSumm += $data['offer']['maxPrice'];
                $basketCount += $data['quantity'];
            }
        }

        return view('db.orders.basket', compact('basket', 'postponed', 'basketSumm', 'postponedSumm', 'basketCount', 'postponedCount'));
    }


    public function add(Request $request)
    {
        $offerGuid = $request->input('offerGuid');
        $variantGuid = $request->input('variantGuid');
        $quantity = (int) $request->input('quantity', 1);
        $user = session('user');

        // if ($user) {
        //     $this->extansion->AddOfferToBasket([
        //         'userGuid' => $user['guid'],
        //         'offerGuid' => $offerGuid,
        //         'variantGuid' => $variantGuid,
        //         'count' => $quantity,
        //     ]);
        // } else {
            $basket = session('basket', []);
            $key = $offerGuid . (isset($variantGuid) ? '-' . $variantGuid : '');

            $basket[$key] = [
                'offerGuid' => $offerGuid,
                'variantGuid' => $variantGuid,
                'quantity' => $quantity,
            ];

            session(['basket' => $basket]);
        // }

        return back()->with('success', 'Товар добавлен в корзину');
    }

    public function update(Request $request, string $id)
    {
        $quantity = (int) $request->input('quantity', 1);
        $basket = session('basket', []);

        if (isset($basket[$id])) {
            if ($quantity <= 0) {
                unset($basket[$id]);
            } else {
                $basket[$id]['quantity'] = $quantity;
            }
        }

        session(['basket' => $basket]);

        return back()->with('success', 'Корзина обновлена');
    }

    public function remove(string $id)
    {
        $basket = session('basket', []);
        unset($basket[$id]);
        session(['basket' => $basket]);

        return back()->with('success', 'Товар удалён из корзины');
    }

    public function clear()
    {
        session()->forget('basket');
        return back()->with('success', 'Корзина очищена');
    }

    public function postpone(string $id)
    {
        $basket = session('basket', []);

        if (isset($basket[$id])) {
            $basket[$id]['postponed'] = !($basket[$id]['postponed'] ?? false);
        }

        session(['basket' => $basket]);

        return back()->with('success', 'Статус товара изменен');
    }
}
