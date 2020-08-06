<?php

namespace Webkul\Blog\Providers;

use Illuminate\Support\ServiceProvider;


class BlogServiceProvider extends ServiceProvider
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