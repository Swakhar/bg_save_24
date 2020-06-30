<?php

namespace Webkul\CMS\Http\Controllers\Admin;

use Codeception\PHPUnit\ResultPrinter\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Webkul\Category\Models\Category;
use Webkul\CMS\Http\Controllers\Controller;
use Webkul\CMS\Models\HomeSlider;
use Webkul\CMS\Repositories\CmsRepository;
use Webkul\Product\Models\Product;

class RecommendedSliderController extends Controller
{
    /**
     * To hold the request variables from route file
     * 
     * @var array
     */
    protected $_config;

    /**
     * To hold the CMSRepository instance
     * 
     * @var \Webkul\CMS\Repositories\CmsRepository
     */
    protected $cmsRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\CMS\Repositories\CmsRepository  $cmsRepository
     * @return void
     */
    public function __construct(CmsRepository $cmsRepository)
    {
        $this->middleware('admin');

        $this->cmsRepository = $cmsRepository;

        $this->_config = request('_config');
    }

    /**
     * Loads the index page showing the static pages resources
     * 
     * @return \Illuminate\View\View|\Webkul\Velocity\Repositories\Product\ProductRepository
     */
    public function index()
    {
        $home_slider =  HomeSlider::get();
        $catalog_object = Product::GetProductsWithCategory();

        $RecommendedSliderIsConfigured = HomeSlider::FindIsRecommendedSliderIsConfigured() > 0;
        $home_slider_data = [];
        $slider_data = [];
        $slider_name = "";
        if ($RecommendedSliderIsConfigured) {
            $home_slider_data = HomeSlider::GetRecommendedSliderWithImage();
        }

        foreach ($home_slider_data as $key => $value) {
            $slider_data[$value->id]['slider_name'] = $value->slider_name;
            $slider_data[$value->id]['slider_id'] = $value->slider_id;
            $slider_data[$value->id]['category_name'] = $value->category_name;
            $slider_data[$value->id]['category_id'] = $value->category_id;
            $slider_data[$value->id]['position'] = $value->position;
            $slider_data[$value->id]['products'][] = $value;
            $slider_name = $value->slider_name;
        }

        return view($this->_config['view'])->with([
            'catalog_object' => $catalog_object,
            'RecommendedSliderIsConfigured' => $RecommendedSliderIsConfigured,
            'slider_data' => $slider_data,
            'slider_name' => $slider_name
        ]);
    }

    /**
     * To create a new CMS page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * To store a new CMS page in storage
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $key_ref = [];
        for ($i = 0; $i < 15; $i++) {
            if (request()->input('category_id_' . $i)) {
                $key_ref[] = $i;
            }
        }
        $home_slider_array = [];
        $slider_product = [];
        $slider_config = [];

        $data = request()->all();

        $this->validate(request(), [
            'slider_name'   => 'required',
        ]);
        foreach ($key_ref as $key => $value) {
            $this->validate(request(), [
                'category_id_' . $value   => 'required',
                'position_' . $value  => 'required',
            ]);
        }

        if (request()->input('slider_id') != null) {
            DB::table('slider_name_master')
                ->where('id', request()->input('slider_id'))
                ->update([
                    'name' => request()->input('slider_name')
                ]);
            DB::table('home_sliders')->where('slider_name_master_id', request()->input('slider_id'))->delete();
            $id = request()->input('slider_id');
        } else {
            $id = DB::table('slider_name_master')->insertGetId([
                'name' => request()->input('slider_name')
            ]);
        }

        foreach ($key_ref as $key => $value) {
            $dtl_id = DB::table('home_sliders')->insertGetId([
                'category_id' => request()->input('category_id_' . $value),
                'slider_type' => 1,
                'position' => request()->input('position_' . $value),
                'slider_name_master_id' => $id
            ]);
            foreach (request()->input('product_id_' . $value) as $product_key => $product_value) {
                DB::table('home_slider_products')->insertGetId([
                    'product_id' => $product_value,
                    'home_slider_id' => $dtl_id
                ]);
            }

        }
       return Response::json(
           ['message' => request()->input('slider_id') != null ? 'Updated Successfully' : 'Saved Successfully']
       );
    }

    /**
     * To edit a previously created CMS page
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $page = $this->cmsRepository->findOrFail($id);

        return view($this->_config['view'], compact('page'));
    }

    /**
     * To update the previously created CMS page in storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $locale = request()->get('locale') ?: app()->getLocale();

        $this->validate(request(), [
            $locale . '.url_key'      => ['required', new \Webkul\Core\Contracts\Validations\Slug, function ($attribute, $value, $fail) use ($id) {
                if (! $this->cmsRepository->isUrlKeyUnique($id, $value)) {
                    $fail(trans('admin::app.response.already-taken', ['name' => 'Page']));
                }
            }],
            $locale . '.page_title'   => 'required',
            $locale . '.html_content' => 'required',
            'channels'                => 'required',
        ]);

        $this->cmsRepository->update(request()->all(), $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Page']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * To delete the previously create CMS page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $page = $this->cmsRepository->findOrFail($id);

        if ($page->delete()) {
            session()->flash('success', trans('admin::app.cms.pages.delete-success'));

            return response()->json(['message' => true], 200);
        } else {
            session()->flash('success', trans('admin::app.cms.pages.delete-failure'));

            return response()->json(['message' => false], 200);
        }
    }

    /**
     * To mass delete the CMS resource from storage
     *
     * @return \Illuminate\Http\Response
     */
    public function massDelete()
    {
        $data = request()->all();

        if ($data['indexes']) {
            $pageIDs = explode(',', $data['indexes']);

            $count = 0;

            foreach ($pageIDs as $pageId) {
                $page = $this->cmsRepository->find($pageId);

                if ($page) {
                    $page->delete();

                    $count++;
                }
            }

            if (count($pageIDs) == $count) {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.delete-success', [
                    'resource' => 'CMS Pages',
                ]));
            } else {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.partial-action', [
                    'resource' => 'CMS Pages',
                ]));
            }
        } else {
            session()->flash('warning', trans('admin::app.datagrid.mass-ops.no-resource'));
        }

        return redirect()->route('admin.cms.index');
    }
}