<?php

namespace Webkul\Manufacturer\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Manufacturer\Models\Manufacturer::class,
        \Webkul\Manufacturer\Models\ManufacturerTranslation::class
    ];
}