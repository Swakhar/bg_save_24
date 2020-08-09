<?php

namespace Webkul\Manufacturer\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Manufacturer\Contracts\ManufacturerTranslation as ManufacturerTranslationContract;

class ConfigurableOptionTranslation extends Model implements ManufacturerTranslationContract
{
    public $timestamps = false;
    protected $table = 'configurable_option_value_translation';

    protected $fillable = ['name'];
}