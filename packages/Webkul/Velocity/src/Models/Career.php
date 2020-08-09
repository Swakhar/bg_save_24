<?php

namespace Webkul\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Velocity\Contracts\Career as CareerContract;

class Career extends Model implements CareerContract
{
    
    protected $table = 'careers';

    protected $fillable = [
        'email',
        'phone',
        'cv',
    ];
}