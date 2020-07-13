<?php

namespace Webkul\Velocity\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Webkul\Velocity\Http\Shop\Controllers;
use Webkul\Checkout\Contracts\Cart as CartModel;
use Cart;

class ShopController extends Controller
{
    /**
     * Index to handle the view loaded with the search results
     *
     * @return \Illuminate\View\View
     */
    public function search()
    {
        $results = $this->velocityProductRepository->searchProductsFromCategory(request()->all());

        return view($this->_config['view'])->with('results', $results ? $results : null);
    }

    public function HomePageGetMixCategory()
    {
        $data = \Illuminate\Support\Facades\DB::select("SELECT mix_customize_section_master.id, 
            mix_customize_section_master.title,
            mix_customize_section_master.slug, 
            mix_customize_section_details.title detail_title,
            mix_customize_section_details.slug details_slug,
            mix_customize_section_details_child.label, 
            mix_customize_section_details_child.rule_operator,
            CASE 
                WHEN mix_customize_section_details_child.show_multi_select = 1 THEN
                    mix_customize_child_multi_value.multi_value
                ELSE
                    mix_customize_section_details_child.rule_value
            END rule_value, mix_customize_section_details.id details_id,
            mix_customize_section_details_child.id details_child_id
            FROM mix_customize_section_master
            left JOIN mix_customize_section_details on 
            mix_customize_section_details.master_section_id = mix_customize_section_master.id
            left join mix_customize_section_details_child on 
            mix_customize_section_details_child.details_row_id = mix_customize_section_details.id
            left join mix_customize_child_multi_value on 
            mix_customize_child_multi_value.child_id = mix_customize_section_details_child.id
            ORDER BY mix_customize_section_master.id, mix_customize_section_details.id, mix_customize_section_details_child.id");

        $main_array = [];
        $i = 0;
        foreach ($data as $key => $value) {
            $main_array[$value->id]['title'] = $value->title;
            $main_array[$value->id]['slug'] = $value->slug;

            $main_array[$value->id]['details'][$value->details_id]['details_title'] = $value->detail_title;
            $main_array[$value->id]['details'][$value->details_id]['details_slug'] = $value->details_slug;
            $main_array[$value->id]['details'][$value->details_id]['price_range_span'] = "";
            $main_array[$value->id]['details'][$value->details_id]['category_brand_span'] = [];

            $main_array[$value->id]['details'][$value->details_id]['child'][$value->details_child_id][$value->label][$i]['label'] = $value->label;
            $main_array[$value->id]['details'][$value->details_id]['child'][$value->details_child_id][$value->label][$i]['rule_operator'] = $value->rule_operator;
            $main_array[$value->id]['details'][$value->details_id]['child'][$value->details_child_id][$value->label][$i]['rule_value'] = $value->rule_value;
            $i += 1;
        }
        $list = ['Categories', 'Attribute Family'];
        foreach ($main_array as $key => $value) {
            if (count($value['details']) > 0) {
                foreach ($value['details'] as $key2 => $value2) {
                    if (count($value2['child']) > 0) {
                        foreach ($value2['child'] as $key3 => $value3) {
                            foreach ($value3 as $key4 => $value4) {
                                if ($key4 == "Categories") {
                                    $main_array[$key]['details'][$key2]['category_brand_span'][] = $this->homePageCustomizeHelper->GetCategoryString($value3);
                                } else if ($key4 == "Attribute Family") {

                                } else {
                                    $main_array[$key]['details'][$key2]['category_brand_span'][] = $this->homePageCustomizeHelper->GetAttributeString($value3);
                                }
                            }

                        }
                    }
                }
            }
        }
        return $main_array;
    }

    public function fetchProductDetails($slug)
    {
        $product = $this->productRepository->findBySlug($slug);

        if ($product) {
            $productReviewHelper = app('Webkul\Product\Helpers\Review');

            $galleryImages = $this->productImageHelper->getProductBaseImage($product);

            $response = [
                'status'  => true,
                'details' => [
                    'name'         => $product->name,
                    'urlKey'       => $product->url_key,
                    'priceHTML'    => $product->getTypeInstance()->getPriceHtml(),
                    'totalReviews' => $productReviewHelper->getTotalReviews($product),
                    'rating'       => ceil($productReviewHelper->getAverageRating($product)),
                    'image'        => $galleryImages['small_image_url'],
                ]
            ];
        } else {
            $response = [
                'status' => false,
                'slug'   => $slug,
            ];
        }

        return $response;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function categoryDetails()
    {
        $slug = request()->get('category-slug');

        switch ($slug) {
            case 'new-products':
            case 'featured-products':
                $formattedProducts = [];
                $count = request()->get('count');

                if ($slug == "new-products") {
                    $products = $this->velocityProductRepository->getNewProducts($count);
                } else if ($slug == "featured-products") {
                    $products = $this->velocityProductRepository->getFeaturedProducts($count);
                }

                foreach ($products as $product) {
                    array_push($formattedProducts, $this->velocityHelper->formatProduct($product));
                }

                $response = [
                    'status'   => true,
                    'products' => $formattedProducts,
                ];

                break;
            default:
                $categoryDetails = $this->categoryRepository->findByPath($slug);

                if ($categoryDetails) {
                    $list = false;
                    $customizedProducts = [];
                    $products = $this->productRepository->getAll($categoryDetails->id);

                    foreach ($products as $product) {
                        $productDetails = [];

                        $productDetails = array_merge($productDetails, $this->velocityHelper->formatProduct($product));

                        array_push($customizedProducts, $productDetails);
                    }

                    $response = [
                        'status'           => true,
                        'list'             => $list,
                        'categoryDetails'  => $categoryDetails,
                        'categoryProducts' => $customizedProducts,
                    ];
                }

                break;
        }

        return $response ?? [
            'status' => false,
        ];
    }

    /**
     * @return array
     */
    public function fetchCategories()
    {
        $formattedCategories = [];
        $categories = $this->categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);

        foreach ($categories as $category) {
            array_push($formattedCategories, $this->getCategoryFilteredData($category));
        }

        return [
            'status'     => true,
            'categories' => $formattedCategories,
        ];
    }

    /**
     * @param  string  $slug
     * @return array
     */
    public function fetchFancyCategoryDetails($slug)
    {
        $categoryDetails = $this->categoryRepository->findByPath($slug);

        if ($categoryDetails) {
            $response = [
                'status'          => true,
                'categoryDetails' => $this->getCategoryFilteredData($categoryDetails)
            ];
        }

        return $response ?? [
            'status' => false,
        ];
    }

    /**
     * @param  \Webkul\Category\Contracts\Category  $category
     * @return array
     */
    private function getCategoryFilteredData($category)
    {
        $formattedChildCategory = [];

        foreach ($category->children as $child) {
            array_push($formattedChildCategory, $this->getCategoryFilteredData($child));
        }

        return [
            'id'                 => $category->id,
            'slug'               => $category->slug,
            'name'               => $category->name,
            'children'           => $formattedChildCategory,
            'category_icon_path' => $category->category_icon_path,
        ];
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getWishlistList()
    {
        return view($this->_config['view']);
    }

    /**
     * this function will provide the count of wishlist and comparison for logged in user
     *
     * @return \Illuminate\Http\Response
     */
    public function getItemsCount()
    {
        if ($customer = auth()->guard('customer')->user()) {
            $wishlistItemsCount = $this->wishlistRepository->count([
                'customer_id' => $customer->id,
                'channel_id'  => core()->getCurrentChannel()->id,
            ]);

            $comparedItemsCount = $this->compareProductsRepository->count([
                'customer_id' => $customer->id,
            ]);

            $response = [
                'status' => true,
                'compareProductsCount'    => $comparedItemsCount,
                'wishlistedProductsCount' => $wishlistItemsCount,
            ];
        }

        return response()->json($response ?? [
            'status' => false
        ]);
    }

    /**
     * This function will provide details of multiple product
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetailedProducts()
    {
        // for product details
        if ($items = request()->get('items')) {
            $moveToCart = request()->get('moveToCart');

            $productCollection = $this->velocityHelper->fetchProductCollection($items, $moveToCart);

            $response = [
                'status'   => 'success',
                'products' => $productCollection,
            ];
        }

        return response()->json($response ?? [
            'status' => false
        ]);
    }

    public function getCategoryProducts($categoryId)
    {
        $products = $this->productRepository->getAll($categoryId);

        $productItems = $products->items();
        $productsArray = $products->toArray();

        if ($productItems) {
            $formattedProducts = [];

            foreach ($productItems as $product) {
                array_push($formattedProducts, $this->velocityHelper->formatProduct($product));
            }

            $productsArray['data'] = $formattedProducts;
        }

        return response()->json($response ?? [
            'products'       => $productsArray,
            'paginationHTML' => $products->appends(request()->input())->links()->toHtml(),
        ]);
    }
}
