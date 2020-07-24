<?php

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
    Route::namespace('Webkul\Velocity\Http\Controllers\Shop')->group(function () {

        Route::get('/category-list', function () {
           $data = \Illuminate\Support\Facades\DB::table('category_translations')
               ->select(\Illuminate\Support\Facades\DB::raw('name, category_id id'))
               ->orderBy('name')
                ->get();
           return [
               'categories' => $data
           ];
        })->name('category-list');

        Route::get('/mix-category-item-front', 'ShopController@HomePageGetMixCategory')->name('mix-category-home-page');

        Route::get('/customize-section-home-page', 'ShopController@CustomizeSectionHomePage')->name('customize-section-home-page');

        Route::get('/get-slider-data-home-page', 'ShopController@GetSliderDataHome')->name('get-slider-data-home-page');
        Route::get('/get-data-add-panel-second', 'ShopController@GetAddPanelSecond')->name('get-data-add-panel-second');
        Route::get('/get-data-add-panel-first', 'ShopController@GetAddPanelFirst')->name('get-slider-data-home-first');
        Route::get('/get-slider-add-section', 'ShopController@GetSliderAddSection')->name('get-slider-add-section');

        Route::get('/mix-category-item/{slug}', function ($slug) {
//            return $slug;
            $data = \Illuminate\Support\Facades\DB::select("SELECT mix_customize_section_details.slug, 
            mix_customize_section_details.title,
            mix_customize_section_details_child.label, mix_customize_section_details_child.rule_operator,
            mix_customize_section_details_child.rule_value, mix_customize_section_details_child.show_multi_select
            FROM mix_customize_section_details
            INNER JOIN mix_customize_section_details_child ON mix_customize_section_details_child.details_row_id = 
            mix_customize_section_details.ID
            WHERE slug = '$slug'");

            $label_to_column_map = [
                'Price' => 'product_flat.price',
            ];

            $prod = [];

            foreach ($data as $key => $value) {
                $prod['rule'][$value->label] = $value->rule_operator;
                $prod['label'][$value->label] = $value->label;
//              return  $filtered = strtolower(preg_replace('/[\W\s\/]+/', '-', $value->rule_value));
                $prod['value'][$value->label] = $value->show_multi_select == 1 ? implode(',', json_decode($value->rule_value)) : $value->rule_value;
            }
            $sql = "";
            if (count($prod) > 0) {
                if (array_key_exists('Categories', $prod['value'])) {
                    $sql = "SELECT product_flat.id, product_flat.sku, product_flat.name, product_flat.url_key, 
                    product_flat.new, product_flat.featured, product_flat.status, product_flat.thumbnail,
                    price, product_flat.cost, product_flat.special_price,
                    special_price_from, product_flat.special_price_to, product_flat.weight FROM product_categories
                    INNER JOIN product_flat on product_flat.id = product_categories.product_id
                    WHERE category_id in (" . $prod['value']['Categories'] .")";
                } else {
                    $sql = "SELECT product_flat.id, product_flat.sku, product_flat.name, product_flat.url_key, 
                    product_flat.new, product_flat.featured, product_flat.status, product_flat.thumbnail,
                    price, product_flat.cost, product_flat.special_price,
                    special_price_from, product_flat.special_price_to, product_flat.weight FROM product_flat where product_flat.id > 0 ";
                }
                foreach ($prod['value'] as $key => $value) {
                    if ($key != "Categories") {
                        $sql .= " AND $label_to_column_map[$key] " . $prod['rule'][$key] . " $value";
                    }
                }
            }
            return $product = \Illuminate\Support\Facades\DB::select($sql);

        })->name('mix-category-item');

        Route::get('/recommended-slider', function () {
            $formattedProducts = [];
            $products = \Webkul\Product\Models\ProductFlat::select(DB::raw('product_flat.*, t1.name slider_name, 
            category_translations.name category_name, t1.id slider_id, home_sliders.id home_slider_id'))
                ->join('slider_name_master as t1', function($join) {
                    $join->where('t1.slider_type', '=', 1);
                })
                ->join('home_sliders', 'home_sliders.slider_name_master_id', '=', 't1.id')
                ->join('category_translations', 'category_translations.category_id', '=', 'home_sliders.category_id')
                ->join('home_slider_products', function($join) {
                    $join->on('home_slider_products.home_slider_id', '=', 'home_sliders.id');
                    $join->on('home_slider_products.product_id', '=', 'product_flat.product_id');
                })
                ->get();

            foreach ($products as $product) {
                $velocityHelper = app('Webkul\Velocity\Helpers\Helper');
                $array = $velocityHelper->formatProduct($product);
                $array['slider_name'] = $product->slider_name;
                $array['category_name'] = $product->category_name;
                $array['slider_id'] = $product->slider_id;
                $array['home_slider_id'] = $product->home_slider_id;
                array_push($formattedProducts, $array);
            }
            $slider = [];
            $slider_name = "";
            foreach ($formattedProducts as $key => $value) {
                $slider_name = $value['slider_name'];
                $slider[$value['home_slider_id']]['category_name'] = $value['category_name'];
                $slider[$value['home_slider_id']]['slider_name'] = $value['slider_name'];
                $slider[$value['home_slider_id']]['slider_id'] = $value['slider_id'];
                $slider[$value['home_slider_id']]['products'][] = $value;
            }
            return $slider;
        })->name('velocity.shop.product');

        Route::get('/product-details/{slug}', 'ShopController@fetchProductDetails')
            ->name('velocity.shop.product');

        Route::get('/categorysearch', 'ShopController@search')
            ->name('velocity.search.index')
            ->defaults('_config', [
                'view' => 'shop::search.search'
            ]);

        Route::get('/categories', 'ShopController@fetchCategories')
        ->name('velocity.categoriest');

        Route::get('/category-details', 'ShopController@categoryDetails')
            ->name('velocity.category.details');

        Route::get('/fancy-category-details/{slug}', 'ShopController@fetchFancyCategoryDetails')->name('velocity.fancy.category.details');

        Route::get('/mini-cart', 'CartController@getMiniCartDetails')
            ->name('velocity.cart.get.details');

        Route::post('/cart/add', 'CartController@addProductToCart')
            ->name('velocity.cart.add.product');

        Route::delete('/cart/remove/{id}', 'CartController@removeProductFromCart')
            ->name('velocity.cart.remove.product');

        Route::get('/comparison', 'ComparisonController@getComparisonList')
            ->name('velocity.product.compare')
            ->defaults('_config', [
                'view' => 'shop::guest.compare.index'
            ]);

        Route::group(['middleware' => ['customer']], function () {
            Route::get('/customer/account/comparison', 'ComparisonController@getComparisonList')
                ->name('velocity.customer.product.compare')
                ->defaults('_config', [
                    'view' => 'shop::customers.account.compare.index'
                ]);
        });

        Route::put('/comparison', 'ComparisonController@addCompareProduct')
            ->name('customer.product.add.compare');

        Route::delete('/comparison', 'ComparisonController@deleteComparisonProduct')
            ->name('customer.product.delete.compare');

        Route::get('/guest-wishlist', 'ShopController@getWishlistList')
            ->name('velocity.product.guest-wishlist')
            ->defaults('_config', [
                'view' => 'shop::guest.wishlist.index'
            ]);

        Route::get('/items-count', 'ShopController@getItemsCount')
            ->name('velocity.product.details');

        Route::get('/detailed-products', 'ShopController@getDetailedProducts')
            ->name('velocity.product.details');

        Route::get('/category-products/{categoryId}', 'ShopController@getCategoryProducts')
            ->name('velocity.category.products');
    });
});