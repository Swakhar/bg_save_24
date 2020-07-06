<?php

namespace Webkul\CMS\Http\Controllers\Admin;

use Codeception\PHPUnit\ResultPrinter\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Psy\Test\Exception\RuntimeExceptionTest;
use Webkul\Category\Models\Category;
use Webkul\CMS\Http\Controllers\Controller;
use Webkul\CMS\Models\HomeCustomizeSection;
use Webkul\CMS\Models\HomeSlider;
use Webkul\CMS\Repositories\CmsRepository;
use Webkul\Product\Models\Product;

class MixSectionController extends Controller
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
//        return 1;
        $home_slider =  HomeSlider::get();
        $catalog_object = Product::GetProductsWithCategoryParentRelation();

        $GetSectionData = HomeCustomizeSection::GetSectionData();
        $home_slider_data = [];
        $slider_data = [];
        $slider_name = "";

        foreach ($GetSectionData as $key => $value) {
            $slider_data[$value->master_id]['data'][] = $value;
            $slider_data[$value->master_id]['section_name'] = $value->section_name;
            $slider_data[$value->master_id]['position'] = $value->position;
            $slider_data[$value->master_id]['is_visible'] = $value->is_visible;
            $slider_data[$value->master_id]['display_block_type'] = $value->display_block_type;
        }

        return view($this->_config['view'])->with([
            'catalog_object' => $catalog_object,
            'slider_data' => $slider_data,
            'slider_name' => $slider_name,
            'parent_category' => array_key_exists('categories_parent', $catalog_object) ?
                $catalog_object['categories_parent'] :
                \GuzzleHttp\json_encode([], true)
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
    public function store(Request $request)
    {
        $data = $request->input('data');
        $master_section = [];
        $details_section = [];
        $details_child_section = [];
        foreach ($data as $key => $value) {
            $master_section[$key]['slug'] = $value['slug'];
            $master_section[$key]['subtitle'] = $value['subtitle'];
            $master_section[$key]['title'] = $value['title'];

            foreach ($value['rows_iterate'] as $key2 => $value2) {
                $details_section[$value['slug']][$key2]['slug'] = $value2['slug'];
                $details_section[$value['slug']][$key2]['parent_slug'] = $value['slug'];
                foreach ($value2['conditions'] as $key3 => $value3) {
                    $details_child_section[$value2['slug']][$key3]['rule_operator'] = $value3['rule_operator'];
                    $details_child_section[$value2['slug']][$key3]['parent_slug'] = $value2['slug'];
                    $details_child_section[$value2['slug']][$key3]['show_multi_select'] = $value3['showMultiSelect'] == true ? 1 : 0;
                    $details_child_section[$value2['slug']][$key3]['rule_value'] = $value3['showMultiSelect'] == true ? \GuzzleHttp\json_encode($value3['rule_value_multi']) : $value3['rule_value'];
                }
            }
        }
//return $details_section;
        $f = [];
        foreach ($master_section as $key => $value) {
            DB::table('mix_customize_section_master')->insert($master_section[$key]);
            DB::table('mix_customize_section_details')->insert($details_section[$master_section[$key]['slug']]);
            foreach ($details_section[$master_section[$key]['slug']] as $key2 => $value2) {
                DB::table('mix_customize_section_details_child')->insert($details_child_section[$value2['slug']]);
            }
        }

        // DB::table('mix_customize_section_details')->insert($master_section[$key]);

        // mix_customize_section_master
        // mix_customize_section_details
        // mix_customize_section_details_child
return $f;
        return $details_section['best-of-electronics'];
        return \request();
        DB::table('home_customize_section_masters')->delete();
//        DB::table('home_customize_section_details')->where('slider_name_master_id', request()->input('slider_id'))->delete();
        foreach ($key_ref as $key => $value) {
            $id = DB::table('home_customize_section_masters')->insertGetId([
                'name' => request()->input('display_name_' . $value),
                'is_visible' => request()->has('is_visible_' . $value) ? 1 : 0,
                'position' => request()->input('position_' . $value)
            ]);
            foreach (request()->input('product_id_' . $value) as $product_key => $product_value) {
                $block_type = request()->has('is_subcategory_' . $value) ? 1 : 2;
                DB::table('home_customize_section_details')->insertGetId([
                    'display_category_id' => $product_value,
                    'master_id' => $id,
                    'display_block_type' => $block_type
                ]);
            }
        }
       return Response::json(
           ['message' => 'Saved Successfully']
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