@extends('shop::layouts.master')

@section('page_title')
    {{ __('admin::app.catalog.products.title') }}
@endsection

@section('content-wrapper')

    <div class="account-content">
        @include('shop::customers.account.partials.sidemenu')

        <div class="account-layout">

            <div class="account-head mb-10">
                <span class="back-icon"><a href="{{ route('customer.account.index') }}"><i class="icon icon-menu-back"></i></a></span>
                <span class="account-heading">
                    {{ __('admin::app.catalog.products.title') }}
                </span>

                <div class="horizontal-rule"></div>
            </div>

            {!! view_render_event('bagisto.admin.catalog.products.list.before') !!}

            <div class="account-items-list">
                <div class="account-table-content">
                    @inject('products', 'Badenjki\Seller\DataGrids\ProductDataGrid')
                    {!! $products->render() !!}
                </div>
            </div>

            {!! view_render_event('bagisto.admin.catalog.products.list.after') !!}
        </div>
    </div>
@endsection
