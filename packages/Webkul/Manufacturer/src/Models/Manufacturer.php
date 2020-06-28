<?php

namespace Webkul\Manufacturer\Models;

use Webkul\Core\Eloquent\TranslatableModel;
use Illuminate\Support\Facades\Storage;
use Webkul\Manufacturer\Contracts\Manufacturer as ManufacturerContract;


class Manufacturer extends TranslatableModel implements ManufacturerContract
{
   public $translatedAttributes = ['name'];
   protected $table = 'manufacturers';
   protected $fillable = ['admin_name','description','published','dis_order','discounts','image'];

   /**
     * Get image url for the manufacurer image.
     */
    public function image_url()
    {
        if (! $this->image)
            return;

        return Storage::url($this->image);
    }

    /**
     * Get image url for the manufacurer image.
     */
    public function getImageUrlAttribute()
    {
        return $this->image_url();
    }
}