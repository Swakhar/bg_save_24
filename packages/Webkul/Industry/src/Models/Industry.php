<?php

namespace Webkul\Industry\Models;

use Webkul\Core\Eloquent\TranslatableModel;
use Illuminate\Database\Eloquent\Model;
//use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Webkul\Industry\Contracts\Industry as IndustryContract;
//use Webkul\Industry\Repositories\IndustryRepository;

/**
 * Class Category
 *
 * @package Webkul\Category\Models
 *
 * @property-read string $url_path maintained by database triggers
 */
//class Industry extends TranslatableModel implements IndustryContract
class Industry extends Model implements IndustryContract
{
   // use NodeTrait;

    protected $table = 'related_industries';
    protected $fillable = ['name'];

}