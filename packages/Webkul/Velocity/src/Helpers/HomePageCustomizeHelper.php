<?php

namespace Webkul\Velocity\Helpers;

use Illuminate\Support\Facades\DB;

class HomePageCustomizeHelper
{
    function GetCategoryString($arr)
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

        return $attr . ':' . $options;
    }

    function GetAttributeString($arr)
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
            return $attr . ':' . $options;
        } else if ($sql_get_type_data == "price") {

        }


    }
}
