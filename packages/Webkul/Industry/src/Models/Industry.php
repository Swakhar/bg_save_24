<?php

namespace Webkul\Industry\Models;

use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\Industry\Contracts\Industry as IndustryContract;


class Industry extends TranslatableModel implements IndustryContract
{
   public $translatedAttributes = ['name'];
   protected $table = 'related_industries';
   protected $fillable = ['code','admin_name'];

}