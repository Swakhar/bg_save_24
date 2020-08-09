@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.blog.edit-title') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.blog.edit-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.blog.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input name="_method" type="hidden" value="PUT">

                    {!! view_render_event('bagisto.admin.catalog.tags.edit_form_accordian.general.before', ['blog' => $blog]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.tags.general') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.tags.edit_form_accordian.general.controls.before', ['blog' => $blog]) !!}

                            <div class="control-group" :class="[errors.has('headline') ? 'has-error' : '']">
                                <label for="headline" class="required">{{ __('admin::app.blog.headline') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="headline" name="headline" value="{{ old('headline') ?: $blog->headline }}" data-vv-as="&quot;{{ __('admin::app.blog.headline') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('headline')">@{{ errors.first('headline') }}</span>
                            </div>
                            <description></description>
                            <div class="control-group" :class="[errors.has('video') ? 'has-error' : '']">
                                <label for="video">{{ __('admin::app.blog.video') }}</label>
                                <input type="text" blogclass="control" id="video" name="video" value="{{ old('video') ?: $blog->video }}" data-vv-as="&quot;{{ __('admin::app.blog.video') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('video')">@{{ errors.first('video') }}</span>
                            </div><div class="control-group" :class="[errors.has('image') ? 'has-error' : '']">
                                <label for="image">{{ __('admin::app.blog.image') }}</label>
                                <input type="file" class="form-control-file border" id="image" name="image" value="{{ old('image') ?: $blog->image }}" data-vv-as="&quot;{{ __('admin::app.blog.image') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('image')">@{{ errors.first('image') }}</span>
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.tags.edit_form_accordian.general.controls.after', ['blog' => $blog]) !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.tags.edit_form_accordian.general.after', ['blog' => $blog]) !!}
                    
                </div>
            </div>

        </form>
    </div>
@stop
@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script type="text/x-template" id="description-template">

        <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
            <label for="description" :class="isRequired ? 'required' : ''">{{ __('admin::app.catalog.categories.description') }}</label>
            <textarea v-validate="isRequired ? 'required' : ''"  class="control" id="description" name="description" data-vv-as="&quot;{{ __('admin::app.catalog.categories.description') }}&quot;">{{ old('description') ?? $blog->description}}</textarea>
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
