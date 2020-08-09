<?php

namespace Webkul\CMS\Http\Controllers\Admin;

use Codeception\PHPUnit\ResultPrinter\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Psy\Test\Exception\RuntimeExceptionTest;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Category\Models\Category;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\CMS\Http\Controllers\Controller;
use Webkul\CMS\Models\HomeCustomizeSection;
use Webkul\CMS\Models\HomeSlider;
use Webkul\CMS\Repositories\CmsRepository;
use Webkul\Product\Models\Product;
use Webkul\Velocity\Repositories\ConditionalProduct;

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
    protected $categoryRepository;
    protected $attributeRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\CMS\Repositories\CmsRepository  $cmsRepository
     * @return void
     */
    public function __construct(CmsRepository $cmsRepository, CategoryRepository $categoryRepository,
                                AttributeRepository $attributeRepository)
    {
        $this->middleware('admin');

        $this->cmsRepository = $cmsRepository;
        $this->categoryRepository = $categoryRepository;
        $this->attributeRepository = $attributeRepository;

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
        $data_obj = [];
        $image_data = [];
        $main_data = $request->input('data');
        $i = 0;
        foreach ($main_data as $key => $data_details) {
            $details_data = [];
            $j = 0;
            $data_obj[$key]['slug'] = $data_details['slug'];
            $data_obj[$key]['subtitle'] = $data_details['subtitle'];
            $data_obj[$key]['title'] = $data_details['title'];

            foreach ($data_details['details'] as $key2 => $data_child) {
                $details_data[$key2]['image_url'] = $data_child['image_url'];
                $details_data[$key2]['slug'] = $data_child['slug'];
                $details_data[$key2]['title'] = $data_child['title'];


                $child_data = [];
                $j = 0;
                foreach ($data_child['conditions'] as $key3 => $data_child_condition) {
                    $child_data[$j]['label'] = $data_child_condition['label'];
                    $child_data[$j]['operation'] = $data_child_condition['rule'];

                    $child_data[$j]['is_multi'] = $data_child_condition['is_multi'] == true ? 1 : 0;
                    if ($data_child_condition['is_multi'] == true) {
                        foreach ($data_child_condition['rule_value_multi'] as $key4 => $val3) {
                            if ($key4 == 0) {
                                $child_data[$j]['rule_value'] = $val3['id'];
                            } else {
                                $child_data[$j]['rule_value'] .= ',' . $val3['id'];
                            }
                        }
                    } else {
                        $child_data[$j]['rule_value'] = $data_child_condition['rule_value'];
                    }
                    $j++;
                }

                $details_data[$key2]['conditions'] = $child_data;

                $data_obj[$key]['details'] = $details_data;
            }

            $i++;
        }


        /** save **/
        DB::table('mix_customize_section_master')->delete();
        foreach ($data_obj as $key => $value) {
            $master_id = DB::table('mix_customize_section_master')->insertGetId([
                'title' => $value['title'],
                'subtitle' => $value['subtitle'],
                'slug' => $value['slug'],
            ]);

            foreach ($value['details'] as $key2 => $value2) {

                $details_id = DB::table('mix_customize_section_details')->insertGetId([
                    'title' => $value2['title'],
                    'master_section_id' => $master_id,
                    'slug' => $value2['slug'],
                    'image_url' => $value2['image_url'],
                ]);

                foreach ($value2['conditions'] as $key3 => $value3) {
                    DB::table('mix_customize_section_details_child')->insertGetId([
                        'is_multi' => $value3['is_multi'],
                        'details_row_id' => $details_id,
                        'label' => $value3['label'],
                        'operation' => $value3['operation'],
                        'rule_value' => $value3['rule_value'],
                    ]);
                }
            }

        }

    }

    public function store2(Request $request)
    {
        /*
        DB::transaction(function () use ($request) {
            DB::table('mix_customize_section_master')->delete();
            $data = $request->input('data');
            $master_section = [];
            $details_section = [];
            $details_child_section = [];
            $details_child_section_value = [];
            foreach ($data as $key => $value) {
                $master_section[$key]['slug'] = $value['slug'];
                $master_section[$key]['subtitle'] = $value['subtitle'];
                $master_section[$key]['title'] = $value['title'];

                foreach ($value['rows_iterate'] as $key2 => $value2) {
                    $details_section[$value['slug']][$key2]['slug'] = $value2['slug'];
                    $details_section[$value['slug']][$key2]['title'] = $value2['title'];
                    $details_section[$value['slug']][$key2]['parent_slug'] = $value['slug'];
//                    $details_section[$value['slug']][$key2]['image_url'] = $value['image_url'];

                    foreach ($value2['conditions'] as $key3 => $value3) {
                        $details_child_section[$value2['slug']][$key3]['label'] = $value3['rule_type'];
                        $details_child_section[$value2['slug']][$key3]['rule_operator'] = $value3['rule_operator'];
                        $details_child_section[$value2['slug']][$key3]['parent_slug'] = $value2['slug'];
                        $details_child_section[$value2['slug']][$key3]['show_multi_select'] = $value3['show_multi_select'] == true ? 1 : 0;
                        $details_child_section[$value2['slug']][$key3]['rule_value'] = $value3['show_multi_select'] == true ?
                            str_replace('"', '', str_replace('\\', '', json_encode($value3['rule_value_multi']))) : $value3['rule_value'];
                        foreach ($value3['multi'] as $key4 => $value4) {
                            $details_child_section_value[$value2['slug']][$key3][]['multi_value'] = $value4;
                        }
                    }
                }
            }

            $child_val = [];
            $child_val_c = [];
            foreach ($master_section as $key => $value) {
                DB::table('mix_customize_section_master')->insert($master_section[$key]);
                if (array_key_exists($master_section[$key]['slug'], $details_section)) {
                    DB::table('mix_customize_section_details')->insert($details_section[$master_section[$key]['slug']]);
                    foreach ($details_section[$master_section[$key]['slug']] as $key2 => $value2) {
                        if (array_key_exists($value2['slug'], $details_child_section)) {
                            foreach ($details_child_section[$value2['slug']] as $key3 => $value3) {
                                $id = DB::table('mix_customize_section_details_child')->insertGetId($value3);
                                $j = 0;
                                if (array_key_exists($value2['slug'], $details_child_section_value)) {
                                    if (array_key_exists($key3, $details_child_section_value[$value2['slug']])) {
                                        foreach ($details_child_section_value[$value2['slug']][$key3] as $key4 => $value4) {
                                            $child_val[$key3][$j]['child_id'] = $id;
                                            $child_val[$key3][$j]['multi_value'] = $value4['multi_value'];
                                            $j += 1;
                                        }
                                        DB::table('mix_customize_child_multi_value')->insert($child_val[$key3]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        });

        //return $details_section['best-of-electronics'];
  */
    }

    public function getMixSection()
    {

        $data = DB::select("SELECT mix_customize_section_master.id, mix_customize_section_master.title, 
        mix_customize_section_master.subtitle,
        mix_customize_section_master.slug, mix_customize_section_details.title details_title, 
        mix_customize_section_details.slug details_slug, mix_customize_section_details.image_url,
        mix_customize_section_details_child.label, mix_customize_section_details_child.operation,
        mix_customize_section_details_child.rule_value, mix_customize_section_details_child.is_multi,
        mix_customize_section_details.id details_id
        FROM mix_customize_section_master
        INNER JOIN mix_customize_section_details on 
        mix_customize_section_details.master_section_id = mix_customize_section_master.id
        INNER JOIN mix_customize_section_details_child on 
        mix_customize_section_details_child.details_row_id = mix_customize_section_details.id
        ORDER by mix_customize_section_master.id, mix_customize_section_details.id");

//        return $data;
        $id = "";
        $dtl_id = "";
        $i = -1;
        $j = -1;
        $k = -1;
        $m_data = [];
        foreach ($data as $key => $value) {
            if ($id != $value->id) {
                $i += 1;
                $j = -1;

                $id = $value->id;
                $m_data[$i]['title'] = $value->title;
                $m_data[$i]['subtitle'] = $value->subtitle;
                $m_data[$i]['slug'] = $value->slug;
                $m_data[$i]['is_hide'] = false;
                $m_data[$i]['icon'] = 'plus';
            }
            if ($dtl_id != $value->details_id) {
                $j += 1;
                $k = -1;
                $dtl_id = $value->details_id;
                $m_data[$i]['details'][$j]['title'] = $value->details_title;
                $m_data[$i]['details'][$j]['slug'] = $value->details_slug;
                $m_data[$i]['details'][$j]['image_url'] = $value->image_url;
                $m_data[$i]['details'][$j]['is_hide'] = false;
                $m_data[$i]['details'][$j]['icon'] = 'plus';

            }

            /*** condition array load ***/
            $k += 1;
            $m_data[$i]['details'][$j]['conditions'][$k]['is_multi'] = ($value->is_multi == 1 ? true : false);
            $m_data[$i]['details'][$j]['conditions'][$k]['label'] = $value->label;
            $m_data[$i]['details'][$j]['conditions'][$k]['rule'] = $value->operation;
            $m_data[$i]['details'][$j]['conditions'][$k]['rule_array'] = $this->attributeRepository
                ->GetAttributeTypeRules($value->label);
            if ($value->is_multi == 0)
                $m_data[$i]['details'][$j]['conditions'][$k]['rule_value'] = $value->rule_value;
            else
                $m_data[$i]['details'][$j]['conditions'][$k]['rule_value'] = "";

            if ($value->is_multi == 0) {
                $m_data[$i]['details'][$j]['conditions'][$k]['options'] = [];
            } else {
                if ($value->label == "Categories") {
                    $link_data = $this->categoryRepository->rawList();
                    $m_data[$i]['details'][$j]['conditions'][$k]['options'] = $link_data;
                    $ex_data = explode(',', $value->rule_value);
                    $d = [];
                    foreach ($link_data as $k2 => $v) {
                        if (in_array($v->id, $ex_data)) {
                            $d[] = $v;
                        }
                    }
                    if ($value->is_multi == 0) {
                        $m_data[$i]['details'][$j]['conditions'][$k]['rule_value_multi'] = [];
                    } else {
                        $m_data[$i]['details'][$j]['conditions'][$k]['rule_value_multi'] = $d;
                    }
                } else {
                    $link_data = $this->attributeRepository->GetAttributeOptionsByLabel($value->label);
                    $m_data[$i]['details'][$j]['conditions'][$k]['options'] = $link_data;
                    $ex_data = explode(',', $value->rule_value);
                    $d = [];
                    foreach ($link_data as $k2 => $v) {
                        if (in_array($v->id, $ex_data)) {
                            $d[] = $v;
                        }
                    }
                    if ($value->is_multi == 0) {
                        $m_data[$i]['details'][$j]['conditions'][$k]['rule_value_multi'] = [];
                    } else {
                        $m_data[$i]['details'][$j]['conditions'][$k]['rule_value_multi'] = $d;
                    }
                }
            }

        }

        return $m_data;

        $main_data = [];
        $i = -1;
        $j = -1;
        $id_exist = "";
        foreach ($data as $key => $value) {
            if ($id_exist != $value->id) {
                $i += 1;
                $j = 0;
                $id_exist = $value->id;
                $main_data[$i]['title'] = $value->title;
                $main_data[$i]['idd'] = 'image_' . $value->id;
                $main_data[$i]['slug'] = $value->slug;
                $main_data[$i]['image'] = $value->save_path . $value->image_name;
                $main_data[$i]['image_name'] = $value->image_name;
            }

            if ($id_exist == $value->id) {
                $main_data[$i]['conditions'][$j]['is_multi'] = ($value->is_multi == 1 ? true : false);
                $main_data[$i]['conditions'][$j]['label'] = $value->label;
                $main_data[$i]['conditions'][$j]['rule'] = $value->operation;
                $main_data[$i]['conditions'][$j]['rule_array'] = $this->attributeRepository
                    ->GetAttributeTypeRules($value->label);
                if ($value->is_multi == 0)
                    $main_data[$i]['conditions'][$j]['rule_value'] = $value->rule_value;
                else
                    $main_data[$i]['conditions'][$j]['rule_value'] = "";

                if ($value->is_multi == 0) {
                    $main_data[$i]['conditions'][$j]['options'] = [];
                } else {
                    if ($value->label == "Categories") {
                        $link_data = $this->categoryRepository->rawList();
                        $main_data[$i]['conditions'][$j]['options'] = $link_data;
                        $ex_data = explode(',', $value->rule_value);
                        $d = [];
                        foreach ($link_data as $k => $v) {
                            if (in_array($v->id, $ex_data)) {
                                $d[] = $v;
                            }
                        }

                        if ($value->is_multi == 0) {
                            $main_data[$i]['conditions'][$j]['rule_value_multi'] = [];
                        } else {
                            $main_data[$i]['conditions'][$j]['rule_value_multi'] = $d;
                        }

                    } else {
                        $link_data = $this->attributeRepository->GetAttributeOptionsByLabel($value->label);
                        $main_data[$i]['conditions'][$j]['options'] = $link_data;
                        $ex_data = explode(',', $value->rule_value);
                        $d = [];
                        foreach ($link_data as $k => $v) {
                            if (in_array($v->id, $ex_data)) {
                                $d[] = $v;
                            }
                        }

                        if ($value->is_multi == 0) {
                            $main_data[$i]['conditions'][$j]['rule_value_multi'] = [];
                        } else {
                            $main_data[$i]['conditions'][$j]['rule_value_multi'] = $d;
                        }
                    }

                }
            }
            $j += 1;

        }

        return $main_data;
    }

    public function GetAttributeOptionsByAttributeName($attribute_name)
    {
       return DB::select("SELECT attribute_options.id, attribute_options.admin_name FROM attribute_translations
        left join attribute_options on attribute_options.attribute_id = attribute_translations.attribute_id
        WHERE name = '$attribute_name'");
    }

    public function GetCategoriesName()
    {
       return DB::select("SELECT category_id id, name admin_name FROM category_translations");
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

    public function GetProductImageByCondition(Request $request)
    {
        $conditions = new ConditionalProduct();
        return  $conditions->GetConditionalProductDirect($request->input('data'));
    }

}