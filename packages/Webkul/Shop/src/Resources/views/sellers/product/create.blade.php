@extends('shop::customers.account.index')

@section('page_title')
    {{ __('admin::app.catalog.products.add-title') }}
@stop

@section('page-detail-wrapper')
    <div class="account-head mb-10">
      <span class="back-icon">
          <a href="{{ route('customer.account.index') }}">
              <i class="icon icon-menu-back"></i>
          </a>
      </span>

      <span class="account-heading">
          {{ __('admin::app.catalog.products.add-title') }}
      </span>
    </div>

    {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.before') !!}

    <form method="post" action="{{ route('seller.product.create') }}" @submit.prevent="onSubmit">

        <div class="account-table-content">
            @csrf

            <?php $familyId = request()->input('family') ?>

            {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.before') !!}

            <accordian :title="'{{ __('admin::app.catalog.products.general') }}'" :active="true">
                <div slot="body">

                    {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.controls.before') !!}

                    <div class="control-group" :class="[errors.has('type') ? 'has-error' : '']">
                        <label for="type" class="required">{{ __('admin::app.catalog.products.product-type') }}</label>
                        <select class="control" v-validate="'required'" id="type" name="type" {{ $familyId ? 'disabled' : '' }} data-vv-as="&quot;{{ __('admin::app.catalog.products.product-type') }}&quot;">

                            @foreach($productTypes as $key => $productType)
                                <option value="{{ $key }}" {{ request()->input('type') == $productType['key'] ? 'selected' : '' }}>
                                    {{ $productType['name'] }}
                                </option>
                            @endforeach

                        </select>

                        @if ($familyId)
                            <input type="hidden" name="type" value="{{ app('request')->input('type') }}"/>
                        @endif
                        <span class="control-error" v-if="errors.has('type')">@{{ errors.first('type') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('attribute_family_id') ? 'has-error' : '']">
                        <label for="attribute_family_id" class="required">{{ __('admin::app.catalog.products.familiy') }}</label>
                        <select class="control" v-validate="'required'" id="attribute_family_id" name="attribute_family_id" {{ $familyId ? 'disabled' : '' }} data-vv-as="&quot;{{ __('admin::app.catalog.products.familiy') }}&quot;">
                            <option value=""></option>
                            @foreach ($families as $family)
                                <option value="{{ $family->id }}" {{ ($familyId == $family->id || old('attribute_family_id') == $family->id) ? 'selected' : '' }}>{{ $family->name }}</option>
                            @endforeach
                        </select>

                        @if ($familyId)
                            <input type="hidden" name="attribute_family_id" value="{{ $familyId }}"/>
                        @endif
                        <span class="control-error" v-if="errors.has('attribute_family_id')">@{{ errors.first('attribute_family_id') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('sku') ? 'has-error' : '']">
                        <label for="sku" class="required">{{ __('admin::app.catalog.products.sku') }}</label>
                        <input type="text" v-validate="{ required: true, regex: /^[a-z0-9]+(?:-[a-z0-9]+)*$/ }" class="control" id="sku" name="sku" value="{{ request()->input('sku') ?: old('sku') }}" data-vv-as="&quot;{{ __('admin::app.catalog.products.sku') }}&quot;"/>
                        <span class="control-error" v-if="errors.has('sku')">@{{ errors.first('sku') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.controls.after') !!}

                </div>
            </accordian>

            {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.after') !!}

            <div class="button-group">
                <button type="submit" class="theme-btn">{{ __('admin::app.catalog.products.add-product-btn-title') }}</button>
            </div>

        </div>

    </form>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.label .cross-icon').on('click', function(e) {
                $(e.target).parent().remove();
            })

            $('.actions .trash-icon').on('click', function(e) {
                $(e.target).parents('tr').remove();
            })
        });
    </script>
@endpush
