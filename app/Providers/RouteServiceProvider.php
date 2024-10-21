<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';

    // protected $namespace = 'App\\Http\\Controllers';

    public function boot()
    {
        foreach (config('tenancy.central_domains') as $domain) {
            Route::middleware('web')->domain($domain)->namespace($this->namespace)->group(base_path('routes/Central/dashboard.php'));
            Route::middleware('web')->domain($domain)->namespace($this->namespace)->group(base_path('routes/Central/client.php'));
            Route::middleware('web')->domain($domain)->namespace($this->namespace)->group(base_path('routes/Central/web.php'));
            Route::middleware('api')->domain($domain)->namespace($this->namespace)->group(base_path('routes/Central/api.php'));
        }

        $this->routes(function () {
            Route::prefix('api')->middleware('api')->namespace($this->namespace)->group(base_path('routes/Central/api.php'));
            Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/Central/dashboard.php'));
            Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/Central/client.php'));
            Route::middleware('web')->namespace($this->namespace)->group(base_path('routes/Central/web.php'));
        });
    }
}
