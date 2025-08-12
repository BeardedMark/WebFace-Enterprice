<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\ExtensionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Только если не запущен консольный скрипт (например, при миграциях)
        if ($this->app->runningInConsole()) return;

        try {
            $extansion = app(ExtensionService::class);
            $baseData = $extansion->getBaseData();

            View::share('baseData', $baseData);
        } catch (\Throwable $e) {
            // Можно логировать, или заглушку отдать
            View::share('baseData', []);
        }
    }
}
