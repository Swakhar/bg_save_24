<?php

namespace Webkul\Product\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Webkul\Product\Repositories\ProductRepository;

class SearchRepository extends Repository
{
    /**
     * ProductRepository object
     *
     * @return Object
     */
    protected $productRepository;

    /**
     * Create a new repository instance.
     *
     * @param  Webkul\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        App $app
    )
    {
        parent::__construct($app);

        $this->productRepository = $productRepository;
    }

    function model()
    {
        return 'Webkul\Product\Contracts\Product';
    }

    public function search($data)
    {
        $query = parse_url(request()->getRequestUri(), PHP_URL_QUERY);
        $searchTerm = explode("?", $query);
        $serachQuery = '';

        foreach($searchTerm as $term){
            if (strpos($term, 'term') !== false) {
                $serachQuery = last(explode("=", $term));
            }
        }

        $products = $this->product->searchProductByAttribute($serachQuery);

        return $products;
    }
}