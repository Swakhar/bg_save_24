@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.manufacturers.edit-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.catalog.manufacturers.update', [$configurableoption->id]) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1)
                                : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.catalog.attribute_options.edit-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.catalog.attribute_options.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input name="_method" type="hidden" value="PUT">

                    {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.general.before',
                    ['configurableoption' => $configurableoption]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.general') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.general.controls.before', ['configurableoption' => $configurableoption]) !!}

                            <div class="control-group" :class="[errors.has('admin_name') ? 'has-error' : '']">
                                <label for="admin_name" class="required">{{ __('admin::app.catalog.tags.admin_name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="admin_name" name="admin_name" value="{{ old('admin_name') ?: $configurableoption->admin_name }}" data-vv-as="&quot;{{ __('admin::app.catalog.tags.admin_name') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('admin_name')">@{{ errors.first('admin_name') }}</span>
                            </div>
                            

                            {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.general.controls.after', ['configurableoption' => $configurableoption]) !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.general.after', ['configurableoption' => $configurableoption]) !!}

                    {!! view_render_event('bagisto.admin.catalog.tag.edit_form_accordian.tags.before', ['configurableoption' => $configurableoption]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.attributes.label') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.tags.edit_form_accordian.tags.controls.before', ['configurableoption' => $configurableoption]) !!}

                            

                            @foreach (app('Webkul\Core\Repositories\LocaleRepository')->all() as $locale)

                                <div class="control-group">
                                    <label for="locale-{{ $locale->code }}">{{ $locale->name . ' (' . $locale->code . ')' }}</label>
                                    <input type="text" class="control" id="locale-{{ $locale->code }}" name="<?php echo $locale->code; ?>[name]" value="{{ old($locale->code)['name'] ?? ($configurableoption->translate($locale->code)->name ?? '') }}"/>
                                </div>

                            @endforeach

                            {!! view_render_event('bagisto.admin.catalog.tags.edit_form_accordian.tags.controls.after', ['configurableoption' => $configurableoption]) !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.tags.edit_form_accordian.tags.after', ['configurableoption' => $configurableoption]) !!}

                    {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.description_images.before', ['configurableoption' => $configurableoption]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.description-and-images') }}'" :active="true">
                        <div slot="body">
                            
                            <description></description>

                            <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                                <label>{{ __('admin::app.catalog.manufacturers.image') }}</label>

                                <image-wrapper :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'" input-name="image" :multiple="false"
                                               :images='"{{ '/cache/small/' . $configurableoption->image }}"'
                                               ></image-wrapper>

                                <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                    @foreach ($errors->get('image.*') as $key => $message)
                                        @php echo str_replace($key, 'Image', $message[0]); @endphp
                                    @endforeach
                                </span>

                            </div>
                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.description_images.after',
                    ['configurableoption' => $configurableoption]) !!}


                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.display') }}'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('published') ? 'has-error' : '']">
                                <label for="published" class="">{{ __('admin::app.catalog.manufacturers.published') }}</label>
                                <select class="control"  id="published" name="published"
                                        data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.visible-in-menu') }}&quot;">
                                    <option value="1" {{ $configurableoption->published ? 'selected' : '' }}>
                                        {{ __('admin::app.catalog.manufacturers.yes') }}
                                    </option>
                                    <option value="0" {{ $configurableoption->published ? '' : 'selected' }}>
                                        {{ __('admin::app.catalog.manufacturers.no') }}
                                    </option>
                                </select>
                                <span class="control-error" v-if="errors.has('published')">@{{ errors.first('published') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('dis_order') ? 'has-error' : '']">
                                <label for="dis_order"
                                       class="">{{ __('admin::app.catalog.manufacturers.display-order') }}</label>
                                <input type="text" v-validate="'numeric'" class="control" id="dis_order"
                                       name="dis_order" value="{{ old('dis_order') ?: $configurableoption->dis_order }}"
                                       data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.dis_order') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('dis_order')">@{{ errors.first('dis_order') }}</span>
                            </div>
                        </div>
                    </accordian>
                    
                    {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.seo.before',
                    ['configurableoption' => $configurableoption]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.mapping') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('discounts') ? 'has-error' : '']">
                                <label for="discounts" class="">{{ __('admin::app.catalog.manufacturers.discounts') }}</label>
                                <input type="text" v-validate="'numeric'" class="control" id="discounts"
                                       name="discounts" value="{{ old('discounts') ?: $configurableoption->discounts }}"
                                       data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.discounts') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('discounts')">@{{ errors.first('discounts') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.catalog.manufacturers.rgb_code') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.controls.before') !!}

                            <div class="control-group" :class="[errors.has('discounts') ? 'has-error' : '']">
                                <label for="discounts">{{ __('admin::app.catalog.manufacturers.rgb_code') }}</label>
                                <input type="text"
                                       class="control" id="rgb_code" name="rgb_code"
                                       value="{{ old('rgb_code') ?: $configurableoption->rgb_code }}"
                                       data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.rgb_code') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('rgb_code')">@{{ errors.first('rgb_code') }}</span>
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.seo.controls.after') !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.category.edit_form_accordian.seo.after',
                    ['configurableoption' => $configurableoption]) !!}

                </div>
            </div>

        </form>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script type="text/x-template" id="description-template">

        <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
            <label for="description"
                  >{{ __('admin::app.catalog.manufacturers.description') }}</label>
            <textarea   class="control"
                      id="description" name="description"
                      data-vv-as="&quot;{{ __('admin::app.catalog.manufacturers.description') }}&quot;">{{ old('description') ?? ($configurableoption->description?? '') }}</textarea>
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

                    if ($('#display_mode').val() != 'products_only') {
                        this_this.isRequired = true;
                    } else {
                        this_this.isRequired = false;
                    }
                });
            }
        })
    </script>
@endpush