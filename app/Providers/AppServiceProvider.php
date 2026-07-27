<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Services\EnterpriceService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Только если не запущен консольный скрипт (например, при миграциях)
        if ($this->app->runningInConsole()) return;

        try {
            $etp = app(EnterpriceService::class);
            $baseData = $etp->GetBaseData();

            View::share('baseData', $baseData);
        } catch (\Throwable $e) {
            // Можно логировать, или заглушку отдать
            View::share('baseData', []);
        }
    }
}
