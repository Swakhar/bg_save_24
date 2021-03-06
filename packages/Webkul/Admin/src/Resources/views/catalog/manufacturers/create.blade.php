@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.attribute_options.add-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.catalog.manufacturers.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.catalog.attribute_options.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.catalog.manufacturers.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.before') !!}

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.general') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.controls.before') !!}

                            <div class="control-group" :class="[errors.has('admin_name') ? 'has-error' : '']">
                                <label for="admin_name" class="required">{{ __('admin::app.catalog.manufacturers.admin_name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="admin_name" name="admin_name" value="{{ old('admin_name') }}" data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.admin_name') }}&quot;" v-slugify-target="'slug'"/>
                                <span class="control-error" v-if="errors.has('admin_name')">@{{ errors.first('admin_name') }}</span>
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.controls.after') !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.after') !!}
                    {!! view_render_event('bagisto.admin.catalog.attribute.create_form_accordian.label.before') !!}

                    <accordian :title="'{{ __('admin::app.catalog.attributes.label') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.attribute.create_form_accordian.label.controls.before') !!} 

                            @foreach (app('Webkul\Core\Repositories\LocaleRepository')->all() as $locale)

                                <div class="control-group">
                                    <label for="locale-{{ $locale->code }}">{{ $locale->name . ' (' . $locale->code . ')' }}</label>
                                    <input type="text" class="control" id="locale-{{ $locale->code }}" name="<?php echo $locale->code; ?>[name]" value="{{ old($locale->code)['name'] ?? '' }}"/>
                                </div>

                            @endforeach

                            {!! view_render_event('bagisto.admin.catalog.attribute.create_form_accordian.label.controls.after') !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.attribute.create_form_accordian.label.after') !!}

                    {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.description_images.before') !!}

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.description-and-images') }}'" :active="true">
                        <div slot="body">

                            <description></description>

                            <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                                <label >{{ __('admin::app.catalog.manufacturers.image') }} </label>

                                <image-wrapper :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'"
                                               input-name="image" :multiple="false" ></image-wrapper>

                                <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                    @foreach ($errors->get('image.*') as $key => $message)
                                        @php echo str_replace($key, 'Image', $message[0]); @endphp
                                    @endforeach
                                </span>

                            </div>

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.description_images.after') !!}

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.display') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('published') ? 'has-error' : '']">
                                <label for="published">{{ __('admin::app.catalog.manufacturers.published') }}</label>
                                <select class="control"  id="published"
                                        name="published"
                                        data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.visible-in-menu') }}&quot;">
                                    <option value="1">
                                        {{ __('admin::app.catalog.manufacturers.yes') }}
                                    </option>
                                    <option value="0">
                                        {{ __('admin::app.catalog.manufacturers.no') }}
                                    </option>
                                </select>
                                <span class="control-error" v-if="errors.has('published')">@{{ errors.first('published') }}</span>
                            </div>
                            <div class="control-group" :class="[errors.has('dis_order') ? 'has-error' : '']">
                                <label for="dis_order" >{{ __('admin::app.catalog.manufacturers.display-order') }}</label>
                                <input type="number" v-validate="'numeric'"
                                       class="control" id="dis_order" name="dis_order" value="{{ old('dis_order') }}" data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.display-order') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('dis_order')">@{{ errors.first('dis_order') }}</span>
                            </div>
                        </div>
                    </accordian>


                    {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.before') !!}

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.mapping') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.controls.before') !!}

                            <div class="control-group" :class="[errors.has('discounts') ? 'has-error' : '']">
                                <label for="discounts">{{ __('admin::app.catalog.manufacturers.discounts') }}</label>
                                <input type="number" min="0" max="100" step="0.01" v-validate="'decimal'" class="control" id="discounts" name="discounts" value="{{ old('discounts') }}" data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.discounts') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('discounts')">@{{ errors.first('discounts') }}</span>
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.controls.after') !!}

                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.rgb_code') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.controls.before') !!}

                            <div class="control-group" :class="[errors.has('discounts') ? 'has-error' : '']">
                                <label for="discounts">{{ __('admin::app.catalog.manufacturers.rgb_code') }}</label>
                                <input type="text"
                                       class="control" id="rgb_code" name="rgb_code" value="{{ old('rgb_code') }}"
                                       data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.rgb_code') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('rgb_code')">@{{ errors.first('rgb_code') }}</span>
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.controls.after') !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.after') !!}

                </div>
            </div>

        </form>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script type="text/x-template" id="description-template">

        <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
            <label for="description" >{{ __('admin::app.catalog.manufacturers.description') }}</label>
            <textarea
                      class="control" id="description" name="description"
                      data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.description') }}&quot;">{{ old('description') }}</textarea>
            <span class="control-error" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
        </div>

    </script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#description',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true
            });
        });

        Vue.component('description', {

            template: '#description-template',

            inject: ['$validator'],

            data: function() {
                return {
                    isRequired: true,
                }
            },

            created: function () {
                var this_this = this;

                $(document).ready(function () {
                    $('#display_mode').on('change', function (e) {
                        if ($('#display_mode').val() != 'products_only') {
                            this_this.isRequired = true;
                        } else {
                            this_this.isRequired = false;
                        }
                    })
                });
            }
        })
    </script>
@endpush