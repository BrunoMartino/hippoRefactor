<?php

namespace App\Providers;

use App\Models\Menu;
use App\Policies\MenuPolicy;
use App\Services\ApiWhatsappService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [

    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiWhatsappService::class, function ($app) {
            return new ApiWhatsappService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();
    }
}
