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
        // Все данные корзины хранятся в localStorage на клиенте
        // Серверная сессия не используется
        $basket = [];
        $postponed = [];
        $basketSumm = 0;
        $postponedSumm = 0;
        $basketCount = 0;
        $postponedCount = 0;

        return view('db.orders.basket', compact('basket', 'postponed', 'basketSumm', 'postponedSumm', 'basketCount', 'postponedCount'));
    }

    public function sync(Request $request)
    {
        // Метод больше не используется, так как все данные хранятся в localStorage
        // Оставлен для обратной совместимости
        $localBasket = $request->input('items', []);
        $activeItems = array_filter($localBasket, function($item) {
            return !empty($item['postponed']) ? false : (($item['quantity'] ?? 0) > 0);
        });

        return response()->json(['success' => true, 'count' => count($activeItems)]);
    }

    /**
     * Возвращает список товаров по массиву guid/quantity (batch).
     */
    public function items(Request $request)
    {
        $items = $request->input('items', []);
        if (empty($items)) {
            return response()->json(['success' => true, 'html' => '']);
        }

        $html = '';
        foreach ($items as $index => $item) {
            $guid = $item['guid'] ?? '';
            $quantity = (int)($item['quantity'] ?? 0);
            $postponed = !empty($item['postponed']);

            // Поддерживаем guid вида offer#variant
            $parts = explode('#', $guid);
            $offerGuid = $parts[0] ?? null;
            $variantGuid = $parts[1] ?? null;

            if (empty($offerGuid)) {
                continue;
            }

            $offer = $this->extansion->getOffer(['guid' => $offerGuid]);
            if (empty($offer)) {
                continue;
            }

            $variant = $variantGuid ? $this->extansion->getVariant(['variantGuid' => $variantGuid]) : null;

            $viewItem = [
                'offer' => $offer,
                'variant' => $variant,
                'quantity' => $quantity,
                'postponed' => $postponed,
            ];

            if ($index > 0) {
                $html .= '<div class="cut"></div>';
            }
            $html .= view('db.orders.frames.offerbyorder', ['item' => $viewItem])->render();
        }

        return response()->json(['success' => true, 'html' => $html]);
    }
    public function offerbyorder(Request $request)
    {
        $guid = $request->input('guid');
        $quantity = (int)($request->input('quantity', 1));

        $guidParts = explode('#', $guid);
        $offerGuid = $guidParts[0];
        $variantGuid = isset($guidParts[1]) ? $guidParts[1] : null;

        $variant = $variantGuid ? $this->extansion->getVariant(['variantGuid' => $variantGuid]) : null;
        $offer = $this->extansion->getOffer(['guid' => $offerGuid]);

        $item = [
            'offer' => $offer,
            'variant' => $variant,
            'quantity' => $quantity,
        ];

        return view('db.orders.frames.offerbyorder', ['item' => $item]);
    }



    // public function add(Request $request)
    // {
    //     $offerGuid = $request->input('offerGuid');
    //     $variantGuid = $request->input('variantGuid');
    //     $quantity = (int) $request->input('quantity', 1);
    //     $user = session('user');

    //     // if ($user) {
    //     //     $this->extansion->AddOfferToBasket([
    //     //         'userGuid' => $user['guid'],
    //     //         'offerGuid' => $offerGuid,
    //     //         'variantGuid' => $variantGuid,
    //     //         'count' => $quantity,
    //     //     ]);
    //     // } else {
    //         $basket = session('basket', []);
    //         $key = $offerGuid . (isset($variantGuid) ? '-' . $variantGuid : '');

    //         $basket[$key] = [
    //             'offerGuid' => $offerGuid,
    //             'variantGuid' => $variantGuid,
    //             'quantity' => $quantity,
    //         ];

    //         session(['basket' => $basket]);
    //     // }

    //     return back()->with('success', 'Товар добавлен в корзину');
    // }

    // public function update(Request $request, string $id)
    // {
    //     $quantity = (int) $request->input('quantity', 1);
    //     $basket = session('basket', []);

    //     if (isset($basket[$id])) {
    //         if ($quantity <= 0) {
    //             unset($basket[$id]);
    //         } else {
    //             $basket[$id]['quantity'] = $quantity;
    //         }
    //     }

    //     session(['basket' => $basket]);

    //     return back()->with('success', 'Корзина обновлена');
    // }

    // public function remove(string $id)
    // {
    //     $basket = session('basket', []);
    //     unset($basket[$id]);
    //     session(['basket' => $basket]);

    //     return back()->with('success', 'Товар удалён из корзины');
    // }

    // public function clear()
    // {
    //     session()->forget('basket');
    //     return back()->with('success', 'Корзина очищена');
    // }

    // public function postpone(string $id)
    // {
    //     $basket = session('basket', []);

    //     if (isset($basket[$id])) {
    //         $basket[$id]['postponed'] = !($basket[$id]['postponed'] ?? false);
    //     }

    //     session(['basket' => $basket]);

    //     return back()->with('success', 'Статус товара изменен');
    // }
}
