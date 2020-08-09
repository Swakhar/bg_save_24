<?php

namespace Webkul\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\CMS\Contracts\HomeSlider as HomeSliderContract;
use Webkul\Core\Models\ChannelProxy;

class HomeSliderMaster extends Model
{
    protected $fillable = ['layout'];

    protected  $table = "slider_name_master";



}