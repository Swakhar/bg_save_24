@extends('shop::layouts.login_master')

@section('page_title')
    {{ __('shop::app.customer.signup-form.page-title') }}
@endsection

@section('content-wrapper')
    <div class="col-md-12">
        <h1>{{ __('velocity::app.customer.signup-form.create-new')}}</h1>
        <hr style="background: #ff1800;height: 2px;width: 60px;">
        <br>
    </div>
    {!! view_render_event('bagisto.shop.customers.signup.before') !!}

        <form class="col-md-12" method="post" action="{{ route('customer.register.create') }}" @submit.prevent="onSubmit">

        {{ csrf_field() }}

        {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}
            <div class="col-md-6">

                {!! view_render_event('bagisto.shop.customers.login.before') !!}
                        <div class="card" style="padding-bottom: 200px">
                            <div class="card-body">
                                <h2>{{ __('velocity::app.customer.login-form.registered-user')}}</h2>
                                <hr style="background: #c75e53;height: 2px;width: 60px;">
                                {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                        <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                            <label for="first_name" class="required label-style">
                                {{ __('shop::app.customer.signup-form.firstname') }}
                            </label>

                            <input
                                type="text"
                                class="form-style"
                                name="first_name"
                                v-validate="'required'"
                                value="{{ old('first_name') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;" />

                            <span class="control-error" v-if="errors.has('first_name')">
                                @{{ errors.first('first_name') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.firstname.after') !!}

                        <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                            <label for="last_name" class="required label-style">
                                {{ __('shop::app.customer.signup-form.lastname') }}
                            </label>

                            <input
                                type="text"
                                class="form-style"
                                name="last_name"
                                v-validate="'required'"
                                value="{{ old('last_name') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;" />

                            <span class="control-error" v-if="errors.has('last_name')">
                                @{{ errors.first('last_name') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.lastname.after') !!}

                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                    <div class="card" style="height: 400px;">
                        <div class="card-body">
                            <h2>{{ __('velocity::app.customer.signup-form.new-user')}}</h2>
                            <hr style="background: #c75e53;height: 2px;width: 60px;">
                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <label for="email" class="required label-style">
                                {{ __('shop::app.customer.signup-form.email') }}
                            </label>

                            <input
                                type="email"
                                class="form-style"
                                name="email"
                                v-validate="'required|email'"
                                value="{{ old('email') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;" />

                            <span class="control-error" v-if="errors.has('email')">
                                @{{ errors.first('email') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.email.after') !!}

                        <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <label for="password" class="required label-style">
                                {{ __('shop::app.customer.signup-form.password') }}
                            </label>

                            <input
                                type="password"
                                class="form-style"
                                name="password"
                                v-validate="'required|min:6'"
                                ref="password"
                                value="{{ old('password') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;" />

                            <span class="control-error" v-if="errors.has('password')">
                                @{{ errors.first('password') }}
                            </span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.password.after') !!}

                        <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                            <label for="password_confirmation" class="required label-style">
                                {{ __('shop::app.customer.signup-form.confirm_pass') }}
                            </label>

                            <input
                                type="password"
                                class="form-style"
                                name="password_confirmation"
                                v-validate="'required|min:6|confirmed:password'"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.confirm_pass') }}&quot;" />

                            <span class="control-error" v-if="errors.has('password_confirmation')">
                                @{{ errors.first('password_confirmation') }}
                            </span>
                        </div> 
                        <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                            <label for="phone" class="required label-style">
                                {{ __('shop::app.customer.signup-form.phone') }}
                            </label>

                            <input
                                type="text"
                                class="form-style"
                                name="phone"
                                v-validate="'required'"
                                value="{{ old('phone') }}"
                                data-vv-as="&quot;{{ __('shop::app.customer.signup-form.phone') }}&quot;" />

                            <span class="control-error" v-if="errors.has('phone')">
                                @{{ errors.first('phone') }}
                            </span>
                        </div>
                    </div>
                </div>
                {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}
            </div>
            <div class="col-md-12" style="margin-top: 10px">
                
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                        <button class="btn btn-lg btn-info" type="submit">
                            CREATE AN ACCOUNT
                        </button></div>
                        <div class="col-md-5"></div>
                        <div class="col-md-1" >
                            <a href="{{ route('customer.session.index') }}" style="color: black; font-size: 15px;">Back</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>

    {!! view_render_event('bagisto.shop.customers.signup.after') !!}
@endsection
