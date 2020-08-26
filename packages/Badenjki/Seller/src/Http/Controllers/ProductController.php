<?php

namespace Badenjki\Seller\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Webkul\Category\Models\Category;
use Webkul\Product\Http\Requests\ProductForm;
use Webkul\Product\Helpers\ProductType;
use Webkul\Product\Models\ProductImage;
use Webkul\Tag\Repositories\TagRepository;
use Webkul\Manufacturer\Repositories\ManufacturerRepository;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Models\Product;
use Webkul\Product\Repositories\ProductDownloadableLinkRepository;
use Webkul\Product\Repositories\ProductDownloadableSampleRepository;
use Webkul\Attribute\Repositories\AttributeFamilyRepository;
use Webkul\Inventory\Repositories\InventorySourceRepository;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected $_config;

    protected $categoryRepository;

    protected $productRepository;

    protected $productDownloadableLinkRepository;

    protected $productDownloadableSampleRepository;

    protected $attributeFamilyRepository;

    protected $inventorySourceRepository;

    protected $tagRepository;

    protected $manufacturerRepository;

    /**
     * StoreRepository object
     *
     * @var array
     */

    public function __construct(
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository,
        ManufacturerRepository $manufacturerRepository,
        ProductRepository $productRepository,
        ProductDownloadableLinkRepository $productDownloadableLinkRepository,
        ProductDownloadableSampleRepository $productDownloadableSampleRepository,
        AttributeFamilyRepository $attributeFamilyRepository,
        InventorySourceRepository $inventorySourceRepository
    )
    {
        $this->_config = request('_config');

        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->manufacturerRepository = $manufacturerRepository;

        $this->productRepository = $productRepository;

        $this->productDownloadableLinkRepository = $productDownloadableLinkRepository;

        $this->productDownloadableSampleRepository = $productDownloadableSampleRepository;

        $this->attributeFamilyRepository = $attributeFamilyRepository;

        $this->inventorySourceRepository = $inventorySourceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $families = $this->attributeFamilyRepository->all();

        $configurableFamily = null;
        $configurable_attributes = [];

        if ($familyId = request()->get('family')) {
            $configurableFamily = $this->attributeFamilyRepository->find($familyId);

            foreach ($configurableFamily->configurable_attributes as $key => $value) {
                $configurable_attributes[$key]['admin_name'] = $value->admin_name;
                $configurable_attributes[$key]['code'] = $value->code;
                $configurable_attributes[$key]['options'] = $value->options;
                $configurable_attributes[$key]['name'] = '';
            }
        }

        return view($this->_config['view'], compact('families', 'configurableFamily', 'configurable_attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $customer = auth()->guard('customer')->user();
         if (! request()->get('family')
            && ProductType::hasVariants(request()->input('type'))
            && request()->input('sku') != ''
        ) {
            return redirect(url()->current() . '?type=' . request()->input('type') . '&family=' . request()->input('attribute_family_id') . '&sku=' . request()->input('sku'));
        }

        if (ProductType::hasVariants(request()->input('type'))
            && (! request()->has('super_attributes')
            || ! count(request()->get('super_attributes')))
        ) {
            session()->flash('error', trans('admin::app.catalog.products.configurable-error'));

            return back();
        }

        $this->validate(request(), [
            'type'                => 'required',
            'attribute_family_id' => 'required',
            'sku'                 => ['required', 'unique:products,sku', new \Webkul\Core\Contracts\Validations\Slug],
        ]);

        $product = $this->productRepository->create(request()->all());

        $new_product = Product::find($product->id);
        $new_product->store_id = $customer->store_id;
        $new_product->save();

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Product']));

        return redirect()->route($this->_config['redirect'], ['id' => $product->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        return $store->title;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->with(['variants', 'variants.inventories', 'variants.images'])->findOrFail($id);

        $local = request()->get('locale') ?: app()->getLocale();
        $categories = Category::CategoryRawData($local);

        $inventorySources = $this->inventorySourceRepository->all();
        $tags = $this->tagRepository->orderBy('id','desc')->get();
        $manufacturers = $this->manufacturerRepository->orderBy('id','desc')->get();

        return view($this->_config['view'], compact('product', 'categories', 'inventorySources', 'tags','manufacturers'));
    }

    /**st
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(ProductForm $request, $id)
    {
        $data = request()->all();
        $locale = request()->get('locale') ?: app()->getLocale();

        if (array_key_exists('variants', $data)) {
            foreach ($data['variants'] as $variantId => $variantData) {
                if (request()->hasFile('variants.'.$variantId.'.image')) {
                    ProductImage::where('product_id', $variantId)->delete();
                    ProductImage::create([
                        'path'       => request()->file('variants.'.$variantId.'.image')->store('product/'.$variantId),
                        'product_id' => $variantId,
                    ]);

                }
            }

        }
        else {
            if ($data['special_price'] != null) {
                $basePrice = $data['special_price'];
            } elseif ($data['price'] != null) {
                $basePrice = $data['price'];
            }
            if ($basePrice != null) {
                if (array_key_exists('customer_group_prices', $data)) {
                    foreach ($data['customer_group_prices'] as $key => $value) {
                        if ($value['value_type'] != null) {
                            if ($value['value_type'] == "discount") {
                                if ($value['raw_value'] != null && floatval($value['raw_value']) > 0 && floatval($value['raw_value']) <= 100) {
                                    $discount = $basePrice * floatval($value['raw_value']) / 100;
                                    $discount = $basePrice - $discount;
                                    $data['customer_group_prices'][$key]['value'] = $discount;
                                } else {
                                    return back()->with('error', trans('Invalid discount entry'));
                                }
                            } else if ($value['value_type'] == "fixed") {
                                if ($value['raw_value'] != null && floatval($value['raw_value']) > 0 && floatval($value['raw_value']) <= $basePrice) {
                                    $data['customer_group_prices'][$key]['value'] = $value['raw_value'];
                                } else {
                                    return back()->with('error', trans('Invalid fixed entry'));;
                                }

                                foreach ($data['customer_group_prices'] as $key => $value) {

                                    if ($value['value_type'] != null) {
                                        if ($value['value_type'] == "discount") {
                                            if ($value['raw_value'] != null && floatval($value['raw_value']) > 0 && floatval($value['raw_value']) <= 100) {
                                                $discount = $basePrice * floatval($value['raw_value']) / 100;
                                                $discount = $basePrice - $discount;
                                                $data['customer_group_prices'][$key]['value'] = $discount;
                                            } else {
                                                return back()->with('error', trans('Invalid discount entry'));
                                            }
                                        } else if ($value['value_type'] == "fixed") {
                                            if ($value['raw_value'] != null && floatval($value['raw_value']) > 0 && floatval($value['raw_value']) <= $basePrice) {
                                                $data['customer_group_prices'][$key]['value'] = $value['raw_value'];
                                            } else {
                                                return back()->with('error', trans('Invalid fixed entry'));;
                                            }
                                        }
                                    }
                                }

                            }
                        }
                    }
                }
            }
        }

        $product = $this->productRepository->update(array_merge($data, [ 'locale' => $locale ]), $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Product']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
