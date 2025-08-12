<?php

namespace App\Domains\OData\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Domains\OData\Services\ODataService;
use App\Domains\OData\Instances\EntityInstance;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ODataController extends Controller
{
    protected $odata;

    public function __construct(ODataService $odata)
    {
        $this->odata = $odata;
    }

    public function dashboard()
    {
        $entities = $this->odata->catalog();
        return view('odata.dashboard', compact('entities'));
    }

    public function index($entity)
    {
        $items = $this->odata->list($entity);
        $entity = new EntityInstance(['name' => $entity]);

        return view('odata.index', compact('items', 'entity'));
    }

    public function show($entity, $id)
    {
        $item = $this->odata->get($entity, $id);
        $entity = new EntityInstance(['name' => $entity]);

        return view('odata.show', compact('item', 'entity'));
    }

    public function create($entity)
    {
        return view('odata.form', ['entity' => $entity, 'item' => []]);
    }

    public function store(Request $request, $entity)
    {
        $this->odata->create($entity, $request->all());
        return redirect()->route('odata.index', $entity);
    }

    public function edit($entity, $id)
    {
        $item = $this->odata->get($entity, $id);
        return view('odata.form', compact('item', 'entity'));
    }

    public function update(Request $request, $entity, $id)
    {
        $this->odata->update($entity, $id, $request->all());
        return redirect()->route('odata.index', $entity);
    }

    public function destroy($entity, $id)
    {
        $this->odata->delete($entity, $id);
        return redirect()->route('odata.index', $entity);
    }

    public function ping()
    {
        $start = microtime(true);

        try {
            $response = Http::withOptions(['verify' => false])
                ->withBasicAuth(config('odata.username'), config('odata.password'))
                ->get(config('odata.base_url'));

            $status = $response->ok() ? 'ok' : 'fail';
        } catch (\Throwable $e) {
            $status = 'error';
        }

        $elapsed = round((microtime(true) - $start) * 1000, 1); // мс

        return response()->json([
            'status' => $status,
            'time' => $elapsed,
        ]);
    }
}
