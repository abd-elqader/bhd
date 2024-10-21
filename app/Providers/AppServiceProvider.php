<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\PermissionRegistrar;
use Stancl\Tenancy\Events\TenancyBootstrapped;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        view()->composer('*', function () {
            visitor()->visit();
            Event::listen(TenancyBootstrapped::class, function (TenancyBootstrapped $event) {
                PermissionRegistrar::$cacheKey = 'spatie.permission.cache.tenant.'.$event->tenancy->tenant->id;
            });
            Paginator::useBootstrap();
            Event::listen(TenancyBootstrapped::class, function (TenancyBootstrapped $event) {
                PermissionRegistrar::$cacheKey = 'spatie.permission.cache.tenant.'.$event->tenancy->tenant->id;
            });
        });
    }
}
