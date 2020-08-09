<?php

namespace Webkul\Tag\Models;

use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\Tag\Contracts\Tag as TagContract;


class Tag extends TranslatableModel implements TagContract
{
   public $translatedAttributes = ['name'];
   protected $table = 'tags';
   protected $fillable = ['admin_name','status'];

}