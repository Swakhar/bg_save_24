<?php

namespace Webkul\Velocity\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Webkul\Core\Eloquent\Repository;

class CareerRepository extends Repository
{   
    function model()
    {
        return 'Webkul\Velocity\Contracts\Career';
    }
    public function create(array $data)
    {
        
        $career = $this->model->create($data);
        return $career;
    }
}