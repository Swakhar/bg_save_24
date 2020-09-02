<?php

namespace Webkul\Product\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Webkul\Category\Models\Category;
use Webkul\Product\Http\Requests\ProductForm;
use Webkul\Product\Helpers\ProductType;
use Webkul\Product\Models\ProductImage;
use Webkul\Tag\Repositories\TagRepository;
use Webkul\Manufacturer\Repositories\ManufacturerRepository;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Repositories\ProductDownloadableLinkRepository;
use Webkul\Product\Repositories\ProductDownloadableSampleRepository;
use Webkul\Attribute\Repositories\AttributeFamilyRepository;
use Webkul\Inventory\Repositories\InventorySourceRepository;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CategoryRepository object
     *
     * @var \Webkul\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * ProductRepository object
     *
     * @var \Webkul\Product\Repositories\ProductRepository
     */
    protected $productRepository;

    /**
     * ProductDownloadableLinkRepository object
     *
     * @var \Webkul\Product\Repositories\ProductDownloadableLinkRepository
     */
    protected $productDownloadableLinkRepository;

    /**
     * ProductDownloadableSampleRepository object
     *
     * @var \Webkul\Product\Repositories\ProductDownloadableSampleRepository
     */
    protected $productDownloadableSampleRepository;

    /**
     * AttributeFamilyRepository object
     *
     * @var \Webkul\Attribute\Repositories\AttributeFamilyRepository
     */
    protected $attributeFamilyRepository;

    /**
     * InventorySourceRepository object
     *
     * @var \Webkul\Inventory\Repositories\InventorySourceRepository
     */
    protected $inventorySourceRepository;
    protected $tagRepository;
    protected $manufacturerRepository;


    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Category\Repositories\CategoryRepository  $categoryRepository
     * @param  \Webkul\Product\Repositories\ProductRepository  $productRepository
     * @param  \Webkul\Product\Repositories\ProductDownloadableLinkRepository  $productDownloadableLinkRepository
     * @param  \Webkul\Product\Repositories\ProductDownloadableSampleRepository  $productDownloadableSampleRepository
     * @param  \Webkul\Attribute\Repositories\AttributeFamilyRepository  $attributeFamilyRepository
     * @param  \Webkul\Inventory\Repositories\InventorySourceRepository  $inventorySourceRepository
     * @return void
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
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
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
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

        $product = $this->productRepository->create(array_merge(request()->all(), [ 'is_active' => 1 ]));

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Product']));

        return redirect()->route($this->_config['redirect'], ['id' => $product->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->productRepository->with(['variants', 'variants.inventories', 'variants.images'])->findOrFail($id);

        $local = request()->get('locale') ?: app()->getLocale();
        $categories = Category::CategoryRawData($local);

        $inventorySources = $this->inventorySourceRepository->all();
        $tags = $this->tagRepository->orderBy('id','desc')->get();
        $manufacturers = $this->manufacturerRepository->orderBy('id','desc')->get();

        return view($this->_config['view'], compact('product', 'categories',
            'inventorySources','tags','manufacturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Webkul\Product\Http\Requests\ProductForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductForm $request, $id)
    {
//        return request()->file('variants');
        $data=request()->all();
//        return json_encode($data);

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

        $product = $this->productRepository->update($data, $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Product']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Uploads downloadable file
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadLink($id)
    {
        return response()->json(
            $this->productDownloadableLinkRepository->upload(request()->all(), $id)
        );
    }

    /**
     * Uploads downloadable sample file
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadSample($id)
    {
        return response()->json(
            $this->productDownloadableSampleRepository->upload(request()->all(), $id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findOrFail($id);

        try {
            $this->productRepository->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Product']));

            return response()->json(['message' => true], 200);
        } catch (\Exception $e) {
            report($e);

            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Product']));
        }

        return response()->json(['message' => false], 400);
    }

    /**
     * Mass Delete the products
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        $productIds = explode(',', request()->input('indexes'));

        foreach ($productIds as $productId) {
            $product = $this->productRepository->find($productId);

            if (isset($product)) {
                $this->productRepository->delete($productId);
            }
        }

        session()->flash('success', trans('admin::app.catalog.products.mass-delete-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Mass updates the products
     *
     * @return \Illuminate\Http\Response
     */
    public function massUpdate()
    {
        $data = request()->all();

        if (! isset($data['massaction-type'])) {
            return redirect()->back();
        }

        if (! $data['massaction-type'] == 'update') {
            return redirect()->back();
        }

        $productIds = explode(',', $data['indexes']);

        foreach ($productIds as $productId) {
            $this->productRepository->update([
                'channel' => null,
                'locale'  => null,
                'status'  => $data['update-options'],
            ], $productId);
        }

        session()->flash('success', trans('admin::app.catalog.products.mass-update-success'));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * To be manually invoked when data is seeded into products
     *
     * @return \Illuminate\Http\Response
     */
    public function sync()
    {
        Event::dispatch('products.datagrid.sync', true);

        return redirect()->route('admin.catalog.products.index');
    }

    /**
     * Result of search product.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function productLinkSearch()
    {
        if (request()->ajax()) {
            $results = [];

            foreach ($this->productRepository->searchProductByAttribute(request()->input('query')) as $row) {
                $results[] = [
                    'id'   => $row->product_id,
                    'sku'  => $row->sku,
                    'name' => $row->name,
                ];
            }

            return response()->json($results);
        } else {
            return view($this->_config['view']);
        }
    }

     /**
     * Download image or file
     *
     * @param  int  $productId
     * @param  int  $attributeId
     * @return \Illuminate\Http\Response
     */
    public function download($productId, $attributeId)
    {
        $productAttribute = $this->productAttributeValue->findOneWhere([
            'product_id'   => $productId,
            'attribute_id' => $attributeId,
        ]);

        return Storage::download($productAttribute['text_value']);
    }

    /**
     * Search simple products
     *
     * @return \Illuminate\Http\Response
     */
    public function searchSimpleProducts()
    {
        return response()->json(
            $this->productRepository->searchSimpleProducts(request()->input('query'))
        );
    }
}