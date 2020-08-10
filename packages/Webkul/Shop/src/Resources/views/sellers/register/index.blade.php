@extends('shop::layouts.vendor_reg_master')

@section('page_title')
    {{ __('velocity::app.vendor.signup-form.page-title') }}
@endsection

@section('content-wrapper')
    <div class="col-md-12">
        <h1>{{ __('velocity::app.vendor.signup-form.create-new')}}</h1>
        <hr style="background: #ff1800;height: 2px;width: 60px;">
        <br>
    </div>
    <div class="col-md-12">
        <div class="content">
  <!--content inner-->
  <div class="content__inner">
    <div class="container">
      <!--multisteps-form-->
      <div class="multisteps-form">
        <!--progress bar-->
        <div class="row">
          <div class="col-12 ml-auto mr-auto mb-4">
            <div class="multisteps-form__progress" style="font-size: 20px;">
              <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Personal Information</button>
              <button class="multisteps-form__progress-btn" type="button" title="Address">General</button>
              <button class="multisteps-form__progress-btn" type="button" title="Order Info">Login Information</button>
            </div>
          </div>
        </div>
        <!--form panels-->
        <div class="row">
          <div class="col-12 m-auto">
            <form class="multisteps-form__form" action="{{route('store.register.save')}}" method="post">
              @csrf
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Personal Information</h3>
                <div class="multisteps-form__content">
                  <div class="col-md-12">
                      <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                            <label for="first_name" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.firstname') }}
                            </label>

                            <input
                                type="text"
                                id="first_name"
                                onblur="validate1()"
                                class="form-style"
                                name="first_name"
                                v-validate="'required'"
                                value="{{ old('first_name') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.firstname') }}&quot;" />

                            <span class="control-error" v-if="errors.has('first_name')">
                                @{{ errors.first('first_name') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-12">
                      <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                            <label for="last_name" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.lastname') }}
                            </label>

                            <input
                                type="text"
                                id="last_name"
                                onblur="validate1()"
                                class="form-style"
                                name="last_name"
                                v-validate="'required'"
                                value="{{ old('last_name') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.lastname') }}&quot;" />

                            <span class="control-error" v-if="errors.has('last_name')">
                                @{{ errors.first('last_name') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-12 d-flex mt-4">
                    <button class="btn btn-lg btn-primary ml-auto js-btn-next" type="button" title="Next" disabled="true" id="btn1">Next</button>
                  </div>
                </div>
              </div>
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">General</h3>
                <div class="multisteps-form__content">
                  <div class="col-md-6">
                      <div class="control-group" :class="[errors.has('category_id') ? 'has-error' : '']">
                            <label for="category_id" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.select-category') }}
                            </label>

                            <select class="form-style" id="category_id" name="category_id" onblur="validate2()">
                                <option value="">{{ __('shop::app.customer.account.store.create.select-category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->translate($locale)['name']}}</option>
                                @endforeach
                            </select>
                            <span class="control-error" v-if="errors.has('category_id')">
                                @{{ errors.first('category_id') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                            <label for="name" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.store-title') }}
                            </label>

                            <input
                                type="text"
                                id="name"
                                onblur="validate2()"
                                class="form-style"
                                name="name"
                                v-validate="'required'"
                                value="{{ old('name') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.store-title') }}&quot;" />

                            <span class="control-error" v-if="errors.has('name')">
                                @{{ errors.first('name') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="control-group" :class="[errors.has('state_id') ? 'has-error' : '']">
                    <label for="state_id" class="mandatory label-style">
                        {{ __('velocity::app.vendor.signup-form.country') }}
                    </label>
                    <select class="form-style" id="state_id" name="state_id" onblur="validate2()">
                        <option value="">{{ __('velocity::app.vendor.signup-form.select-country') }}</option>
                        @foreach(core()->states("IN") as $state)
                            <option value="{{$state->id}}" {{isset($store) && $store->state_id == $state->id ? 'selected' : ''}}>{{$state->translate('ar')['default_name']}}</option>
                        @endforeach
                    </select>
                    <span class="control-error" v-if="errors.has('state_id')">
                        @{{ errors.first('state_id') }}
                    </span>
                </div>
                  </div>
                  <div class="col-md-6">
                      <div class="control-group" :class="[errors.has('street_add') ? 'has-error' : '']">
                            <label for="street_add" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.street_add') }}
                            </label>

                            <input
                                type="text"
                                id="street_add"
                                onblur="validate2()"
                                class="form-style"
                                name="street_add"
                                v-validate="'required'"
                                value="{{ old('street_add') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.street_add') }}&quot;" />

                            <span class="control-error" v-if="errors.has('street_add')">
                                @{{ errors.first('street_add') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="control-group" :class="[errors.has('city') ? 'has-error' : '']">
                            <label for="city" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.city') }}
                            </label>

                            <input
                                type="text"
                                id="city"
                                onblur="validate2()"
                                class="form-style"
                                name="city"
                                v-validate="'required'"
                                value="{{ old('city') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.city') }}&quot;" />

                            <span class="control-error" v-if="errors.has('city')">
                                @{{ errors.first('city') }}
                            </span>
                        </div>
                  </div>
                  
                  <div class="col-md-6">
                      <div class="control-group" :class="[errors.has('state') ? 'has-error' : '']">
                            <label for="state" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.state') }}
                            </label>

                            <input
                                type="text"
                                id="state"
                                onblur="validate2()"
                                class="form-style"
                                name="state"
                                v-validate="'required'"
                                value="{{ old('state') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.state') }}&quot;" />

                            <span class="control-error" v-if="errors.has('state')">
                                @{{ errors.first('state') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="control-group" :class="[errors.has('zip') ? 'has-error' : '']">
                            <label for="zip" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.zip') }}
                            </label>

                            <input
                                type="number"
                                id="zip"
                                onblur="validate2()"
                                class="form-style"
                                name="zip"
                                v-validate="'required'"
                                value="{{ old('zip') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.zip') }}&quot;" />

                            <span class="control-error" v-if="errors.has('zip')">
                                @{{ errors.first('zip') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-6">
                      <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                            <label for="phone" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.phone') }}
                            </label>

                            <input
                                type="text"
                                id="phone"
                                onblur="validate2()"
                                class="form-style"
                                name="phone"
                                v-validate="'required'"
                                value="{{ old('phone') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.phone') }}&quot;" />

                            <span class="control-error" v-if="errors.has('phone')">
                                @{{ errors.first('phone') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-12 d-flex mt-4">
                    <button class="btn btn-lg btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                    <button class="btn btn-lg btn-primary ml-auto js-btn-next" type="button" title="Next" id="btn2" disabled="true">Next</button>
                  </div>
                </div>
              </div>
              <!--single form panel-->
              <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                <h3 class="multisteps-form__title">Login Information</h3>
                <div class="multisteps-form__content">
                  <div class="col-md-12">
                      <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <label for="email" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.email') }}
                            </label>

                            <input
                                type="email"
                                id="email"
                                onblur="validate3()"
                                class="form-style"
                                name="email"
                                v-validate="'required|email'"
                                value="{{ old('email') }}"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.email') }}&quot;" />

                            <span class="control-error" v-if="errors.has('email')">
                                @{{ errors.first('email') }}
                            </span>
                        </div>
                  </div>
                  <div class="col-md-12">
                      <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <label for="password" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.password') }}
                            </label>

                            <input
                                type="password"
                                id="password"
                                onblur="validate3()"
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
                  </div>
                  <div class="col-md-12">
                      <div class="control-group" :class="[errors.has('confirm_password') ? 'has-error' : '']">
                            <label for="confirm_password" class="mandatory label-style">
                                {{ __('velocity::app.vendor.signup-form.confirm_password') }}
                            </label>

                            <input
                                type="password"
                                id="confirm_password"
                                onblur="validate3()"
                                class="form-style"
                                name="confirm_password"
                                v-validate="'required|min:6|confirmed:password'"
                                data-vv-as="&quot;{{ __('velocity::app.vendor.signup-form.confirm_password') }}&quot;" />

                            <span class="control-error" v-if="errors.has('confirm_password')">
                                @{{ errors.first('confirm_password') }}
                            </span>
                        </div>
                  </div>
                    <div class="col-md-12 d-flex mt-4 col-12">
                      <button class="btn btn-lg btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                      <button class="btn btn-lg btn-success ml-auto" type="submit" title="Send" id="btn3" disabled="true">Send</button>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
@endsection
<script type="text/javascript">
    function validate1() {
        v1 = document.getElementById("first_name").value;
        v2 = document.getElementById("last_name").value;
        if(v1!=""&&v2!=""){
            document.getElementById("btn1").disabled=false;
        }else{
            document.getElementById("btn1").disabled=true;
        }
    }
    function validate2() {
        v1 = document.getElementById("category_id").value;
        v2 = document.getElementById("name").value;
        v3 = document.getElementById("state_id").value;
        v4 = document.getElementById("street_add").value;
        v5 = document.getElementById("city").value;
        v6 = document.getElementById("zip").value;
        v7 = document.getElementById("state").value;
        v8 = document.getElementById("phone").value;
        if(v1!=""&&v2!=""&&v3!=""&&v4!=""&&v5!=""&&v6!=""&&v7!=""&&v8!=""){
            document.getElementById("btn2").disabled=false;
        }else{
            document.getElementById("btn2").disabled=true;
        }
    }
    function validate3() {
        v1 = document.getElementById("email").value;
        v2 = document.getElementById("password").value;
        v3 = document.getElementById("confirm_password").value;
        if(v1!=""&&v2!=""&&v3!=""){
            document.getElementById("btn3").disabled=false;
        }else{
            document.getElementById("btn3").disabled=true;
        }
    }
</script>