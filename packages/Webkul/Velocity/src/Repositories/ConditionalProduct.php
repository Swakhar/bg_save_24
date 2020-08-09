<?php

namespace Webkul\Velocity\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\DB;
use Webkul\Core\Eloquent\Repository;
use Webkul\Category\Repositories\CategoryRepository as Category;

class ConditionalProduct
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {

    }

    public function GetMixData()
    {
        $data = DB::select("SELECT mix_customize_section_master.id, mix_customize_section_details.id details_row_id,
        mix_customize_section_master.title, mix_customize_section_details.title details_title,
        mix_customize_section_master.slug, mix_customize_section_details.slug details_slug,
        mix_customize_section_details.image_url, mix_customize_section_details_child.label,
        mix_customize_section_details_child.rule_value, mix_customize_section_details_child.operation, mix_customize_section_details_child.is_multi,
        CASE 
            WHEN mix_customize_section_details_child.label = 'Categories' THEN
                    'category'
            ELSE attributes.type
            END type
        FROM mix_customize_section_master
        INNER JOIN mix_customize_section_details ON 
        mix_customize_section_details.master_section_id = mix_customize_section_master.ID
        INNER JOIN mix_customize_section_details_child ON 
        mix_customize_section_details_child.details_row_id = mix_customize_section_details.ID
        LEFT JOIN attribute_translations on attribute_translations.name = mix_customize_section_details_child.label
        LEFT JOIN attributes on attributes.id = attribute_translations.attribute_id
        ORDER BY mix_customize_section_master.id, mix_customize_section_details.id");

        $details_row_id = "";
        $i = -1;
        $m_data = [];
        $c_data = [];

        foreach ($data as $key => $value) {
            $m_data[$value->id][$value->details_row_id][] = $value;
        }
        $f_data = [];

        foreach ($m_data as $key => $value) {
            $c_data = [];
            foreach ($value as $key2 => $value2) {
                $attr = $this->GetConditionalProduct($value2)['attr'];
                $ci = [];
                foreach ($attr as $K => $V) {
                    $ci[$V->attribute_name] = $this->UniQueData($V->cust_name);
                }
                $c_data[$key2]['attr'] = $ci;
                $c_data[$key2]['details_title'] = count($value2) > 0 ? $value2[0]->details_title : "";
                $c_data[$key2]['details_slug'] = count($value2) > 0 ? $value2[0]->details_slug : "";
                $c_data[$key2]['image_url'] = count($value2) > 0 ? $value2[0]->image_url : "";
                $f_data[$key]['title'] = count($value2) > 0 ? $value2[0]->title : "";
                $f_data[$key]['slug'] = count($value2) > 0 ? $value2[0]->slug : "";
            }
            $f_data[$key]['child'] = $c_data;

        }
        return $f_data;
    }

    public function UniQueData($data)
    {
        $ex_data = explode(',', $data);
        return implode(',', array_unique($ex_data));
    }

    public function GetConditionalProduct($data)
    {
        $main_data = [];
        $INNER_JOIN = "";
        $WHERE = "";
        $rule_val = "";
        $r_rule = [
            '==' => '=',
            '!=' => '!=',
            '>=' => '>=',
            '<=' => '<=',
            '>' => '>',
            '<' => '<',
            '{}' => 'in',
            '!{}' => 'not in',
        ];
        $rule_array = [];
        foreach ($data as $key => $value) {

            if ($value->is_multi == "1" && $value->label == "Categories") {
                $cat_rule_val = $value->rule_value;
            } else if ($value->is_multi == "1") {
                $rule_val = "";
                $rule_val = $value->rule_value;
                $rule_c = "";
                if ($value->operation == '==') {
                    $rule_c = '{}';
                }
                if ($value->operation == '!=') {
                    $rule_c = '!{}';
                }
                else {
                    $rule_c = $value->operation;
                }
                $rule_array[$rule_c] = $rule_val;
            }

            if ($value->type == "Category") {
                $INNER_JOIN .= " INNER JOIN product_categories on product_categories.product_id = a.product_id ";
                $WHERE .= " AND product_categories.category_id ". $r_rule[$value->operation] ." ($value->rule_value) ";
            } else if ($value->type == "price") {
                $WHERE .= " and product_flat.price ". $r_rule[$value->operation] ." $value->rule_value ";
            }
//            else if ($value->type == "multiselect" || $value->type == "select") {
//                $rule_val .= ($rule_val == "" ? $value->rule_value : ", " . $value->rule_value);
//            }
        }

        foreach ($rule_array as $key => $value) {
            $WHERE .= " and b.id ". $r_rule[$key] ." ($value) ";
        }

        $sql = "SELECT a.product_id
        FROM product_attribute_values a
        LEFT JOIN attribute_options b
        ON FIND_IN_SET(b.id, a.text_value) > 0
        INNER JOIN product_flat on product_flat.product_id = a.product_id
        $INNER_JOIN
        WHERE 1 = 1 
        $WHERE
        GROUP BY a.product_id";

        $sql2 = "SELECT tbl.cust_name, attribute_translations.name attribute_name FROM 
        (SELECT GROUP_CONCAT(b.admin_name ORDER BY b.id) cust_name, a.attribute_id 
        FROM product_attribute_values a
        LEFT JOIN attribute_options b
        ON FIND_IN_SET(b.id, a.text_value) > 0
        left join attributes on attributes.id = a.attribute_id 
        INNER JOIN product_flat on product_flat.product_id = a.product_id
        $INNER_JOIN
        WHERE 1 = 1  and b.admin_name is not null and attributes.type in ('select','multiselect')
        $WHERE
        GROUP BY a.attribute_id) tbl 
        INNER JOIN attribute_translations on tbl.attribute_id = attribute_translations.attribute_id and attribute_translations.locale = 'en'";

        $product = DB::select($sql);
        $product_attr = DB::select($sql2);
        $prod = "";

        foreach ($product as $key => $value) {
            $prod .= ($key == 0 ? $value->product_id : ",".$value->product_id);
        }
//        return $this->GetProductInfo($prod, true);
        return [
            'product' => $this->GetProductInfo($prod, true),
            'attr' => $product_attr
        ];

    }

    public function GetConditionalProductDirect($data)
    {
        $main_data = [];
        $INNER_JOIN = "";
        $WHERE = "";
        $rule_val = "";
        $cat_rule_val = "";

        $r_rule = [
            '==' => '=',
            '!=' => '!=',
            '>=' => '>=',
            '<=' => '<=',
            '>' => '>',
            '<' => '<',
            '{}' => 'in',
            '!{}' => 'not in',
        ];

        $rule_array = [];

        foreach ($data as $key => $value) {

            if ($value['is_multi'] && $value['label'] == "Categories") {
                foreach ($value['rule_value_multi'] as $k => $v) {
                    if ($k == 0) {
                        $cat_rule_val .= $v['id'];
                    } else {
                        $cat_rule_val .= ',' . $v['id'];
                    }
                }
            } else if ($value['is_multi']) {
                $rule_val = "";
                foreach ($value['rule_value_multi'] as $k => $v) {
                    if ($k == 0) {
                        $rule_val .= $v['id'];
                    } else {
                        $rule_val .= ',' . $v['id'];
                    }
                }
                $rule_c = "";
                if ($value['rule'] == '==') {
                    $rule_c = '{}';
                }
                if ($value['rule'] == '!=') {
                    $rule_c = '!{}';
                }
                else {
                    $rule_c = $value['rule'];
                }
                $rule_array[$rule_c] = $rule_val;
            }

            if ($value['label'] == "Categories") {
                $INNER_JOIN .= " INNER JOIN product_categories on product_categories.product_id = a.product_id ";
                $WHERE .= " AND product_categories.category_id ". $r_rule[$value['rule']] ." ($cat_rule_val) ";
            } else if ($value['label'] == "price") {
                $WHERE .= " and product_flat.price " . $r_rule[$value['rule']] . $value['rule_value'];
            }
        }

        foreach ($rule_array as $key => $value) {
            $WHERE .= " and b.id ". $r_rule[$key] ." ($value) ";
        }

        $sql = "SELECT a.product_id
        FROM product_attribute_values a
        LEFT JOIN attribute_options b
        ON FIND_IN_SET(b.id, a.text_value) > 0
        INNER JOIN product_flat on product_flat.product_id = a.product_id
        $INNER_JOIN
        WHERE 1 = 1 
        $WHERE
        GROUP BY a.product_id";

        $product = DB::select($sql);
        $prod = "";

        foreach ($product as $key => $value) {
            $prod .= ($key == 0 ? $value->product_id : ",".$value->product_id);
        }
        return $this->GetProductImageByCondition($prod);
    }

    public function GetProductImageByCondition($prod)
    {
        return DB::select("SELECT path FROM product_images
        WHERE product_id IN ($prod)");
    }

    public function GetProductInfo($product_id, $is_sort_by_price = false)
    {
        $order_by = "";
        if ($is_sort_by_price) {
            $order_by = " ORDER by  product_flat.price asc ";
        } else {
            $order_by = " ORDER by  product_flat.product_id ";
        }
        $products = [];
        if ($product_id != "") {
            $products = DB::select("SELECT product_flat.name, product_flat.id, round(product_flat.price) price, 
            round(product_flat.special_price) special_price, product_flat.url_key, product_images.path, product_flat.product_id
            FROM product_flat
            INNER JOIN product_images on product_images.product_id = product_flat.product_id
            WHERE product_flat.product_id IN ($product_id) $order_by");
        }

        return $products;
       /*
        $prod = "";
        $P = [];
        foreach ($products as $key => $value) {
            if ($prod != $value->product_id) {
                $prod = $value->product_id;
                $P[] = $value;
            }
        }
        return $P;
       */
    }
}