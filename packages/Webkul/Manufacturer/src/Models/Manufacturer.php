<?php

namespace Webkul\Manufacturer\Models;

use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\Manufacturer\Contracts\Manufacturer as ManufacturerContract;


class Manufacturer extends TranslatableModel implements ManufacturerContract
{
   public $translatedAttributes = ['name'];
   protected $table = 'manufacturers';
   protected $fillable = ['admin_name','description','published','dis_order','discounts'];
}