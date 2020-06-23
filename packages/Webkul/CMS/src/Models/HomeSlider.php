<?php

namespace Webkul\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\CMS\Contracts\CmsPage as CmsPageContract;
use Webkul\Core\Models\ChannelProxy;

class HomeSlider extends Model
{
    protected $fillable = ['layout'];

    protected  $table = "home_sliders";

    public static function GetRecommendedSlider() {
        $local = request()->get('locale') ?: app()->getLocale();
       return DB::select(DB::raw("SELECT slider_name_master.name slider_name, category_translations.name category_name,
        product_flat.name product_name, product_flat.product_id, category_translations.category_id,
        home_sliders.id
        FROM slider_name_master 
        INNER JOIN home_sliders on home_sliders.slider_name_master_id = slider_name_master.id
        INNER JOIN home_slider_products on home_slider_products.home_slider_id = home_sliders.id
        INNER JOIN category_translations on category_translations.category_id = home_sliders.category_id
        INNER JOIN product_flat on product_flat.product_id = home_slider_products.product_id
        WHERE slider_name_master.slider_type = 1
        and category_translations.locale = '$local'
        ORDER BY home_sliders.id, category_translations.name"));
    }

    public static function FindAndGetRecommendedSliderId()
    {
        return DB::select(DB::raw("SELECT count(slider_name_master.name)
        FROM slider_name_master 
        WHERE slider_name_master.slider_type = 1"));
    }
}