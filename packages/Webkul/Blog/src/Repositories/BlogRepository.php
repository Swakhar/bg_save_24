<?php

namespace Webkul\Blog\Repositories;

use Webkul\Core\Eloquent\Repository;
use Illuminate\Support\Facades\Event;
use Illuminate\Container\Container as App;

class BlogRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Blog\Contracts\Blog';
    }

    /**
     * @param  array  $data
     * @return \Webkul\Category\Contracts\Category
     */
    public function create(array $data)
    {
        
        $blog = $this->model->create($data);

        return $blog;
    }

    public function update(array $data, $id, $blog = "id")
    {

        $blog = $this->find($id);

        $blog->update($data);

        return $blog;
    }

    /**
     * @param  int  $id
     * @return void
     */
    public function delete($id)
    {
        parent::delete($id);

    }
    
}