<?php

namespace Webkul\Tag\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Tag\Contracts\TagTranslation as TagTranslationContract;

class TagTranslation extends Model implements TagTranslationContract
{
    public $timestamps = false;
    protected $table = 'tags_translations';

    protected $fillable = ['name'];
}