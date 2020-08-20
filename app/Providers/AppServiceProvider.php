<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view)
        {
            if (env("APP_ENV") == 'local') {
                View::share('relative_path', '');
                View::share('server_path_from', '');
                View::share('version', '3.0.0');
            } else {
                View::share('relative_path', '/public/');
                View::share('server_path_from', '/public/');
                View::share('version', '3.0.0');
            }

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
