<?php

namespace Webkul\Industry\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Industry\Contracts\IndustryTranslation as IndustryTranslationContract;

class IndustryTranslation extends Model implements IndustryTranslationContract
{
    public $timestamps = false;
    protected $table = 'related_industries_translations';

    protected $fillable = ['name'];
}