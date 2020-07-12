<?php

namespace Webkul\Customer\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Customer\Repositories\CustomerGroupRepository;
use Cookie;
use Socialite;

class SessionController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;
    protected $customerRepository;
    protected $customerGroupRepository;

    /**
     * Create a new Repository instance.
     *
     * @return void
    */
    public function __construct(CustomerRepository $customerRepository,
        CustomerGroupRepository $customerGroupRepository)
    {
        $this->middleware('customer')->except(['show','create','redirectToFacebookProvider', 'handleFacebookProviderCallback','redirectToGoogleProvider', 'handleGoogleProviderCallback']);

        $this->_config = request('_config');
        $this->customerRepository = $customerRepository;

        $this->customerGroupRepository = $customerGroupRepository;
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        if (auth()->guard('customer')->check()) {
            return redirect()->route('customer.profile.index');
        } else {
            return view($this->_config['view']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->validate(request(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (! auth()->guard('customer')->attempt(request(['email', 'password']))) {
            session()->flash('error', trans('shop::app.customer.login-form.invalid-creds'));

            return redirect()->back();
        }

        if (auth()->guard('customer')->user()->status == 0) {
            auth()->guard('customer')->logout();

            session()->flash('warning', trans('shop::app.customer.login-form.not-activated'));

            return redirect()->back();
        }

        if (auth()->guard('customer')->user()->is_verified == 0) {
            session()->flash('info', trans('shop::app.customer.login-form.verify-first'));

            Cookie::queue(Cookie::make('enable-resend', 'true', 1));

            Cookie::queue(Cookie::make('email-for-resend', request('email'), 1));

            auth()->guard('customer')->logout();

            return redirect()->back();
        }

        //Event passed to prepare cart after login
        Event::dispatch('customer.after.login', request('email'));

        return redirect()->intended(route($this->_config['redirect']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->guard('customer')->logout();

        Event::dispatch('customer.after.logout', $id);

        return redirect()->route($this->_config['redirect']);
    }

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $customer=$this->customerRepository->where('fb_id',$user->getId())->get();
        $log['email']=$user->getEmail();
        $log['password']=$user->getId();
        if(count($customer)){
            if (! auth()->guard('customer')->attempt($log)) {
            session()->flash('error', trans('shop::app.customer.login-form.invalid-creds'));

            return redirect()->back();
            }
            session()->flash('success', trans('Login Successfull!'));

            return redirect()->route('shop.home.index');
        }else{
            $data['first_name'] = $user->getName();
            $data['last_name'] = "";

            $data['email'] = $user->getEmail();
            $data['password'] = bcrypt($user->getId());
            $data['customer_group_id'] = $this->customerGroupRepository->findOneWhere(['code' => 'general'])->id;
            $data['token'] = $user->token;
            $data['is_verified'] = 1;
            $data['fb_id'] = $user->getId();

            $customer = $this->customerRepository->create($data);
            Event::dispatch('customer.after.login', $user->getId());
            if (! auth()->guard('customer')->attempt($log)) {
                session()->flash('error', trans('shop::app.customer.login-form.invalid-creds'));

                return redirect()->back();
            }
            session()->flash('success', trans('Login Successfull!'));

            return redirect()->route('shop.home.index');
        }
    }
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $customer=$this->customerRepository->where('g_id',$user->getId())->get();
        $log['email']=$user->getEmail();
        $log['password']=$user->getId();
        if(count($customer)){
            if (! auth()->guard('customer')->attempt($log)) {
            session()->flash('error', trans('shop::app.customer.login-form.invalid-creds'));

            return redirect()->back();
            }
            session()->flash('success', trans('Login Successfull!'));

            return redirect()->route('shop.home.index');
        }else{
            $data['first_name'] = $user->getName();
            $data['last_name'] = "";

            $data['email'] = $user->getEmail();
            $data['password'] = bcrypt($user->getId());
            $data['customer_group_id'] = $this->customerGroupRepository->findOneWhere(['code' => 'general'])->id;
            $data['token'] = $user->token;
            $data['is_verified'] = 1;
            $data['g_id'] = $user->getId();

            $customer = $this->customerRepository->create($data);
            Event::dispatch('customer.after.login', $user->getId());
            if (! auth()->guard('customer')->attempt($log)) {
                session()->flash('error', trans('shop::app.customer.login-form.invalid-creds'));

                return redirect()->back();
            }
            session()->flash('success', trans('Login Successfull!'));

            return redirect()->route('shop.home.index');
        };
    }
}