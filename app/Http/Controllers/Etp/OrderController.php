<?php

namespace App\Http\Controllers\Etp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AntibotService;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = session('user');
        $contractors = $this->etp->GetContractorsList(['userGuid' => $user['guid']]);

        if (!empty($request['guid'])) {
            $orders = $this->etp->GetOrdersByContractor(['contractorGuid' => $request['guid']]);
        } else {
            $orders = $this->etp->listOrdersByUserGuid(['userGuid' => $user['guid']]);
        }

        return view('etp.orders.index', compact('contractors', 'orders'));
    }

    public function create()
    {
        $user = session('user');
        $contractors = null;

        if ($user) {
            $contractors = $this->etp->GetContractorsList(['userGuid' => $user['guid']]);
        }
        return view('etp.orders.create', compact('contractors', 'user'));
    }

    public function store(Request $request)
    {
        AntibotService::check($request);

        // Получаем товары из формы (скрытые поля)
        $formItems = $request->input('items', []);

        $finalItems = [];
        $itemsForEmail = [];

        // Формируем список товаров для заказа из данных формы (серверный пересчёт)
        foreach ($formItems as $item) {
            $offerGuid = $item['offerGuid'] ?? null;
            $variantGuid = $item['variantGuid'] ?? null;
            $quantity = (int)($item['quantity'] ?? 0);

            // Пропускаем отложенные и нулевое количество
            if (($item['postponed'] ?? false) || $quantity <= 0 || empty($offerGuid)) {
                continue;
            }

            $offer = $this->etp->GetOfferCard($offerGuid);
            if (empty($offer)) {
                continue;
            }

            $variant = !empty($variantGuid) ? $this->etp->GetVariantCard($variantGuid) : null;
            // Пересчёт цены только на сервере
            $price = $variant ? ($variant['price'] ?? 0) : ($offer['maxPrice'] ?? 0);
            $quantity = max(1, min($quantity, 100)); // защита min/max

            // Для 1С API
            $finalItems[] = [
                'guidOffer' => $offerGuid,
                'guidVariant' => $variantGuid,
                'count' => $quantity,
                'price' => $price,
            ];

            // Для email (с полной информацией)
            $itemsForEmail[] = [
                'guidOffer' => $offerGuid,
                'guidVariant' => $variantGuid,
                'offerName' => $offer['name'],
                'variantName' => $variant ? $variant['name'] : null,
                'count' => $quantity,
                'price' => $price,
                'sum' => $price * $quantity,
                'unit' => $offer['unit'] ?? 'ед',
            ];
        }

        // Проверяем, что есть товары для заказа
        if (empty($finalItems)) {
            return back()->with('error', 'Нет товаров для оформления заказа.');
        }

        $params = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'inn' => $request['inn'] ?? null,
            'guidContractor' => $request['guidContractor'] ?? null,
            'deliveryType' => $request['deliveryType'],
            'items' => $finalItems,
            'address' => $request['address'] ?? null,
            'date' => $request['date'] ?? null,
            'fromTime' => $request['fromTime'] ?? null,
            'toTime' => $request['toTime'] ?? null,
            'commentary' => $request['commentary'] ?? null,
        ];

        $user = session('user');
        $order = null;

        if ($user) {
            // Для зарегистрированных пользователей - создаем заказ в 1С
            $order = $this->etp->PostOrder($params);

            if (!empty($order['OrderGuid'])) {
                // Очистка корзины происходит на клиенте через JavaScript
                // после успешного оформления заказа

                return redirect()->route('orders.show', $order['OrderGuid'])
                    ->with('success', 'Заказ успешно оформлен');
            } else {
                return back()->with('error', 'Ошибка при создании заказа. Попробуйте позже.');
            }
        } else {
            // Для незарегистрированных - отправляем на почту
            $params['items'] = $itemsForEmail; // Используем расширенную информацию для email
            $email = $this->etp->GetBaseData()['email'];
            Mail::to($email)->send(new OrderMail($params));

            // Очистка корзины происходит на клиенте через JavaScript

            return redirect()->route('pages.main')
                ->with('success', 'Заказ отправлен на обработку. Мы свяжемся с вами в ближайшее время.');
        }
    }

    public function show(string $id)
    {
        $order = $this->etp->GetOrderCard(['guid' => $id]);

        return view('etp.orders.show', compact('order'));
    }

    public function edit(string $id)
    {
        $offers = session('cart', []);
        return view('etp.orders.edit', compact('offers'));
    }

    public function update(Request $request, string $id)
    {
        $offerGuid = $id;
        $variantGuid = $request->input('variantGuid');
        $quantity = (int) $request->input('quantity');

        $cart = session('cart', []);

        $key = $offerGuid . '#' . $variantGuid;

        if ($quantity === 0) {
            unset($cart[$key]);
        } else {
            $cart[$key] = [
                'offerGuid' => $offerGuid,
                'variantGuid' => $variantGuid,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]);

        return back();
    }

    public function destroy(string $id) {}


    public function basket()
    {
        return view('etp.orders.basket');
    }
}
