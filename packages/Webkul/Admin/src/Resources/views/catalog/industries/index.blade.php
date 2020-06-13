@extends('admin::layouts.content')

@section('page_title')
    Related Industries 
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Related Industries</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.catalog.industries.create') }}" class="btn btn-lg btn-primary">
                    Add Industry/Instititute
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.catalog.industries.list.before') !!}

        <div class="page-content">
            {!! app('Webkul\Admin\DataGrids\IndustryDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.catalog.industries.list.after') !!}
    </div>
@stop