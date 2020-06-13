<?php

namespace Webkul\Industry\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Webkul\Industry\Models\Industry;
use Illuminate\Http\Request;

//use Webkul\Industry\Repositories\IndustryRepository;

class IndustryController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * IndustryRepository object
     *
     * @var \Webkul\Category\Repositories\IndustryRepository
     */
    //protected $industryRepository;

    public function __construct(
        //IndustryRepository $industryRepository
    )
    {
       // $this->industryRepository = $industryRepository;

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
        //$industries = $this->industryRepository->getIndustryTree(null, ['id']);


        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'        => ['required', 'unique:related_industries'],
        ]);

        //$industries = $this->industryRepository->create(request()->all());
        $ind_id=strtolower($request->name);
        $industry =new Industry;
        $industry->name=$request->name;
        $industry->ind_id=$ind_id;
        $industry->save();

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Industry']));

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
        $industry = Industry::findOrFail($id);

        //$industries = $this->industryRepository->getIndustryTreeWithoutDescendant($id);

        return view($this->_config['view'], compact('industry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $industry = Industry::findOrFail($id);
        $name=$industry->name;
        if($name==$request->name){
            session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Industry']));

            return redirect()->route($this->_config['redirect']);
        }
        $this->validate(request(), [
            'name'        => ['required', 'unique:related_industries'],
        ]);

        $ind_id=strtolower($request->name);
        $industry = Industry::findOrFail($id);
        $industry->name=$request->name;
        $industry->ind_id=$ind_id;
        $industry->save();

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Industry']));

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
        $industry = Industry::findOrFail($id);
        $industry ->delete();

        Event::dispatch('catalog.category.delete.after', $id);

        session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Industry']));

        return response()->json(['message' => true], 200);
            
    }

    /*
    public function massDestroy()
    {
        $suppressFlash = false;

        if (request()->isMethod('delete') || request()->isMethod('post')) {
            $indexes = explode(',', request()->input('indexes'));

            foreach ($indexes as $key => $value) {
                try {
                    Event::dispatch('catalog.category.delete.before', $value);

                    $this->industryRepository->delete($value);

                    Event::dispatch('catalog.category.delete.after', $value);
                } catch(\Exception $e) {
                    $suppressFlash = true;

                    continue;
                }
            }

            if (! $suppressFlash) {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.delete-success'));
            } else {
                session()->flash('info', trans('admin::app.datagrid.mass-ops.partial-action', ['resource' => 'Attribute Family']));
            }

            return redirect()->back();
        } else {
            session()->flash('error', trans('admin::app.datagrid.mass-ops.method-error'));

            return redirect()->back();
        }
    }*/
}