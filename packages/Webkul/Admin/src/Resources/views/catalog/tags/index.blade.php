@extends('admin::layouts.content')

@section('page_title')
     {{ __('admin::app.catalog.tags.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.catalog.tags.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.catalog.tags.create') }}" class="btn btn-lg btn-primary">
                     {{ __('admin::app.catalog.tags.add-title') }}
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.catalog.tags.list.before') !!}

        <div class="page-content">
            {!! app('Webkul\Admin\DataGrids\TagDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.tags.list.after') !!}
    </div>
@stop