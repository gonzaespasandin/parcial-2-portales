<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        Blade::if('admin', function () 
        {
            return request()->user() && request()->user()->isAdmin();
        });
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        Paginator::useBootstrapFive();
    }
}
