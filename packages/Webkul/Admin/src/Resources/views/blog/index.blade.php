@extends('admin::layouts.content')

@section('page_title')
     {{ __('admin::app.blog.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.blog.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.blog.create') }}" class="btn btn-lg btn-primary">
                     {{ __('admin::app.blog.add-title') }}
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.catalog.tags.list.before') !!}

        <div class="page-content">
            {!! app('Webkul\Admin\DataGrids\BlogDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.tags.list.after') !!}
    </div>
@stop