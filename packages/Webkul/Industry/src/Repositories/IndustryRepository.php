<?php

namespace Webkul\Industry\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Eloquent\Repository;
use Webkul\Industry\Models\Industry;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class IndustryRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Industry\Contracts\Industry';
    }

    /**
     * @param  array  $data
     * @return \Webkul\Category\Contracts\Category
     */
    public function create(array $data)
    {
        Event::dispatch('catalog.industry.create.before');        
        //$industry = $this->model->create($data);
        //$industry = $this->model->create($data);


        Event::dispatch('catalog.industry.create.after', $industry);

        return $industry;
    }

    /**
     * Specify category tree
     *
     * @param  int  $id
     * @return \Webkul\Category\Contracts\Category
     */
    public function getIndustryTree($id = null)
    {
        return $id
               ? $this->model::orderBy('name', 'ASC')->where('id', '!=', $id)->get()->toTree()
               : $this->model::orderBy('name', 'ASC')->get()->toTree();
    }

    /**
     * Specify category tree
     *
     * @param  int  $id
     * @return \Illuminate\Support\Collection
     */
    public function getIndustryTreeWithoutDescendant($id = null)
    {
        return $id
               ? $this->model::orderBy('name', 'ASC')->where('id', '!=', $id)->whereNotDescendantOf($id)->get()->toTree()
               : $this->model::orderBy('name', 'ASC')->get()->toTree();
    }

    

    
    /**
     * Checks slug is unique or not based on locale
     *
     * @param  int  $id
     * @param  string  $slug
     * @return bool
     */
    public function isNameUnique($id, $name)
    {   
        $exists = Industry::modelClass()::where('id', '<>', $id)
            ->where('name', $name)
            ->limit(1)
            ->select(DB::raw(1))
            ->exists();

        return $exists ? false : true;
    }

    /**
     * Retrive category from slug
     *
     * @param string $slug
     * @return \Webkul\Category\Contracts\Category
     */
    public function findByNameOrFail($name)
    {
        $industry = $this->model->whereTranslation('name', $name)->first();

        if ($industry) {
            return $industry;
        }

        throw (new ModelNotFoundException)->setModel(
            get_class($this->model), $name
        );
    }


    /**
     * @param  array  $data
     * @param  int  $id
     * @param  string  $attribute
     * @return \Webkul\Category\Contracts\Category
     */
    public function update(array $data, $id)
    {
       // $industry = $this->find($id);

        //Event::dispatch('catalog.industry.update.before', $id);

        //$industry->update($data);

        //Event::dispatch('catalog.industry.update.after', $id);

        //return $industry;
    }

    /**
     * @param  int  $id
     * @return void
     */
    public function delete($id)
    {
        Event::dispatch('catalog.industry.delete.before', $id);

        parent::delete($id);

        Event::dispatch('catalog.industry.delete.after', $id);
    }

}