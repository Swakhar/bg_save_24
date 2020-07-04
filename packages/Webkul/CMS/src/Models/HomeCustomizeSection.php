<?php

namespace Webkul\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomeCustomizeSection extends Model
{
    protected $fillable = ['layout'];

    protected  $table = "home_sliders";

    public static function GetSectionData()
    {
        $sql = "SELECT * FROM 
        (
        SELECT home_customize_section_masters.name section_name, 
        home_customize_section_details.display_category_id, 
        home_customize_section_details.master_id,
        home_customize_section_details.display_block_type,
        category_translations.name display_name,
        home_customize_section_masters.position,
        home_customize_section_masters.is_visible
        FROM home_customize_section_masters
        INNER JOIN home_customize_section_details on 
        home_customize_section_details.master_id = home_customize_section_masters.id
        inner join category_translations on category_translations.category_id = home_customize_section_details.display_category_id
        WHERE home_customize_section_details.display_block_type = 1
        and home_customize_section_masters.is_visible = 1
        union 
        SELECT home_customize_section_masters.name section_name, 
        home_customize_section_details.display_category_id, 
        home_customize_section_details.master_id,
        home_customize_section_details.display_block_type,
        product_flat.name display_name,
        home_customize_section_masters.position,
        home_customize_section_masters.is_visible
        FROM home_customize_section_masters
        INNER JOIN home_customize_section_details on 
        home_customize_section_details.master_id = home_customize_section_masters.id
        inner join product_flat on product_flat.product_id = home_customize_section_details.display_category_id
        WHERE home_customize_section_details.display_block_type = 2
        and home_customize_section_masters.is_visible = 1
        ) tbl
        ORDER BY tbl.master_id, tbl.position ";
        return DB::select(DB::raw($sql));
    }

}