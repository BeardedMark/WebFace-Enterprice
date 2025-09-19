<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExtensionService;

class ContractorController extends Controller
{
    protected $extansion;

    public function __construct(ExtensionService $extansion)
    {
        $this->extansion = $extansion;
    }

    public function index()
    {
        $user = session('user');
        $contractors = $this->extansion->getContractorsByUser(['userGuid' => $user['guid']]);

        return view('db.contractors.index', compact('contractors'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $id)
    {
        $contractor = $this->extansion->GetContractorCard(['guid' => $id]);
        $orders = $this->extansion->GetCustomerOrdersByContractor(['guid' => $id]);
        $prices = $this->extansion->listPriceByContractor(['guid' => $id]);

        return view('db.contractors.show', compact('contractor', 'orders', 'prices'));
    }
    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
