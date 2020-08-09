@extends('shop::layouts.login_master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')
    <div class="col-md-12">
        <h1>{{ __('velocity::app.customer.login-form.customer-login')}}</h1>
        <hr style="background: #ff1800;height: 2px;width: 60px;">
        <br>
    </div>
    
    <div class="col-md-6">

        {!! view_render_event('bagisto.shop.customers.login.before') !!}
            <div class="card">
                <div class="card-body">
                    <h2>{{ __('velocity::app.customer.login-form.registered-user')}}</h2>
                    <hr style="background: #c75e53;height: 2px;width: 60px;">
                    <p style="font-size: 15px;">{{ __('velocity::app.customer.login-form.form-login-text')}}</p>
                    <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">

                    {{ csrf_field() }}

                    {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                        <div class="form-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <label for="email" class="mandatory label-style">{{ __('shop::app.customer.login-form.email') }}</label>

                            <input
                                type="text" class="form-style"
                                name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;" />

                                <span class="control-error" v-if="errors.has('email')">
                                     @{{ errors.first('email') }}
                                </span>
                        </div>

                            <div class="form-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password" class="mandatory label-style">
                                    {{ __('shop::app.customer.login-form.password') }}
                                </label>

                                <input
                                    type="password"
                                    class="form-style"
                                    name="password"
                                    v-validate="'required'"
                                    value="{{ old('password') }}"
                                    data-vv-as="&quot;{{ __('shop::app.customer.login-form.password') }}&quot;" />

                                <span class="control-error" v-if="errors.has('password')">
                                    @{{ errors.first('password') }}
                                </span>

                                <a href="{{ route('customer.forgot-password.create') }}" class="pull-right" style="font-size: 15px;">
                                    {{ __('shop::app.customer.login-form.forgot_pass') }}
                                </a>

                                <div class="mt10">
                                    @if (Cookie::has('enable-resend'))
                                        @if (Cookie::get('enable-resend') == true)
                                            <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                            <input class="btn btn-lg btn-info" type="submit" value="{{ __('shop::app.customer.login-form.button_title') }}">
                            <br>
                            <hr>
                            
                            <div class="row" style="padding: 15px;">
                                <div class="col-12">
                                    <center><p style="font-size: 15px;">Alternative Login</p></center>
                                </div>
                                
                                <div class="col-md-4 btn btn-lg btn-info" style="
                                font-size: 15px;">
                                    <i class="fa fa-facebook-square" style="color:#3b5998"></i>
                                    <a href="{{ route('redirectFacebook') }}" style="color: white;">Facebbok</a>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4 btn btn-lg btn-info" style="
                                font-size: 15px;">
                                    <i class="fa fa-google-plus" style="color: #db4a39"></i>
                                    <a href="{{ route('redirectGoogle') }}" style="color: white;">Google +</a></div>
                            </div>
                            
                        </form>  
                </div>
            </div>
    </div>
    <div class="col-md-6">

        {!! view_render_event('bagisto.shop.customers.login.before') !!}
            <div class="card" style="height: 400px;">
                <div class="card-body">
                    <h2>{{ __('velocity::app.customer.signup-form.new-user')}}</h2>
                    <hr style="background: #c75e53;height: 2px;width: 60px;">
                    <p style="font-size: 15px;">{{ __('velocity::app.customer.signup-form.form-signup-text')}}</p>
                    <a href="{{ route('customer.register.index') }}" class="btn-new-customer">
                        <button type="button" class="btn btn-lg btn-info">
                            {{ __('velocity::app.customer.login-form.sign-up')}}
                        </button>
                    </a> 
                </div>
            </div>
    </div>
@endsection
