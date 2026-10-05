<?php

namespace App\Http\Controllers\Enterprice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function index()
    {
        $userGuid = session('user')['guid'];

        $contractors = $this->etp->GetContractorsList([
            'userGuid' => $userGuid
        ]);

        $breadcrumbs = [
            ['title' => 'Личный кабинет', 'url' => route('auth.main')],
            ['title' => 'Мои контрагенты']
        ];

        return view('enterprise.contractors.index', compact('contractors', 'breadcrumbs'));
    }

    // public function create() {}

    // public function store(Request $request) {}

    public function show(string $guid)
    {
        $contractor = $this->etp->GetContractorCard([
            'guid' => $guid
        ]);

        $breadcrumbs = [
            ['title' => 'Личный кабинет', 'url' => route('auth.main')],
            ['title' => 'Мои контрагенты', 'url' => route('contractors.index')],
            ['title' => $contractor['name']]
        ];

        return view('enterprise.contractors.show', compact('contractor', 'breadcrumbs'));
    }

    // public function edit(string $id) {}

    // public function update(Request $request, string $id) {}

    // public function destroy(string $id) {}

    public function orders(Request $request)
    {
        $userGuid = session('user')['guid'];

        $contractors = $this->etp->GetContractorsList([
            'userGuid' => $userGuid
        ]);

        $orders = [];
        if ($request['contractor']) {
            $orders = $this->etp->GetOrdersByContractor([
                'contractorGuid' => $request['contractor']
            ]);
        }
        //  else {
        //     $orders = $this->etp->GetOrdersByContractor(['userGuid' => $userGuid]);
        // }

        $breadcrumbs = [
            ['title' => 'Личный кабинет', 'url' => route('auth.main')],
            ['title' => 'Мои контрагенты', 'url' => route('contractors.index')],
            ['title' => 'История заказов']
        ];

        return view('enterprise.contractors.orders', compact('contractors', 'orders', 'breadcrumbs'));
    }

    public function offers(Request $request)
    {
        $userGuid = session('user')['guid'];
        $contractors = $this->etp->GetContractorsList([
            'userGuid' => $userGuid
        ]);

        $offers = [];
        if ($request['contractor']) {
            $offers = $this->etp->GetOffersByContractor($request['contractor']);
        }

        $breadcrumbs = [
            ['title' => 'Личный кабинет', 'url' => route('auth.main')],
            ['title' => 'Мои контрагенты', 'url' => route('contractors.index')],
            ['title' => 'История товаров']
        ];

        return view('enterprise.contractors.offers', compact('contractors', 'offers', 'breadcrumbs'));
    }

    public function prices(Request $request)
    {
        $userGuid = session('user')['guid'];
        $contractors = $this->etp->GetContractorsList(['userGuid' => $userGuid]);

        // if ($request['contractor']) {
        //     $contractor = $this->etp->GetContractorCard(['guid' => $request['contractor']]);
        // }

        $terms = [];
        if ($request['contractor']) {
            $terms = $this->etp->getDealsByContractor($request['contractor']);
        }

        $offers = [];
        if ($request['deal']) {
            $offers = $this->etp->getDealByGuid($request['deal'])['offers'];
        }

        $breadcrumbs = [
            ['title' => 'Личный кабинет', 'url' => route('auth.main')],
            ['title' => 'Мои контрагенты', 'url' => route('contractors.index')],
            ['title' => 'Персональные цены']
        ];

        return view('enterprise.contractors.prices', compact('contractors', 'breadcrumbs', 'terms', 'offers'));
    }
}
