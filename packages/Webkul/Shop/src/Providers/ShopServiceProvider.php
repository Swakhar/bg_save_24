<?php

namespace Webkul\Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Webkul\Shop\Http\Middleware\Locale;
use Webkul\Shop\Http\Middleware\Theme;
use Webkul\Shop\Http\Middleware\Currency;
use Webkul\Core\Tree;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'shop');

        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('themes/default/assets'),
        ], 'public');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'shop');

        $router->aliasMiddleware('locale', Locale::class);
        $router->aliasMiddleware('theme', Theme::class);
        $router->aliasMiddleware('currency', Currency::class);

        $this->composeView();

        Paginator::defaultView('shop::partials.pagination');
        Paginator::defaultSimpleView('shop::partials.pagination');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Bind the the data to the views
     *
     * @return void
     */
    protected function composeView()
    {
        view()->composer('shop::customers.account.partials.customersidemenu', function ($view) {
            $customerTree  = Tree::create();

            foreach (config('menu.customer') as $item) {
                $customerTree ->add($item, 'menu');
            }

            $customerTree ->items = core()->sortItems($customerTree ->items);

            $view->with('menu', $customerTree );
        });

        view()->composer('shop::customers.account.partials.sellersidemenu', function ($view) {
            $sellerTree = Tree::create();

            foreach (config('menu.seller') as $item) {
                $sellerTree->add($item, 'menu');
            }
            $sellerTree->items = core()->sortItems($sellerTree->items);
            $view->with('menu', $sellerTree);
        });

        view()->composer(['shop::sellers.product.create'], function ($view) {
            $items = array();

            foreach (config('product_types') as $item) {
                $item['children'] = [];

                array_push($items, $item);
            }

            $types = core()->sortItems($items);

            $view->with('productTypes', $types);
        });
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menus/customer.php', 'menu.customer'
        );
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menus/seller.php', 'menu.seller'
        );
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/product_types.php', 'product_types'
        );
    }
}