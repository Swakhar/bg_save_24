<?php

namespace Badenjki\Seller\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Webkul\Customer\Mail\RegistrationEmail;
use Webkul\Customer\Mail\VerificationEmail;
use Webkul\Customer\Repositories\CustomerRepository as Customer;
use Badenjki\Seller\Repositories\StoreRepository as Store;
use Webkul\Customer\Repositories\CustomerRepository;
use Badenjki\Seller\Repositories\StoreCategoryRepository as Category;
use Cookie;


/**
 * Seller Registration controller
 *
 * @author   Khaled Badenjki <m.k.badenjki@gmail.com>
 * @copyright 2019 Doukank (http://www.doukank.com)
 */
class RegistrationController extends Controller
{

    protected $_config;
    protected $category;
    protected $customerRepository;
    protected $store;

    public function __construct(Customer $customer,CustomerRepository $customerRepository,Store $store, Category $category)
    {

        $this->customer = $customer;

        $this->category = $category;
        $this->customerRepository = $customerRepository;
        $this->_config = request('_config');

        $this->store = $store;

    }
    public function show()
    {
        $categories = $this->category->all();
        $this->_config = request('_config');

        return view($this->_config['view'],compact('categories'));
    }
    public function create()
    {
        $this->validate(request(), [
            'first_name' => 'string|required',
            'last_name'  => 'string|required',
            'email'      => 'email|required|unique:customers,email',
            'name'  => 'string|required',
            'phone'  => 'required',
            'state_id'  => 'required',
            'city'  => 'string|required',
            'zip'  => 'required',
            'street_add'  => 'string|required',
            'state'  => 'string|required',
            'password'   => 'min:6|required',
        ]);
        $data = request()->input();

        $customer_data['first_name'] = $data['first_name'];
        $customer_data['last_name'] = $data['last_name'];
        $customer_data['email'] = $data['email'];
        $customer_data['phone'] = $data['phone'];
        $customer_data['password'] = bcrypt($data['password']);
        $customer_data['api_token'] = Str::random(80);
        if (core()->getConfigData('customer.settings.email.verification')) {
            $customer_data['is_verified'] = 0;
        } else {
            $customer_data['is_verified'] = 1;
        }
        $verificationData['email'] = $data['email'];
        $verificationData['token'] = md5(uniqid(rand(), true));
        $customer_data['token'] = $verificationData['token'];
        $store = $this->store->create($data);
        if($store){
            $customer_data['store_id']=$store->id;
        }
        $customer = $this->customerRepository->create($customer_data);
        if ($customer) {
            if (core()->getConfigData('customer.settings.email.verification')) {
                try {
                    $configKey = 'emails.general.notifications.emails.general.notifications.verification';
                    if (core()->getConfigData($configKey)) {
                        Mail::queue(new VerificationEmail($verificationData));
                    }

                    session()->flash('success', trans('shop::app.customer.signup-form.success-verify'));
                } catch (\Exception $e) {
                    report($e);
                    session()->flash('info', trans('shop::app.customer.signup-form.success-verify-email-unsent'));
                }
            } else {
                try {
                    $configKey = 'emails.general.notifications.emails.general.notifications.registration';
                    if (core()->getConfigData($configKey)) {
                        Mail::queue(new RegistrationEmail(request()->all()));
                    }

                    session()->flash('success', trans('shop::app.customer.signup-form.success-verify')); //customer registered successfully
                } catch (\Exception $e) {
                    report($e);
                    session()->flash('info', trans('shop::app.customer.signup-form.success-verify-email-unsent'));
                }

                session()->flash('success', trans('shop::app.customer.signup-form.success'));
            }

            return redirect()->route($this->_config['redirect']);
        } else {
            session()->flash('error', trans('shop::app.customer.signup-form.failed'));

            return redirect()->back();
        }
    }

}
