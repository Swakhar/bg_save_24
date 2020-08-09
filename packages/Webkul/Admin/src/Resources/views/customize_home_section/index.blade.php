@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.cms.customize_home_section.config') }}
@stop

@section('content')
    <customize_section_admin
            :categories="{{ json_encode($categories, true) }}"
            :products="{{ json_encode($products, true) }}"
            :master_data="{{ json_encode($master_data, true) }}"
            :page_title="'Customize Section Configuration'"></customize_section_admin>
@stop

@push('scripts')
<style>
    .category_select_group {
        margin-bottom: 5px;
    }
    button.btn-success {
        background: #190fbb;
        height: 31px;
    }
    div.multi_select_parent_div {
        height: 32px;
        width: 100%;
        border: 1px solid #808080cc;
        padding: 0 5px;
        display: inline-table;
    }
    button.multi_select_btn {
        z-index: 99999;
        border: none;
        background: #7fa6ff;
        /* display: contents; */
        /* position: absolute; */
        padding: 4px 20px 6px 6px;
        position: relative;
        display: inline-block;
        margin-right: 3px;
        margin-bottom: 3px;
        font-size: 11px;
    }
    button.multi_select_btn i {
        color: #e22b2b;
        font-size: 20px;
        position: absolute;
        top: 1px;
        right: 1px;
        cursor: pointer;
    }
    .multi_select_div {
        position: absolute;
        width: 385px;
        padding: 5px 10px;
        border: 1px solid grey;
        height: 200px;
        overflow-y: scroll;
        background: white;
        z-index: 99999999;
    }
    .custom_select2 {
        position: absolute;
        width: 385px;
        padding: 5px 10px;
        border: 1px solid grey;
        height: 200px;
        overflow-y: scroll;
        background: white;
        z-index: 99999999;
    }
    .multi_select_div ul {
        margin-left: -10px;
    }
    .custom_select2 ul {
        margin-left: -10px;
    }
    .multi_select_div ul li {
        /* height: 29px; */
        line-height: 29px;
        padding: 0 10px;
        margin-bottom: 3px;
        cursor: pointer;
        font-size: 13px;
    }
    .custom_select2 ul li {
        /* height: 29px; */
        line-height: 29px;
        padding: 0 10px;
        margin-bottom: 3px;
        cursor: pointer;
        font-size: 13px;
    }
    .multi_select_div ul li:hover {
        background: #3568ff9e;
        color: black;
    }
    .custom_select2 ul li:hover {
        background: #3568ff9e;
        color: black;
    }
    div.custom_control_group {
        width: 100%;
        margin-bottom: 9px;
        height: 30px;
    }
    div.left_custom_control {
        float: left;
        width: 20%;
    }
    div.right_custom_control {
        float: left;
        width: 80%;
        /*position: relative;*/
    }
    .control-group label {
        width: 100%;
    }
    input.custom_control {
        height: 30px;
        padding: 4px 8px;
        width: 100%;
        border: 1px solid #808080d6;
        border-radius: 5px;
    }
    input.custom_control:focus {
        border: 1px solid #74C4F4;
    }
    div.category_select_header {
        position: relative;
        width: 100%;
        height: 32px;
        background: whitesmoke;
        line-height: 32px;
        padding: 0 0 0 10px;
        border-radius: 5px;
    }
    div.category_select_body {
        display: flow-root;
        height: auto;
        border: 1px solid #8080806e;
        padding: 10px 15px;
        border-top: none;
    }
    div.category_select_header i.expand_div {
        position: absolute;
        right: 12px;
        top: 9px;
        cursor: pointer;
        font-size: 20px;
    }
    div.category_select_header i.trash {
        position: absolute;
        right: 54px;
        top: 6px;
        cursor: pointer;
        font-size: 20px;
        color: #e60404;
    }
    button.btn-warning {
        color: white;
        padding: 5px;
        height: 30px;
        width: 40px;
        line-height: 21px;
        background: grey;
    }
    .table {
        border-collapse: collapse;
        width: 100%;
    }
    .table td, .table th {
        border: 1px solid #ddd;
        padding: 8px;
        color: #000 !important;
    }
    .table tr:nth-child(even){background-color: #f2f2f2;}
    .table tr:hover {background-color: #ddd;}
    .table th {
        padding-top: 5px;
        padding-bottom: 5px;
        text-align: left;
        background-color: #F8F9FA;
        color: white;
    }
    .table td {
        padding-top: 5px;
        padding-bottom: 5px;
        text-align: left;
        background-color: #F8F9FA;
        color: white;
    }
</style>
@endpush
@push('scripts')

@endpush

