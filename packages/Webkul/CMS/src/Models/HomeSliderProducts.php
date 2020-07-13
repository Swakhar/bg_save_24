<?php

namespace Webkul\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\CMS\Contracts\CmsPage as CmsPageContract;
use Webkul\Core\Models\ChannelProxy;

class HomeSliderProducts extends Model
{
    protected $fillable = ['layout'];

    protected  $table = "home_slider_products";


}