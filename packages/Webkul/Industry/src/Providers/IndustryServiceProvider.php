<?php

namespace Webkul\Industry\Providers;

use Illuminate\Support\ServiceProvider;


class IndustryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

    }

    /**
     * Register services.
     *
     * @param  string  $path
     * @return void
     */
    public function register()
    {
        
    }
}