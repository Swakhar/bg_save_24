@extends('admin::layouts.content')

@section('page_title')
     {{ __('admin::app.catalog.manufacturers.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.catalog.manufacturers.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.catalog.manufacturers.create') }}" class="btn btn-lg btn-primary">
                     {{ __('admin::app.catalog.manufacturers.add-title') }}
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.catalog.manufacturers.list.before') !!}

        <div class="page-content">
            {!! app('Webkul\Admin\DataGrids\ManufacturerDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.manufacturers.list.after') !!}
    </div>
@stop