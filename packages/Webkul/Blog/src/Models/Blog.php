<?php

namespace Webkul\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Blog\Contracts\Blog as BlogContract;


class Blog extends Model implements BlogContract
{
   protected $table = 'blogs';
   protected $fillable = ['headline','description','video','image'];
}