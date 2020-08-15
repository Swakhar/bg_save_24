@extends('shop::customers.account.index')

@section('page_title')
    {{ __('admin::app.catalog.products.title') }}
@endsection

@section('page-detail-wrapper')
    <div class="account-head mb-10">
        <span class="back-icon">
            <a href="{{ route('customer.account.index') }}">
                <i class="icon icon-menu-back"></i>
            </a>
        </span>

        <span class="account-heading">
            {{ __('admin::app.catalog.products.title') }}
        </span>
    </div>

    {!! view_render_event('bagisto.shop.customers.account.orders.list.before') !!}

        <div class="account-items-list">
            <div class="account-table-content">

                {!! app('Badenjki\Seller\DataGrids\ProductDataGrid')->render() !!}

            </div>
        </div>

    {!! view_render_event('bagisto.admin.catalog.products.list.after') !!}
@endsection
