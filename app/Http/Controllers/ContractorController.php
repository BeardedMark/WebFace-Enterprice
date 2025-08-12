<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExtensionService;
use App\Domains\OData\Services\ODataService;

class ContractorController extends Controller
{
    protected $extansion;
    protected $odata;
    protected $odataEntity = "Catalog_Контрагенты";

    public function __construct(ExtensionService $extansion, ODataService $odata)
    {
        $this->extansion = $extansion;
        $this->odata = $odata;
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

        $odata = []; //$this->odata->get($this->odataEntity, $id);

        return view('db.contractors.show', compact('contractor', 'orders', 'prices', 'odata'));
    }
    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
