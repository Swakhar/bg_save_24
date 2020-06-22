@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.cms.recommended_slider.config') }}
@stop

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.cms.recommended_slider.config') }}</h1>
            </div>
            <div class="page-action">
                <button class="btn btn-warning"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <div class="page-content">
            <div class="control-group">
                <div class="category_select_group">
                    <div class="category_select_header">
                        <span>Slider Content Info</span>
                        <i class="expand_div fa fa-plus"></i>
                    </div>
                    <div class="category_select_body">
                        <div class="custom_control_group">
                            <div class="left_custom_control">
                                <label for="">Category</label>
                            </div>
                            <div class="right_custom_control">
                                <input type="text" class="custom_control" placeholder="Category" />
                            </div>
                        </div>
                        <div class="custom_control_group">
                            <div class="left_custom_control">
                                <label for="">Position</label>
                            </div>
                            <div class="right_custom_control">
                                <input type="number" class="custom_control" placeholder="Position" />
                            </div>
                        </div>
                        <div class="custom_control_group">
                            <div class="left_custom_control">
                                <label for="">Products</label>
                            </div>
                            <div class="right_custom_control">
                                <div class="multi_select_parent_div">
                                    <input style="width: 25px; border: none" id="product_search" data-ul="multi_select_ul" type="text"
                                           class="custom_control multi_select" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="multi_select_div hide">
                    <ul class="multi_select_ul">
                        <li  class="multi_select_li">TeslaLuxury Electric Vehicles2003-Present.</li>
                        <li  class="multi_select_li">BMWLuxury Vehicles1916-Present.</li>
                        <li  class="multi_select_li">FerrariLuxury Sports Cars1947-present.</li>
                        <li  class="multi_select_li">FordMass-Market Cars1903-Present.</li>
                        <li  class="multi_select_li">PorscheLuxury Sports Cars1931-Present.</li>
                        <li  class="multi_select_li">HondaMass-Market Cars1948-Present.</li>
                        <li  class="multi_select_li">LamborghiniLuxury Sports Cars1963-Present.</li>
                        <li  class="multi_select_li">ToyotaMass-Market Cars1937-Present.</li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

@stop

@push('scripts')
<style>
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
        z-index: 9999;
    }
    .multi_select_div ul {
        margin-left: -10px;
    }
    .multi_select_div ul li {
        height: 29px;
        line-height: 29px;
        padding: 0 10px;
        margin-bottom: 3px;
        cursor: pointer;
    }
    .multi_select_div ul li:hover {
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
        width: 15%;
    }
    div.right_custom_control {
        float: left;
        width: 85%;
        /*position: relative;*/
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
        display: block;
        height: 200px;
        border: 1px solid #8080806e;
        padding: 10px 15px;
        border-top: none;
    }
    div.category_select_header i {
        position: absolute;
        right: 12px;
        top: 9px;
        cursor: pointer;
        font-size: 20px;
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
    <script>
        $( document ).ready(function() {
            $("body").on("keyup", ".multi_select", function (e) {
                $(this).css("width", 25+(7*(+$(this).val().length))+"px")
                var div = $("ul."+$(this).attr("data-ul"));
                for (var i = 0; i < div.children().length; i++) {
                    var indx = div.children()[i].innerHTML.toLowerCase().indexOf($(this).val().toLowerCase()) > -1;
                    if (indx) {
                        div.children()[i].classList.remove('hide');
                        div.children()[i].setAttribute("data-id-fill", $(this).attr('id'));
                    } else {
                        $("ul."+$(this).attr("data-ul")).children()[i].classList.add('hide');
                    }
                    console.log($(this).val().toLowerCase())
                }

            });

            $("ul.multi_select_ul li").click(function (e) {
                var btn = document.createElement("button");
                var icon = document.createElement("i");
                icon.className = "fa fa-times";
                btn.className = "multi_select_btn";

                icon.addEventListener("click", function (e) {
                    console.log(e.target)
                    e.target.parentNode.parentNode.removeChild(e.target.parentNode);
                });

                btn.innerHTML = $(this).html();
                btn.appendChild(icon)

                var div =  $("#"+$(this).attr("data-id-fill"));
                var parent = div.parent();
                parent.append(btn);
                var it = div.clone();
                div.remove();
                parent.append(it);
                var top = +$(this).parent().parent().css("top").slice(0, -2)+(parent.height()-32)
                $(this).parent().parent().css("top", top+"px")
            });

            $(".multi_select").focus(function (e) {
                var top = $(this).parent().position().top;
                var left = $(this).parent().position().left;
                var width = $(this).parent().width();
                $(".multi_select_div").removeClass("hide");
                $(".multi_select_div").css("top", (top+30) + "px");
                $(".multi_select_div").css("left", left + "px");
                $(".multi_select_div").css("width", width + "px");
                $(".multi_select_div").css("position", "absolute");
            });
        });

    </script>
@endpush

