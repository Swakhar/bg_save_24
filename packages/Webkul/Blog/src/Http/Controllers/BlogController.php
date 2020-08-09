<?php

namespace Webkul\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Event;
use Webkul\Blog\Repositories\BlogRepository;


//use Webkul\Blog\Repositories\BlogRepository;

class BlogController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    
    protected $blogRepository;

    
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;

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
    public function store(Request $request)
    {
        $this->validate(request(), [
            'headline'       => ['required', 'unique:blogs,headline']
        ]);
        $image=$request->file('image');
        $ext=$image->getClientOriginalExtension();
        $fileName=$image->getClientOriginalName();
        $tempName='blog'.time().'.'.$ext;
        Storage::disk('blog')->put($tempName,File::get($image));
        $data = request()->all();
        $data['image']=$tempName;
        $blog = $this->blogRepository->create($data);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Blog']));

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
        $blog = $this->blogRepository->findOrFail($id);
        
        return view($this->_config['view'], compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate(request(), [
            'headline' => 'required',
        ]);
        $image=$request->file('image');
        $ext=$image->getClientOriginalExtension();
        $fileName=$image->getClientOriginalName();
        $tempName='blog'.time().'.'.$ext;
        Storage::disk('blog')->put($tempName,File::get($image));
        $data = request()->all();
        $data['image']=$tempName;
        $blog = $this->blogRepository->update($data, $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Blog']));

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
        $blog = $this->blogRepository->findOrFail($id);

        try {
            $this->blogRepository->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Blog']));

            return response()->json(['message' => true], 200);
        } catch(\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Blog']));
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
                $attribute = $this->blogRepository->find($value);

                try {
                    if ($attribute->is_user_defined) {
                        $suppressFlash = true;

                        $this->industryRepository->delete($value);
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