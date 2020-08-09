<?php

namespace Webkul\Tag\Observers;

use Illuminate\Support\Facades\Storage;
use Webkul\Tag\Models\Tag;
use Carbon\Carbon;

class TagObserver
{
    /**
     * Handle the Category "deleted" event.
     *
     * @param  \Webkul\Category\Contracts\Tag  $tag
     * @return void
     */
    public function deleted($tag)
    {
        Storage::deleteDirectory('tag/' . $tag->id);
    }

    /**
     * Handle the Tag "saved" event.
     *
     * @param  \Webkul\Tag\Contracts\Tag  $tag
     */
    public function saved($tag)
    {
        foreach ($tag->children as $child) {
            $child->touch();
        }
    }
}