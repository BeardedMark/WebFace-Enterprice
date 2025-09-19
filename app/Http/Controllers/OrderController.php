<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExtensionService;
use App\Services\AntibotService;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $extansion;

    public function __construct(ExtensionService $extansion)
    {
        $this->extansion = $extansion;
    }

    public function index(Request $request)
    {
        $user = session('user');
        $contractors = $this->extansion->getContractorsByUser(['userGuid' => $user['guid']]);

        if (!empty($request['guid'])) {
            $orders = $this->extansion->GetCustomerOrdersByContractor(['guid' => $request['guid']]);
        } else {
            $orders = $this->extansion->listOrdersByUserGuid(['userGuid' => $user['guid']]);
        }

        return view('db.orders.index', compact('contractors', 'orders'));
    }

    public function create()
    {
        $user = session('user');
        $contractors = null;

        if ($user) {
            $contractors = $this->extansion->getContractorsByUser(['userGuid' => $user['guid']]);
            $offers = session('basket', []);
        } else {
            $offers = session('basket', []);
        }

        return view('db.orders.create', compact('offers', 'contractors'));
    }

    public function store(Request $request)
    {
        AntibotService::check($request);
        $rawItems = session('basket');

        $finalItems = [];

        foreach ($rawItems as $key => $data) {
            if (!empty($order['OrderGuid']) && $data['postponed']) {
                continue;
            }

            // $quantity = max(1, min((int)($data['quantity'] ?? 1), 100)); // защита min/max
            $finalItems[] = [
                'guidOffer' => $data['offerGuid'],
                'guidVariant' => $data['variantGuid'],
                'count' => $data['quantity'],
                'price' => $data['quantity'],
            ];
        }

        $params = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'inn' => $request['inn'],

            'guidContractor' => $request['guidContractor'],
            'deliveryType' => $request['deliveryType'],
            'items' => $finalItems,
            'addres' => $request['addres'],
            'date' => $request['date'],
            'fromTime' => $request['fromTime'],
            'toTime' => $request['toTime'],
            'commentary' => $request['commentary'],
        ];


        if (session('user')) {
            $order = $this->extansion->PostCustomerOrderByContractor($params);
        } else {
            $email = config('settings.contacts.email');
            Mail::to($email)->send(new OrderMail($params));
        }

        if (!empty($order['OrderGuid'])) {
            $oldBasket = session('basket', []);
            $newBasket = [];

            foreach ($oldBasket as $key => $item) {
                if (!empty($item['postponed'])) {
                    $item['postponed'] = false;
                    $newBasket[$key] = $item;
                }
            }

            session(['basket' => $newBasket]);

            return redirect()->route('orders.show', $order['OrderGuid']);
        }

        return redirect()->route('basket.index');
    }

    public function show(string $id)
    {
        $order = $this->extansion->cardOrderByGuid(['guid' => $id]);

        return view('db.orders.show', compact('order'));
    }

    public function edit(string $id)
    {
        $offers = session('cart', []);
        return view('db.orders.edit', compact('offers'));
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

    public function destroy(string $id)
    {
        //
    }
}
