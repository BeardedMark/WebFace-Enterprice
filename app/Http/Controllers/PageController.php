<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\ExtensionService;
use App\Domains\OData\Services\ODataService;

class PageController extends Controller
{
    protected $extansion;
    protected $odata;
    protected $odataEntity = "Catalog_Контрагенты";

    public function __construct(ExtensionService $extansion, ODataService $odata)
    {
        $this->extansion = $extansion;
        $this->odata = $odata;
    }

    public function main()
    {
        $stats = [];//$this->extansion->getBaseStatistics();
        return view('pages.main', compact('stats'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contacts()
    {
        $organisation = [];//$this->extansion->getBaseStatistics();
        return view('pages.contacts', compact('organisation'));
    }

    public function feed()
    {
        $feed = $this->extansion->getBaseFeed();
        return view('pages.feed', compact('feed'));
    }

    public function enterprice()
    {
        return view('pages.enterprice');
    }

    public function extension()
    {
        $json = file_get_contents(resource_path('data/extension-methods.json'));
        $methods = json_decode($json, true);

        return view('pages.extension', compact('methods'));
    }
}
