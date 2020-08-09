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

class CustomizeSectionController extends Controller
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
        $categories = DB::select("SELECT categories.id, category_translations.name, 
        CAST(COALESCE(categories.parent_id,0) as int) parent_id
        FROM categories
        INNER JOIN category_translations ON 
        category_translations.category_id = categories.id");

        $products = DB::select("SELECT product_flat.id, product_flat.name, product_categories.category_id
        FROM product_flat
        INNER JOIN product_categories on 
        product_categories.product_id = product_flat.product_id
        WHERE name is not null");

        $data = DB::select("SELECT name display_name, is_visible, position,
        home_customize_section_details.display_category_id, 
        home_customize_section_details.display_block_type, home_customize_section_masters.id
        FROM home_customize_section_masters
        INNER JOIN home_customize_section_details on 
        home_customize_section_details.master_id = home_customize_section_masters.id
        ORDER BY home_customize_section_masters.id");
        $master_data = [];
        $id = "";
        $j = -1;
        $i = -1;

        foreach ($data as $key => $value) {
            if ($id != $value->id) {
                $id = $value->id;
                $j = -1;
                $i += 1;
                $master_data[$i]['display_name'] = $value->display_name;
                $master_data[$i]['is_visible'] = ($value->is_visible == 1 ? true : false);
                $master_data[$i]['position'] = $value->position;
                $master_data[$i]['is_hide'] = false;
                $master_data[$i]['icon'] = 'minus';
            }
            $j += 1;
            $master_data[$i]['include_items'][$j] = $this->CategoryCustomInfo($value->display_category_id, $value->display_block_type);
            $master_data[$i]['items'] = $value->display_block_type == 2 ? $products : $categories;
            $master_data[$i]['item_type'] = $value->display_block_type;

        }
        //include_items
//        return $master_data;

        return view($this->_config['view'])->with([
            'categories' => $categories,
            'products' => $products,
            'master_data' => $master_data
        ]);
    }

    public function CategoryCustomInfo($category_id, $type)
    {
        if ($type == 1) {
            $data = DB::select("SELECT name, category_id id FROM category_translations
            WHERE category_id = $category_id");
            if (count($data) > 0) {
                return $data[0];
            } else {
                return [];
            }
        } else if ($type == 2) {
            $data = DB::select("SELECT product_flat.name, product_flat.id, product_categories.category_id FROM product_flat
            INNER JOIN product_categories on product_categories.product_id = product_flat.product_id
            WHERE product_flat.product_id = $category_id");
            if (count($data) > 0) {
                return $data[0];
            } else {
                return [];
            }
        }
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
        $master_data = [];
        $details_data = [];

        foreach ($data as $key => $value) {
            $master_data[$key]['name'] = $value['display_name'];
            $master_data[$key]['is_visible'] = $value['is_visible'] ? 1 : 0;
            $master_data[$key]['position'] = $value['position'];
            $j = 0;
            foreach ($value['include_items'] as $key2 => $d_value) {
                $details_data[$key][]['display_category_id'] = $d_value['id'];
                $type = "";
                if (array_key_exists('category_id', $d_value)) {
                    $type = 2;
                } else {
                    $type = 1;
                }
                $details_data[$key][$j]['display_block_type'] = $type;
                $j += 1;
            }
        }
        //return $details_data;
        DB::table('home_customize_section_masters')->delete();
        foreach ($master_data as $key => $value) {
            $id = DB::table('home_customize_section_masters')->insertGetId($value);
            foreach ($details_data[$key] as $key2 => $value2) {
                $details_data[$key][$key2]['master_id'] = $id;
                DB::table('home_customize_section_details')->insert($details_data[$key][$key2]);
            }
        }

        return Response::json(
            ['message' => 'Saved Successfully']
        );

        $key_ref = [];
        for ($i = 0; $i < 15; $i++) {
            if (request()->has('category_id_' . $i)) {
                $key_ref[] = $i;
            }
        }

        $home_slider_array = [];
        $slider_product = [];
        $slider_config = [];

        $data = request()->all();

        foreach ($key_ref as $key => $value) {
            $this->validate(request(), [
//                'category_id_' . $value   => 'required',
                'position_' . $value  => 'required',
                'is_visible_' . $value  => 'required',
                'display_name_' . $value  => 'required',
            ]);
        }
        /*
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
        */
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