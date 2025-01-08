<?php

namespace App\Providers;

use App\Http\Middleware\InternalAPI;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        ### InternalAPI Middleware
        $this->app->singleton(
            InternalAPI::class,
            static fn() => new InternalAPI(config('internal_api.default'))
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
