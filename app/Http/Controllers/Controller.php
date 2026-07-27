<?php

namespace App\Http\Controllers;

use App\Services\EnterpriceService;

abstract class Controller
{
    protected $etp;

    public function __construct(EnterpriceService $etp)
    {
        $this->etp = $etp;
    }
}
