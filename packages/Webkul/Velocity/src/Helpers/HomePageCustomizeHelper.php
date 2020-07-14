<?php

namespace Webkul\Velocity\Helpers;

use Illuminate\Support\Facades\DB;

class HomePageCustomizeHelper
{
    protected $exist_val = [];
    protected $exist_index = "";
    function GetCategoryString($arr, $index)
    {
        $rule = "";
        $rule_value = [];
        $attr = "";
        foreach ($arr as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $rule = $value2['rule_operator'];
                $rule_value[] = $value2['rule_value'];
            }
            $attr = $key;
        }
        $val = implode(',', $rule_value);

        $data = DB::select("SELECT name FROM category_translations
      WHERE category_id ".($rule == '{}' ? ' in ' : ' not in ')." ($val)");
        $options = "";
        foreach ($data as $key => $value) {
            if ($key == 0)
                $options .= $value->name;
            else
                $options .= ", " . $value->name;

        }
        if ($this->exist_index != $index) {
            $this->exist_index = $index;
            unset($this->exist_val);
            $this->exist_val = array();
        }
        $this->exist_val[] = $val;
        return $attr . ':' . $options;
    }

    function GetAttributeString($arr, $index)
    {
        $list = ['boolean', 'checkbox', 'date', 'datetime', 'file', 'image', 'multiselect', 'price', 'select', 'text', 'textarea'];
        $rule = "";
        $rule_value = [];
        $attr = "";
        foreach ($arr as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $rule = $value2['rule_operator'];
                $rule_value[] = $value2['rule_value'];
            }
            $attr = $key;
        }

        $rule_map = [
            '==' => '=',
            '!=' => '!=',
            '>=' => '>=',
            '<=' => '<=',
            '>' => '>',
            '<' => '<',
            '{}' => 'in',
            '!{}' => 'not in',
        ];

        $val = implode(',', $rule_value);

        $sql_get_type = "SELECT attributes.type FROM attribute_translations
        INNER JOIN attributes on attributes.id = attribute_translations.attribute_id
        WHERE name = '$attr'";
        $sql_get_type_data = DB::select($sql_get_type)[0]->type;

        if ($sql_get_type_data == "checkbox" || $sql_get_type_data == "multiselect"
            || $sql_get_type_data == "select") {
            $data = DB::select("SELECT attribute_options.admin_name FROM attribute_translations
            INNER JOIN attribute_options on 
            attribute_options.attribute_id = attribute_translations.attribute_id
            WHERE  name = '$attr'
            AND attribute_options.id ".($rule == '{}' ? ' in ' : ' not in ')." ($val)");
            $options = "";
            foreach ($data as $key => $value) {
                if ($key == 0)
                    $options .= $value->admin_name;
                else
                    $options .= ", " . $value->admin_name;

            }
            if ($this->exist_index != $index) {
                $this->exist_index = $index;
                unset($this->exist_val);
                $this->exist_val = array();
            }
            $this->exist_val[] = $val;
            return $attr . ':' . $options;
        } else if ($sql_get_type_data == "price") {
            $sql_price_product = "SELECT price FROM product_flat
            WHERE product_id in (SELECT product_id FROM product_attribute_values
            WHERE attribute_id in (".implode(',', $this->exist_val)."))
            and price $rule_map[$rule] $val AND status = 1
            ORDER BY price ";
            $data = DB::select($sql_price_product);
            $low_price = count($data) > 0 ? $data[0]->price : 0;
            $high_price = count($data) > 0 ? $data[count($data)-1]->price : 0;
            if ($this->exist_index != $index) {
                $this->exist_index = $index;
                unset($this->exist_val);
                $this->exist_val = array();
            }
            return $attr . ': ' . round($low_price) . ' to ' . round($high_price);
        }


    }
}
