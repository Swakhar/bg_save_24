<?php

namespace Webkul\Velocity\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Velocity\Contracts\ContactMessages as ContactMessagesContract;

class ContactMessages extends Model implements ContactMessagesContract
{
    
    protected $table = 'contact_messages';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
}