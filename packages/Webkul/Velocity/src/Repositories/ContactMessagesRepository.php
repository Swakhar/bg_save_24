<?php

namespace Webkul\Velocity\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;

class ContactMessagesRepository extends Repository
{   
    function model()
    {
        return 'Webkul\Velocity\Contracts\ContactMessages';
    }
    public function create(array $data)
    {
        $message = $this->model->create($data);

        return $message;
    }
}