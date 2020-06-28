<?php

namespace Webkul\Manufacturer\Repositories;

use Webkul\Core\Eloquent\Repository;
use Illuminate\Support\Facades\Event;
use Illuminate\Container\Container as App;
use Illuminate\Support\Str;
//use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Support\Facades\DB;

class ManufacturerRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Manufacturer\Contracts\Manufacturer';
    }

    /**
     * @param  array  $data
     * @return \Webkul\Category\Contracts\Category
     */
    public function create(array $data)
    {
        $manufacturer = $this->model->create($data);
        $this->uploadImages($data, $manufacturer);
        return $manufacturer;
    }

    /**
     * @param  array  $data
     * @param  int $id
     * @param  string  $attribute
     * @return \Webkul\Attribute\Contracts\Attribute
     */
    public function update(array $data, $id, $manufacturer = "id")
    {
        
        $manufacturer = $this->find($id);

        Event::dispatch('catalog.attribute.update.before', $id);

        $manufacturer->update($data);
        $this->uploadImages($data, $manufacturer);

        Event::dispatch('catalog.attribute.update.after', $manufacturer);

        return $manufacturer;
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

    public function uploadImages($data, $manufacturer, $type = "image")
    {
        if (isset($data[$type])) {
            $request = request();

            foreach ($data[$type] as $imageId => $image) {
                $file = $type . '.' . $imageId;
                $dir = 'manufacturer/' . $manufacturer->id;

                if ($request->hasFile($file)) {
                    if ($manufacturer->{$type}) {
                        Storage::delete($manufacturer->{$type});
                    }

                    $manufacturer->{$type} = $request->file($file)->store($dir);
                    $manufacturer->save();
                }
            }
        } else {
            if ($manufacturer->{$type}) {
                Storage::delete($manufacturer->{$type});
            }

            $manufacturer->{$type} = null;
            $manufacturer->save();
        }
    }

}