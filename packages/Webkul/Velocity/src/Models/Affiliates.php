<?php

namespace Webkul\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Velocity\Contracts\Affiliates as AffiliatesContract;

class Affiliates extends Model implements AffiliatesContract
{
    
    protected $table = 'affiliates';

    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}