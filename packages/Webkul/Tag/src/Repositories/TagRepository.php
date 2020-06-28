<?php

namespace Webkul\Tag\Repositories;

use Webkul\Core\Eloquent\Repository;
use Illuminate\Support\Facades\Event;
use Illuminate\Container\Container as App;
use Illuminate\Support\Str;


class TagRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Tag\Contracts\Tag';
    }

    /**
     * @param  array  $data
     * @return \Webkul\Category\Contracts\Category
     */
    public function create(array $data)
    {
        $tag = $this->model->create($data);

        return $tag;
    }

    /**
     * @param  array  $data
     * @param  int $id
     * @param  string  $attribute
     * @return \Webkul\Attribute\Contracts\Attribute
     */
    public function update(array $data, $id, $tag = "id")
    {
        
        $tag = $this->find($id);
        Event::dispatch('catalog.attribute.update.before', $id);

        $tag->update($data);

        Event::dispatch('catalog.attribute.update.after', $tag);

        return $tag;
    }

    /**
     * @param  int  $id
     * @return void
     */
    public function delete($id)
    {
        Event::dispatch('catalog.attribute.delete.before', $id);

        parent::delete($id);

        Event::dispatch('catalog.attribute.delete.after', $id);
    }

}