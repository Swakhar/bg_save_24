<?php

namespace Webkul\Shop\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Webkul\Shop\Http\Controllers\Controller;
use Webkul\Velocity\Repositories\ContactMessagesRepository;
use Webkul\Velocity\Repositories\AffiliatesRepository;
use Webkul\Velocity\Repositories\CareerRepository;
use Webkul\Blog\Repositories\BlogRepository;

 class StaticPageController extends Controller
{

    protected $_config;
    
    protected $contactMessagesRepository;
    protected $affiliatesRepository;
    protected $careerRepository;
    protected $blogRepository;

    public function __construct(ContactMessagesRepository $contactMessagesRepository,AffiliatesRepository $affiliatesRepository,CareerRepository $careerRepository,BlogRepository $blogRepository)
    {
        $this->contactMessagesRepository = $contactMessagesRepository;
        $this->affiliatesRepository = $affiliatesRepository;
        $this->careerRepository = $careerRepository;
        $this->blogRepository = $blogRepository;

        $this->_config = request('_config');
    }

    
    public function aboutus()
    {
        $menu="About Safeshop";
        return view($this->_config['view'],compact('menu'));
    }
    public function contact()
    {
        $menu="Contact Us";
        return view($this->_config['view'],compact('menu'));
    }
    public function message()
    {
        $menu="Contact Us";
        $this->validate(request(), [
            'name'       => ['required'],
            'email'       => ['required'],
            'subject'       => ['required'],
            'message'       => ['required'],
        ]);
        
        $data = request()->all();
        $message = $this->contactMessagesRepository->create($data);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Message']));

        return redirect()->route($this->_config['redirect'],compact('menu'));
    }
    public function privacy()
    {
        $menu="Privacy Policy";
        return view($this->_config['view'],compact('menu'));
    }
    public function career()
    {
        $menu="Career";
        return view($this->_config['view'],compact('menu'));
    }
    public function career_save(Request $request)
    {
        $menu="Career";
        $this->validate(request(), [
            'email'       => ['required','unique:careers,email'],
            'phone'       => ['required','unique:careers,phone'],
            'cv'       => ['required']
        ]);
        $cv=$request->file('cv');
        $ext=$cv->getClientOriginalExtension();
        $fileName=$cv->getClientOriginalName();
        $tempName='cv'.time().'.'.$ext;
        Storage::disk('cv')->put($tempName,File::get($cv));
        $data = request()->all();
        $data['cv']=$tempName;
        $career = $this->careerRepository->create($data);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Cv']));

        return redirect()->route('shop.about.career',compact('menu'));
    }
    public function feedback()
    {
        $menu="Feedback";
        return view($this->_config['view'],compact('menu'));
    }
    public function blog()
    {
        $menu="Blog";
        $blogs=$this->blogRepository->orderBy('created_at','desc')->get();
        $recents=$this->blogRepository->orderBy('created_at','desc')->skip(0)->take(5)->get();
        return view($this->_config['view'],compact('blogs','recents','menu'));
    }
    public function blog_id($id)
    {
        $menu="Blog";
        $blogs=$this->blogRepository->where('id',$id)->get();
        $recents=$this->blogRepository->orderBy('created_at','desc')->skip(0)->take(5)->get();
        return view($this->_config['view'],compact('blogs','recents','menu'));
    }
    public function blog_search()
    {
        $menu="Blog";
        $data = request()->all();
        $search=$data['search'];
        $blogs=$this->blogRepository->where('headline','like','%'.$search.'%')->orWhere('description','like','%'.$search.'%')->get();
        $recents=$this->blogRepository->orderBy('created_at','desc')->skip(0)->take(5)->get();
        return view($this->_config['view'],compact('blogs','recents','menu'));
    }
    public function blog_date()
    {
        $menu="Blog";
        $data = request()->all();
        $from=$data['from'];
        $to=$data['to'];
        $to=date('Y-m-d',strtotime($to . '+1 day'));
        $blogs=$this->blogRepository->where('created_at','<=',$to)->where('created_at','<=',$to)->get();
        $recents=$this->blogRepository->orderBy('created_at','desc')->skip(0)->take(5)->get();
        return view($this->_config['view'],compact('blogs','recents','menu'));
    }
    public function return()
    {
        $menu="Return Policy";
        return view($this->_config['view'],compact('menu'));
    }
    public function aggrement()
    {
        $menu="Vendor Aggrement";
        return view($this->_config['view'],compact('menu'));
    }
    public function refund()
    {
        $menu="Refund Policy";
        return view($this->_config['view'],compact('menu'));
    }
    public function cancellation()
    {
        $menu="Cancellation Policy";
        return view($this->_config['view'],compact('menu'));
    }
    public function terms()
    {
        $menu="Terms";
        return view($this->_config['view'],compact('menu'));
    }
    public function payment()
    {
        $menu="Payment Method";
        return view($this->_config['view'],compact('menu'));
    }
    public function shipping()
    {
        $menu="Shipping Method";
        return view($this->_config['view'],compact('menu'));
    }
    public function cancel()
    {
        $menu="Cancellation Method";
        return view($this->_config['view'],compact('menu'));
    }
    public function tracking()
    {
        $menu="Tracking";
        return view($this->_config['view'],compact('menu'));
    }
    public function track()
    {
        $menu="Track";
        return view($this->_config['view'],compact('menu'));
    }
    public function faqs()
    {
        $menu="FAQs";
        return view($this->_config['view'],compact('menu'));
    }
    public function how()
    {
        $menu="How To Shop";
        return view($this->_config['view'],compact('menu'));
    }
    public function sell()
    {
        $menu="How To Shop";
        return view($this->_config['view'],compact('menu'));
    }
    public function affiliated()
    {
        $menu="How To Shop";
        return view($this->_config['view'],compact('menu'));
    }
    public function apply_affiliated(Request $request)
    {
        $menu="Career";
        $this->validate(request(), [
            'email'       => ['required','unique:affiliates,email'],
            'name'       => ['required'],
            'message'       => ['required']
        ]);
        $data = request()->all();
        $affiliates = $this->affiliatesRepository->create($data);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Message']));

        return redirect()->route('shop.earn.affiliated',compact('menu'));
    }
    
    public function notFound()
    {
        abort(404);
    }
}