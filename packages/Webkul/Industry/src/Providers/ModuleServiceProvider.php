<?php

namespace Webkul\Industry\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Industry\Models\Industry::class,
        \Webkul\Industry\Models\IndustryTranslation::class
    ];
}