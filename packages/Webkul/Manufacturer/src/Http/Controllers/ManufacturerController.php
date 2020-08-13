<?php

namespace Webkul\Manufacturer\Http\Controllers;

use App\Helper\ImageManipulation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Repositories\LocaleRepository;
use Webkul\Manufacturer\Models\ConfigurableOption;
use Webkul\Manufacturer\Repositories\ManufacturerRepository;

class ManufacturerController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * AttributeRepository object
     *
     * @var \Webkul\Attribute\Repositories\AttributeRepository
     */
    protected $manufacturerRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Attribute\Repositories\AttributeRepository  $attributeRepository
     * @return void
     */
    public function __construct(ManufacturerRepository $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;

        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $local = app('Webkul\Core\Repositories\LocaleRepository')->all();
        $this->validate(request(), [
            'admin_name'       => ['required', 'unique:manufacturers'],
            'image.*'     => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $master_data = [];
        $value_translation = [];
        $path = '/uploads/option_image/';
        $path2 = '/option_image/';
        $image = "";
        $imageManipulation = new ImageManipulation();
         foreach (request()->input('image') as $key => $value) {
             if(request()->hasFile('image.'.$key)) {
                 $file = request()->file('image')[$key];
                 $image = $path2 . $imageManipulation->UploadImage($file, $path);
             } else {
                 $image = "";
             }
         }
        $master_data['admin_name'] = request()->input('admin_name');
        $master_data['description'] = request()->input('description');
        $master_data['published'] = request()->input('published');
        $master_data['dis_order'] = request()->input('dis_order');
        $master_data['discounts'] = request()->input('discounts');
        $master_data['rgb_code'] = request()->input('rgb_code');
        $master_data['image'] = $image;

        $id = DB::table('configurable_option_value')->insertGetId($master_data);

        foreach ($local as $key => $value) {
            $value_translation[$key]['locale'] = $value->code;
            $value_translation[$key]['configurable_option_id'] = $id;
            $value_translation[$key]['name'] = request()->input($value->code)['name'];
        }

        DB::table('configurable_option_value_translation')->insert($value_translation);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Manufacturer']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $configurableoption = ConfigurableOption::where('id', $id)->first();
        
        return view($this->_config['view'], compact('configurableoption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //return request()->all();
        $local = app('Webkul\Core\Repositories\LocaleRepository')->all();
        $this->validate(request(), [
            'admin_name'       => ['required', 'unique:manufacturers'],
            'image.*'     => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $master_data = [];
        $value_translation = [];
        $path = '/uploads/option_image/';
        $path2 = '/option_image/';
        $image = "";
        $imageManipulation = new ImageManipulation();
        foreach (request()->input('image') as $key => $value) {
            if(request()->hasFile('image.'.$key)) {
                $file = request()->file('image')[$key];
                $image = $path2 . $imageManipulation->UploadImage($file, $path);
            } else {
                $image = "";
            }
        }
        $master_data['admin_name'] = request()->input('admin_name');
        $master_data['description'] = request()->input('description');
        $master_data['published'] = request()->input('published');
        $master_data['dis_order'] = request()->input('dis_order');
        $master_data['discounts'] = request()->input('discounts');
        $master_data['rgb_code'] = request()->input('rgb_code');
        $master_data['image'] = $image;

        DB::table('configurable_option_value')->where('id', $id)->update($master_data);
        DB::table('configurable_option_value_translation')->where('configurable_option_id', $id)->delete();
        foreach ($local as $key => $value) {
            $value_translation[$key]['locale'] = $value->code;
            $value_translation[$key]['configurable_option_id'] = $id;
            $value_translation[$key]['name'] = request()->input($value->code)['name'];
        }

        DB::table('configurable_option_value_translation')->insert($value_translation);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Manufacturer']));
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer = $this->manufacturerRepository->findOrFail($id);

        try {
            $this->manufacturerRepository->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Manufacturer']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Manufacturer']));
        }

        return response()->json(['message' => false], 400);
    }

    /**
     * Remove the specified resources from database
     *
     * @return \Illuminate\Http\Response
     */
    /*public function massDestroy()
    {
        $suppressFlash = false;

        if (request()->isMethod('post')) {
            $indexes = explode(',', request()->input('indexes'));

            foreach ($indexes as $key => $value) {
                $attribute = $this->manufacturerRepository->find($value);

                try {
                    if ($attribute->is_user_defined) {
                        $suppressFlash = true;

                        $this->manufacturerRepository->delete($value);
                    } else {
                        session()->flash('error', trans('admin::app.response.user-define-error', ['name' => 'Attribute']));
                    }
                } catch (\Exception $e) {
                    report($e);

                    $suppressFlash = true;

                    continue;
                }
            }

            if ($suppressFlash) {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.delete-success', ['resource' => 'attributes']));
            } else {
                session()->flash('info', trans('admin::app.datagrid.mass-ops.partial-action', ['resource' => 'attributes']));
            }

            return redirect()->back();
        } else {
            session()->flash('error', trans('admin::app.datagrid.mass-ops.method-error'));

            return redirect()->back();
        }
    }*/
}