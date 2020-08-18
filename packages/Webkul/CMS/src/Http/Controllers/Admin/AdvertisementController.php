<?php

namespace Webkul\CMS\Http\Controllers\Admin;

use App\Helper\ImageManipulation;
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

class AdvertisementController extends Controller
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


        return view($this->_config['view'])->with([

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


    }

    public function GetAdvertisementOne()
    {
        $data = DB::select("SELECT advertisement_master.id , advertisement_master.title,
         advertisement_master.slug, advertisement_master.image_name, 
        advertisement_master.save_path,
        advertisement_rule.label, advertisement_rule.operation, advertisement_rule.rule_value, advertisement_rule.is_multi
        FROM advertisement_master
        left JOIN advertisement_rule on advertisement_rule.master_id = advertisement_master.id
        WHERE type = 2
        ORDER BY advertisement_master.id ");

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
                $main_data[$i]['image'] = $value->save_path . 'small/' . $value->image_name;
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

    public function UpdateAdvertisementOne(Request $request)
    {
        $imageManipulation = new ImageManipulation();
        $path = '/uploads/special_img/';
        $path2 = '/special_img/';
        $data_obj = [];
        $image_data = [];
        $image_name = "";
        $logo_name = "";
        $main_data = \GuzzleHttp\json_decode($request->input('data'), true);
        $i = 0;
        foreach ($main_data as $key => $image) {
            if (array_key_exists('idd', $image)) {
                if($request->hasFile($image['idd'])) {
                    $file = $request->file($image['idd']);
                    $data_obj['image_name'] = $imageManipulation->UploadImage($file, $path);
                } else {
                    $data_obj['image_name'] = $image['image_name'];
                }
            }

            $child_data = [];
            $j = 0;
            foreach ($image['conditions'] as $key2 => $val) {
                $child_data[$j]['label'] = $val['label'];
                $child_data[$j]['operation'] = $val['rule'];

                $child_data[$j]['is_multi'] = $val['is_multi'] == true ? 1 : 0;
                if ($val['is_multi'] == true) {
                    foreach ($val['rule_value_multi'] as $key3 => $val3) {
                        if ($key3 == 0) {
                            $child_data[$j]['rule_value'] = $val3['id'];
                        } else {
                            $child_data[$j]['rule_value'] .= ',' . $val3['id'];
                        }

                    }
                } else {
                    $child_data[$j]['rule_value'] = $val['rule_value'];
                }
                $j++;
            }
            $data_obj['slug'] = $image['slug'];

            $data_obj['title'] = $image['title'];
            $data_obj['save_path'] = $path2;
            $data_obj['type'] = 2;
            $image_data[$i] = $data_obj;
            $image_data[$i]['child'] = $child_data;
            $i++;
        }
        DB::table('advertisement_master')->where('type', 2)->delete();
        foreach ($image_data as $key => $value) {
            $id = DB::table('advertisement_master')->insertGetId([
                'image_name' => $value['image_name'],
                'save_path' => $value['save_path'],
                'slug' => $value['slug'],
                'title' => $value['title'],
                'type' => $value['type'],
            ]);
            foreach ($value['child'] as $key2 => $value2) {
                $value2['master_id'] = $id;
                DB::table('advertisement_rule')->insert($value2);
            }
        }
        return $image_data;
    }

    public function GetAdvertisementTwo()
    {
        $data = DB::select("SELECT advertisement_master.id , advertisement_master.title,
         advertisement_master.slug, advertisement_master.image_name, 
        advertisement_master.save_path,
        advertisement_rule.label, advertisement_rule.operation, advertisement_rule.rule_value, advertisement_rule.is_multi
        FROM advertisement_master
        left JOIN advertisement_rule on advertisement_rule.master_id = advertisement_master.id
        WHERE type = 3
        ORDER BY advertisement_master.id ");

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
                $main_data[$i]['image'] = $value->save_path . 'small/' . $value->image_name;
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

    public function UpdateAdvertisementTwo(Request $request)
    {
        $imageManipulation = new ImageManipulation();
        $path = '/uploads/special_img/';
        $path2 = '/special_img/';
        $data_obj = [];
        $image_data = [];
        $image_name = "";
        $logo_name = "";
        $main_data = \GuzzleHttp\json_decode($request->input('data'), true);
        $i = 0;
        foreach ($main_data as $key => $image) {
            if (array_key_exists('idd', $image)) {
                if($request->hasFile($image['idd'])) {
                    $file = $request->file($image['idd']);
                    $data_obj['image_name'] = $imageManipulation->UploadImage($file, $path);
                } else {
                    $data_obj['image_name'] = $image['image_name'];
                }
            }

            $child_data = [];
            $j = 0;
            foreach ($image['conditions'] as $key2 => $val) {
                $child_data[$j]['label'] = $val['label'];
                $child_data[$j]['operation'] = $val['rule'];

                $child_data[$j]['is_multi'] = $val['is_multi'] == true ? 1 : 0;
                if ($val['is_multi'] == true) {
                    foreach ($val['rule_value_multi'] as $key3 => $val3) {
                        if ($key3 == 0) {
                            $child_data[$j]['rule_value'] = $val3['id'];
                        } else {
                            $child_data[$j]['rule_value'] .= ',' . $val3['id'];
                        }

                    }
                } else {
                    $child_data[$j]['rule_value'] = $val['rule_value'];
                }
                $j++;
            }
            $data_obj['slug'] = $image['slug'];

            $data_obj['title'] = $image['title'];
            $data_obj['save_path'] = $path2;
            $data_obj['type'] = 3;
            $image_data[$i] = $data_obj;
            $image_data[$i]['child'] = $child_data;
            $i++;
        }
        DB::table('advertisement_master')->where('type', 3)->delete();
        foreach ($image_data as $key => $value) {
            $id = DB::table('advertisement_master')->insertGetId([
                'image_name' => $value['image_name'],
                'save_path' => $value['save_path'],
                'slug' => $value['slug'],
                'title' => $value['title'],
                'type' => $value['type'],
            ]);
            foreach ($value['child'] as $key2 => $value2) {
                $value2['master_id'] = $id;
                DB::table('advertisement_rule')->insert($value2);
            }
        }
        return $image_data;
    }

    public function GetSliderSection()
    {
        $data = DB::select("SELECT advertisement_master.id , advertisement_master.title,
         advertisement_master.slug, advertisement_master.image_name, 
        advertisement_master.save_path,
        advertisement_rule.label, advertisement_rule.operation, advertisement_rule.rule_value, advertisement_rule.is_multi
        FROM advertisement_master
        left JOIN advertisement_rule on advertisement_rule.master_id = advertisement_master.id
        WHERE type = 1
        ORDER BY advertisement_master.id ");

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
                $main_data[$i]['image'] = $value->save_path . 'small/' . $value->image_name;
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

    public function UpdateSliderSection(Request $request)
    {
        $imageManipulation = new ImageManipulation();
        $path = '/uploads/special_img/';
        $path2 = '/special_img/';
        $data_obj = [];
        $image_data = [];
        $image_name = "";
        $logo_name = "";
        $main_data = \GuzzleHttp\json_decode($request->input('data'), true);
        $i = 0;
        foreach ($main_data as $key => $image) {
            if (array_key_exists('idd', $image)) {
                if($request->hasFile($image['idd'])) {
                    $file = $request->file($image['idd']);
                    $data_obj['image_name'] = $imageManipulation->UploadImage($file, $path);
                } else {
                    $data_obj['image_name'] = $image['image_name'];
                }
            }

            $child_data = [];
            $j = 0;
            foreach ($image['conditions'] as $key2 => $val) {
                $child_data[$j]['label'] = $val['label'];
                $child_data[$j]['operation'] = $val['rule'];

                $child_data[$j]['is_multi'] = $val['is_multi'] == true ? 1 : 0;
                if ($val['is_multi'] == true) {
                    foreach ($val['rule_value_multi'] as $key3 => $val3) {
                        if ($key3 == 0) {
                            $child_data[$j]['rule_value'] = $val3['id'];
                        } else {
                            $child_data[$j]['rule_value'] .= ',' . $val3['id'];
                        }

                    }
                } else {
                    $child_data[$j]['rule_value'] = $val['rule_value'];
                }
                $j++;
            }
            $data_obj['slug'] = $image['slug'];

            $data_obj['title'] = $image['title'];
            $data_obj['save_path'] = $path2;
            $data_obj['type'] = 1;
            $image_data[$i] = $data_obj;
            $image_data[$i]['child'] = $child_data;
            $i++;
        }
        DB::table('advertisement_master')->where('type', 1)->delete();
        foreach ($image_data as $key => $value) {
            $id = DB::table('advertisement_master')->insertGetId([
                'image_name' => $value['image_name'],
                'save_path' => $value['save_path'],
                'slug' => $value['slug'],
                'title' => $value['title'],
                'type' => $value['type'],
            ]);
            foreach ($value['child'] as $key2 => $value2) {
                $value2['master_id'] = $id;
                DB::table('advertisement_rule')->insert($value2);
            }
        }
        return $image_data;
    }

    public function GetSliderAddSection()
    {
        $data = DB::select("SELECT advertisement_master.id , advertisement_master.title,
         advertisement_master.slug, advertisement_master.image_name, 
        advertisement_master.save_path,
        advertisement_rule.label, advertisement_rule.operation, advertisement_rule.rule_value, advertisement_rule.is_multi
        FROM advertisement_master
        LEFT JOIN advertisement_rule on advertisement_rule.master_id = advertisement_master.id
        WHERE type = 4
        ORDER BY advertisement_master.id ");

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
                $main_data[$i]['image'] = $value->save_path . 'small/' . $value->image_name;
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

    public function UpdateSliderAddSection(Request $request)
    {
        $imageManipulation = new ImageManipulation();
        $path = '/uploads/special_img/';
        $path2 = '/special_img/';
        $data_obj = [];
        $image_data = [];
        $image_name = "";
        $logo_name = "";
        $main_data = \GuzzleHttp\json_decode($request->input('data'), true);
        $i = 0;
        foreach ($main_data as $key => $image) {
            if (array_key_exists('idd', $image)) {
                if($request->hasFile($image['idd'])) {
                    $file = $request->file($image['idd']);
                    $data_obj['image_name'] = $imageManipulation->UploadImage($file, $path);
                } else {
                    $data_obj['image_name'] = $image['image_name'];
                }
            }

            $child_data = [];
            $j = 0;
            foreach ($image['conditions'] as $key2 => $val) {
                $child_data[$j]['label'] = $val['label'];
                $child_data[$j]['operation'] = $val['rule'];

                $child_data[$j]['is_multi'] = $val['is_multi'] == true ? 1 : 0;
                if ($val['is_multi'] == true) {
                    foreach ($val['rule_value_multi'] as $key3 => $val3) {
                        if ($key3 == 0) {
                            $child_data[$j]['rule_value'] = $val3['id'];
                        } else {
                            $child_data[$j]['rule_value'] .= ',' . $val3['id'];
                        }

                    }
                } else {
                    $child_data[$j]['rule_value'] = $val['rule_value'];
                }
                $j++;
            }
            $data_obj['slug'] = $image['slug'];

            $data_obj['title'] = $image['title'];
            $data_obj['save_path'] = $path2;
            $data_obj['type'] = 4;
            $image_data[$i] = $data_obj;
            $image_data[$i]['child'] = $child_data;
            $i++;
        }
        DB::table('advertisement_master')->where('type', 4)->delete();
        foreach ($image_data as $key => $value) {
            $id = DB::table('advertisement_master')->insertGetId([
                'image_name' => $value['image_name'],
                'save_path' => $value['save_path'],
                'slug' => $value['slug'],
                'title' => $value['title'],
                'type' => $value['type'],
            ]);
            foreach ($value['child'] as $key2 => $value2) {
                $value2['master_id'] = $id;
                DB::table('advertisement_rule')->insert($value2);
            }
        }
        return $image_data;
    }

    public function getMixSection()
    {

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
}