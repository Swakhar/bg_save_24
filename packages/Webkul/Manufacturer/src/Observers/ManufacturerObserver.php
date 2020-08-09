<?php

namespace Webkul\Manufacturer\Observers;

use Illuminate\Support\Facades\Storage;
use Webkul\Manufacturer\Models\Manufacturer;
use Carbon\Carbon;

class ManufacturerObserver
{
    /**
     * Handle the Category "deleted" event.
     *
     * @param  \Webkul\Category\Contracts\Manufacturer  $manufacturer
     * @return void
     */
    public function deleted($manufacturer)
    {
        Storage::deleteDirectory('manufacturer/' . $manufacturer->id);
    }

    /**
     * Handle the Manufacturer "saved" event.
     *
     * @param  \Webkul\Manufacturer\Contracts\Manufacturer  $manufacturer
     */
    public function saved($manufacturer)
    {
        foreach ($manufacturer->children as $child) {
            $child->touch();
        }
    }
}