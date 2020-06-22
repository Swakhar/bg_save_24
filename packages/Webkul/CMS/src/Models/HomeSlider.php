<?php

namespace Webkul\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\CMS\Contracts\CmsPage as CmsPageContract;
use Webkul\Core\Models\ChannelProxy;

class HomeSlider extends Model
{
    protected $fillable = ['layout'];

    protected  $table = "home_sliders";


}