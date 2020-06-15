<?php

namespace Webkul\Industry\Observers;

use Illuminate\Support\Facades\Storage;
use Webkul\Industry\Models\Industry;
use Carbon\Carbon;

class IndustryObserver
{
    /**
     * Handle the Category "deleted" event.
     *
     * @param  \Webkul\Category\Contracts\Industry  $industry
     * @return void
     */
    public function deleted($industry)
    {
        Storage::deleteDirectory('industry/' . $industry->id);
    }

    /**
     * Handle the Industry "saved" event.
     *
     * @param  \Webkul\Industry\Contracts\Industry  $industry
     */
    public function saved($industry)
    {
        foreach ($industry->children as $child) {
            $child->touch();
        }
    }
}