<?php

namespace Webkul\Manufacturer\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Manufacturer\Contracts\ManufacturerTranslation as ManufacturerTranslationContract;

class ManufacturerTranslation extends Model implements ManufacturerTranslationContract
{
    public $timestamps = false;
    protected $table = 'manufacturer_translations';

    protected $fillable = ['name'];
}