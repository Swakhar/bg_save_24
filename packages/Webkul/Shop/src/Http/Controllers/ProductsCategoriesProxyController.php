<?php


namespace Webkul\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Product\Models\ProductReview;
use Webkul\Product\Repositories\ProductRepository;

class ProductsCategoriesProxyController extends Controller
{
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
     * Create a new controller instance.
     *
     * @param  \Webkul\Category\Repositories\CategoryRepository  $categoryRepository
     * @param  \Webkul\Product\Repositories\ProductRepository  $productRepository
     *
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository
    )
    {
        $this->categoryRepository = $categoryRepository;

        $this->productRepository = $productRepository;

        parent::__construct();
    }

    /**
     * Show product or category view. If neither category nor product matches, abort with code 404.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Exception
     */
    public function index(Request $request)
    {
        $slugOrPath = trim($request->getPathInfo(), '/');

        if (preg_match('/^([a-z0-9-]+\/?)+$/', $slugOrPath)) {

            if ($category = $this->categoryRepository->findByPath($slugOrPath)) {

                return view($this->_config['category_view'], compact('category'));
            }

            if ($product = $this->productRepository->findBySlug($slugOrPath)) {

                $customer = auth()->guard('customer')->user();

                $product = DB::select("SELECT product_flat.name, product_flat.sku, product_flat.description, product_flat.short_description, round(product_flat.price, 2) price, 
                round(product_flat.special_price, 2) special_price, 
                product_flat.special_price_from, product_flat.special_price_to, product_flat.meta_title, product_flat.meta_keywords, product_flat.meta_description,
                product_images.path, product_flat.product_id,
                products.type
                FROM product_flat
                LEFT JOIN product_images on product_images.product_id = product_flat.product_id
                LEFT JOIN products ON products.id = product_flat.product_id
                WHERE url_key = '$slugOrPath'");

                if (count($product) > 0) {
                    $images = [];
                    foreach ($product as $key => $image) {
                        $images[$key] = $image->path;
                    }

                    if ($product[0]->type == 'configurable') {
                        $configurable = DB::select("SELECT product_flat.name, round(p_f.price, 2) price, 
                        round(p_f.special_price, 2) special_price, product_images.path,
                        product_super_attributes.attribute_id, p_f.product_id,
                        product_images.id image_id
                        FROM product_flat
                        LEFT join product_flat p_f on p_f.parent_id = product_flat.id
                        left join product_images on product_images.product_id = p_f.product_id
                        left join product_super_attributes on product_super_attributes.product_id = product_flat.product_id
                        WHERE product_flat.product_id = ".$product[0]->product_id."
                        ORDER BY p_f.product_id");

                        $products = [];
                        $pretty_products = [];
                        $exist_products = [];
                        $i = -1;
                        $j = 0;
                        $attrs = [];
                        $product_data = [];
                        foreach ($configurable as $key => $value) {
                            if (!in_array($value->product_id, $exist_products)) {
                                $i += 1;
                                $j = 0;
                                $exist_products[] = $value->product_id;
                            }
                            $products[$i][$j] = $value;
                            $j += 1;
                            $attrs[$value->attribute_id] = $value->attribute_id;
                            $prods[$value->product_id] = $value->product_id;
                            $prods[$value->product_id] = $value->product_id;
                            $product_data[$value->product_id]['images'][$value->image_id] = $value->path;
                            $product_data[$value->product_id]['price'] = $value->price;
                            $product_data[$value->product_id]['special_price'] = $value->special_price;
                        }

                        $variable_products = DB::select("SELECT attributes.admin_name, attributes.type,  
                        CASE 
                            WHEN attributes.type = 'select' THEN
                            product_attribute_values.integer_value
                            WHEN attributes.type = 'multiselect' THEN
                            product_attribute_values.text_value
                        END value, product_attribute_values.product_id
                        FROM product_attribute_values
                        INNER JOIN attributes on attributes.id = product_attribute_values.attribute_id
                        WHERE product_id in (".implode(',', $prods).")
                        AND attribute_id in (".implode(',', $attrs).")");

                        $options = [];
                        $options_product = [];
                        $option_count = 0;
                        foreach ($variable_products as $key => $value) {
                            $val = explode(',', $value->value);
                            $k = 0;
                            foreach ($val as $val2) {
                                $options[$val2] = $val2;
                                $options_product[$value->product_id]['options'][] = (int)$val2;
                            }
                            $option_count = count($options_product[$value->product_id]['options']);
                        }

                        $options_data = DB::select("SELECT attribute_options.admin_name option_name, 
                        attribute_options.attribute_id, 
                        attributes.admin_name attribute_name,
                        attribute_options.id option_id,
						configurable_option_value.rgb_code
                        FROM attribute_options
                        INNER JOIN attributes on attributes.id = attribute_options.attribute_id
						LEFT join configurable_option_value on configurable_option_value.id = attribute_options.option_value_id
                        WHERE attribute_options.id in (".implode(',', $options).")
                        ORDER BY attribute_options.attribute_id");

                        $pretty_option_data = [];
                        $ko = -1;
                        foreach ($options_data as $key => $value) {
                            if (!array_key_exists($value->attribute_id, $pretty_option_data)) {
                                $ko += 1;
                            }
                            $pretty_option_data[$value->attribute_id]['name'] = $value->attribute_name;
                            $pretty_option_data[$value->attribute_id]['is_color'] = $value->rgb_code == "" ? 0 : 1;
                            $pretty_option_data[$value->attribute_id]['data'][] = $value;
                            $pretty_option_data[$value->attribute_id]['selected'] = '';
                            $pretty_option_data[$value->attribute_id]['position'] = $ko;
                        }

                        return view('shop::products.configure-view')->with([
                            'product' => $product[0],
                            'images' => $images,
                            'options_product' => $options_product,
                            'product_data' => $product_data,
                            'option_count' => $option_count,
                            'pretty_option_data' => $pretty_option_data,
                            'current_cat_name' => $product[0]->name,
                            'span' => '',
                            'html' => ''
                        ]);
                    } else {
                        #region "simple product"

                        $visible_attr = DB::select("SELECT product_attribute_values.text_value, attributes.admin_name attribute_name,
                    product_attribute_values.attribute_id, attributes.type
                    FROM product_attribute_values
                    INNER JOIN attributes on attributes.id = product_attribute_values.attribute_id
                    WHERE product_attribute_values.product_id = ".$product[0]->product_id."
                    AND attributes.is_visible_on_front = 1");

                        $txt = [];
                        foreach ($visible_attr as $key => $visible) {
                            if ($visible->text_value != "" && ($visible->type == "select" ||
                                    $visible->type == "multiselect" || $visible->type == "checkbox")) {
                                $txt[] = $visible->text_value;
                            }
                        }

                        $span = "";
                        if (implode(',', $txt) != "") {
                            $options = DB::select("SELECT attribute_options.admin_name option_name, 
                        attribute_options.attribute_id,
                        attributes.admin_name attribute_name
                        FROM attribute_options
                        INNER JOIN attributes on attributes.id = attribute_options.attribute_id
                        WHERE attribute_options.id in (".implode(',', $txt).")
                        ORDER BY attribute_options.attribute_id");
                            $options_array = [];

                            foreach ($options as $key => $value) {
                                $options_array[$value->attribute_id]['data'][] = $value->option_name;
                                $options_array[$value->attribute_id]['attribute_name'] = $value->attribute_name;
                            }

                            foreach ($options_array as $value) {
                                $span .= $value['attribute_name'] . ': <span class="brand">' . implode(',', $value['data']) . "</span></br>";
                            }
                        }

                        $exist_data = $this->editApiByID($product[0]->product_id);

                        $group_data = DB::select("SELECT attribute_group_mappings.attribute_group_id, attribute_groups.name group_name,
                    attributes.admin_name attribute_name, attributes.id attribute_id, attributes.type,
                    attribute_groups.position
                    FROM products
                    INNER JOIN attribute_groups on attribute_groups.attribute_family_id = products.attribute_family_id
                    INNER JOIN attribute_group_mappings on attribute_group_mappings.attribute_group_id = attribute_groups.id
                    INNER JOIN attributes on attributes.id = attribute_group_mappings.attribute_id
                    where products.id = ".$product[0]->product_id."
                    ORDER BY attribute_groups.position");

                        $group_pretty = [];
                        foreach ($group_data as $key => $value) {
                            $group_pretty[$value->position . '_' . $value->attribute_group_id]['label'] = $value->group_name;
                            $group_pretty[$value->position . '_' . $value->attribute_group_id][$value->attribute_id]['attr_name'] = $value->attribute_name;
                            $group_pretty[$value->position . '_' . $value->attribute_group_id][$value->attribute_id]['attr_value'] = (array_key_exists($value->attribute_id, $exist_data)
                                ? ( ($value->type == "select" || $value->type == "multiselect" || $value->type == "checkbox")
                                    ? $this->options_prettify( array_key_exists('options', $exist_data[$value->attribute_id]) ? $exist_data[$value->attribute_id]['options'] : []) : $exist_data[$value->attribute_id]['attribute_value']  )
                                : "" );
                        }
                        $ex = "";
                        $html = "";
                        foreach ($group_pretty as $key => $value) {
                            if ($key != $ex) {
                                $ex = $key;
                                $html .= '<span class="label2">'.$value['label'].'</span></br>';
                            }

                            foreach ($value as $key2 => $value2) {
                                if ($key2 != "label") {
                                    $html .= '<span class="attribute_Name">'.$value2['attr_name'].'</span>:<span class="attribute_value">'.$value2['attr_value'].'</span></br>';
                                }
                            }
                        }

                        return view($this->_config['product_view'])->with([
                            'product' => $product[0],
                            'images' => $images,
                            'current_cat_name' => $product[0]->name,
                            'span' => $span,
                            'html' => $html
                        ]);
                        #endregion
                    }

                }

            }

        }

        abort(404);
    }

    public function options_prettify($options)
    {
        $txt = "";
        foreach ($options as $key => $value) {
            if ($key == 0) {
                $txt .= $value['option_name'];
            } else {
                $txt .= "," . $value['option_name'];
            }
        }
        return $txt;
    }

    public function editApiByID($id)
    {
        $attr_family = "";
        $attr_data = DB::select("SELECT product_attribute_values.attribute_id, product_attribute_values.text_value,
        product_attribute_values.product_id, products.attribute_family_id, attributes.type, attributes.admin_name attribute_name
        FROM product_attribute_values
        INNER JOIN products on products.id = product_attribute_values.product_id
        INNER JOIN attributes on attributes.id = product_attribute_values.attribute_id
        WHERE product_id = $id");
        $main_data = [];
        $txt = [];
        foreach ($attr_data as $key => $value) {
            if ($value->text_value != "" && ($value->type == "multiselect" || $value->type == "select"
                    || $value->type == "checkbox") ) {
                $txt[] = $value->text_value;
            } else {
                $main_data[$value->attribute_id]['attribute_id'] = $value->attribute_id;
                $main_data[$value->attribute_id]['type'] = $value->type;
                $main_data[$value->attribute_id]['attribute_name'] = $value->attribute_name;
                $main_data[$value->attribute_id]['attribute_value'] = $value->text_value;
            }
        }

        if (count($txt) > 0) {
            $attr_data2 = DB::select("SELECT attribute_options.admin_name option_name, attribute_options.id option_id,
            attribute_options.attribute_id,
            attributes.admin_name attribute_name, attributes.type
            FROM attribute_options
            inner join attributes on attributes.id = attribute_options.attribute_id
            WHERE attribute_options.id in (".implode(',', $txt).") ORDER BY attribute_options.attribute_id");
            $i = -1;
            $in_attr = [];
            foreach ($attr_data2 as $key => $value) {
                if (!in_array($value->attribute_id, $in_attr)) {
                    $i = -1;
                }
                $i += 1;
                $main_data[$value->attribute_id]['attribute_id'] = $value->attribute_id;
                $main_data[$value->attribute_id]['attribute_name'] = $value->attribute_name;
                $main_data[$value->attribute_id]['type'] = $value->type;
                $main_data[$value->attribute_id]['options'][$i]['option_name'] = $value->option_name;
                $main_data[$value->attribute_id]['options'][$i]['option_id'] = $value->option_id;
            }

        }
        return $main_data;
    }

    public function submit_review(Request $request)
    {
        if (auth()->guard('customer')->check()) {
            $user = auth()->guard('customer')->user();
            ProductReview::insert([
                'product_id' => $request->input('product_id'),
                'name' => $user->first_name . ' ' . $user->last_name,
                'customer_id' => $user->id,
                'title' => $request->input('title'),
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);

        } else {
            abort(404);
        }

    }

}