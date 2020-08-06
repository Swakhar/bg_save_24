<?php

namespace Webkul\Blog\Observers;

use Illuminate\Support\Facades\Storage;
use Webkul\Blog\Models\Blog;
use Carbon\Carbon;

class BlogObserver
{
    /**
     * Handle the Category "deleted" event.
     *
     * @param  \Webkul\Category\Contracts\Blog  $blog
     * @return void
     */
    public function deleted($blog)
    {
        Storage::deleteDirectory('blogs/' . $blog->id);
    }

    /**
     * Handle the Blog "saved" event.
     *
     * @param  \Webkul\Blog\Contracts\Blog  $blog
     */
    public function saved($blog)
    {
        foreach ($blog->children as $child) {
            $child->touch();
        }
    }
}