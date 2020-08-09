@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.cms.recommended_slider.config') }}
@stop

@section('content')

    <div class="content">
        <form class="insert" method="post" action="{{ route('admin.recommended_sliders.store') }}"
              enctype="multipart/form-data">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.cms.recommended_slider.config') }}</h1>
            </div>
            <div class="page-action">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" id="add_new_category" class="btn btn-warning"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <div class="page-content">
            <div class="control-group">


                    {{ csrf_field() }}
                    @if($RecommendedSliderIsConfigured)
                        <div class="custom_control_group">
                            <div class="left_custom_control">
                                <label for="">Slider Name</label>
                            </div>
                            <div class="right_custom_control">
                                <input id="slider_name" value="{{ $slider_name }}" name="slider_name" type="text"
                                       class="custom_control"
                                       placeholder="Slider Name" />
                            </div>
                        </div>

                        <div id="newly_added_div">
                            <?php $i = 0; ?>
                        @foreach($slider_data as $key => $value)
                            @if ($i == 0)
                                <input type="hidden" name="slider_id" value="{{ $value['slider_id'] }}" />
                            @endif
                                <div class="category_select_group">
                                    <div class="category_select_header">
                                        <span class="panel_head_name panel_title_{{ $i }}">{{ $value['category_name'] }}</span>
                                        <i class="expand_div fa fa-plus"></i>
                                        <i class="trash fa fa-trash text-danger"></i>
                                    </div>
                                    <div class="category_select_body hide">
                                        <div class="custom_control_group">
                                            <div class="left_custom_control">
                                                <label for="">Category</label>
                                            </div>
                                            <div class="right_custom_control">
                                                <input readonly value="{{ $value['category_name'] }}" id="category_{{ $i }}" data-product-key="product_search_{{ $i }}"
                                                       data-panel-title="panel_title_{{ $i }}" type="text"
                                                       class="dt2 custom_control custom_select2_input" placeholder="Category">
                                                <input id="category_id_{{ $i }}" name="category_id_{{ $i }}" class="value_fill" value="{{ $value['category_id'] }}" type="hidden">
                                            </div>
                                        </div>
                                        <div class="custom_control_group">
                                            <div class="left_custom_control">
                                                <label for="">Position</label>
                                            </div>
                                            <div class="right_custom_control">
                                                <input value="{{ $value['position'] }}" type="number" id="position_{{ $i }}"
                                                       name="position_{{ $i }}" class="custom_control" placeholder="Position">
                                            </div>
                                        </div>
                                        <div class="custom_control_group">
                                            <div class="left_custom_control">
                                                <label for="">Products</label>
                                            </div>
                                            <div class="dt2 right_custom_control">
                                                <div class="dt2 multi_select_parent_div">
                                                    @foreach($value['products'] as $product_key => $product_value)
                                                        <button class="multi_select_btn">{{ $product_value->product_name }}
                                                            <i class="fa fa-times close_product"></i>
                                                            <input type="hidden" name="product_id_{{ $i }}[]" value="{{ $product_value->product_id }}">
                                                        </button>
                                                    @endforeach
                                                    <input style="width: 25px; border: none" id="product_search_{{ $i }}" data-ul="multi_select_ul"
                                                            data-cat-name="category_id_{{ $i }}"
                                                           type="text" data-name="product_id_{{ $i }}" class="dt2 custom_control multi_select" data-limit="8">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php $i += 1; ?>
                        @endforeach
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    @else
                        <div class="custom_control_group">
                            <div class="left_custom_control">
                                <label for="">Slider Name</label>
                            </div>
                            <div class="right_custom_control">
                                <input id="slider_name" name="slider_name" type="text" class="custom_control"
                                       placeholder="Slider Name" />
                            </div>
                        </div>

                        <div id="newly_added_div">

                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    @endif


                <div class="dt2 multi_select_div hide" data-top="">
                    <input type="hidden"  class="hidden_multi_select_top_position" />
                    <ul class="dt2 multi_select_ul">
                        @foreach($catalog_object['products'] as $key => $value)
                            <li data-id="{{ $value->product_id }}"  data-cat-id="{{ $value->category_id }}"
                                class="dt2 multi_select_li">{{ $value->product_name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class=" custom_select2 hide">
                    <input type="hidden"  class="hidden_custom_select_top_position" />
                    <ul class=" custom_select2_ul">
                        @foreach($catalog_object['categories'] as $key => $value)
                            <li data-id="{{ $key }}"
                                class=" custom_select2_li">{{ $value }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>
        </form>
    </div>

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
    <script>
        $( document ).ready(function() {
            $("body").on("blur", ".custom_select2_input", function (e) {
                if ($(this) == "") {
                    $(this).parent().children().find(".value_fill").val("");
                    $("#"+$(this).attr("data-product-key")).prop("disabled", true)
                } else {
                    $("#"+$(this).attr("data-product-key")).prop("disabled", false)
                }
                console.log()
            });

            $('form.insert').submit(function(event) {
                event.preventDefault();
                var formData = new FormData($(this)[0]);
                var custom_message = $("#custom_message");
                console.log(formData)

                $.ajax({
                    url: '{{ route('admin.recommended_sliders.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(result)
                    {
                        custom_message.removeClass("hide");
                        custom_message.children()[0].classList.remove("alert-danger");
                        custom_message.children()[0].classList.add("alert-success");
                        custom_message.children().children()[1].innerHTML = result.message;
                        setTimeout(function(){
                            custom_message.addClass("hide");
                        }, 3000);
//                        location.reload();
                    },
                    error: function(data)
                    {
                        console.log(data.responseJSON.errors)
                        custom_message.removeClass("hide");
                        custom_message.children()[0].classList.remove("alert-success");
                        custom_message.children()[0].classList.add("alert-danger");
                        custom_message.children().children()[1].innerHTML = data
                    }
                });

            });

            $("body").on("focus", ".custom_select2_input", function (e) {
                var hidden_custom_select_top_position = $(".hidden_custom_select_top_position");
                var custom_select2 = $(".custom_select2");
                hidden_custom_select_top_position.attr("data-id-fill", $(this).attr('id'));
                custom_select2.removeClass("hide");
                var top = $(this).parent().position().top;
                var left = $(this).parent().position().left;
                var width = $(this).parent().width();
                console.log('top->', top)

                custom_select2.css("top", (top+30) + "px");

                custom_select2.css("left", left + "px");
                custom_select2.css("width", width + "px");
                custom_select2.css("position", "absolute");

                hidden_custom_select_top_position.val((top+30));
                hidden_custom_select_top_position.attr("data-id-fill", $(this).attr('id'));
                hidden_custom_select_top_position.attr("data-limit", $(this).attr('data-limit'));
                hidden_custom_select_top_position.attr("data-name", $(this).attr('data-name'));

            });

            $("body").on("click", ".expand_div", function (e) {
                if ($(this).hasClass("fa-minus")) {
                    $(this).removeClass("fa-minus").addClass("fa-plus");
                    $(this).parent().parent().children()[1].classList.add('hide')
                } else {
                    $(this).parent().parent().children()[1].classList.remove('hide');
                    $(this).removeClass("fa-plus").addClass("fa-minus");

                }
            });

            $("body").on("keyup", ".multi_select", function (e) {

                $(this).css("width", 25+(7*(+$(this).val().length))+"px");
                var div = $("ul."+$(this).attr("data-ul"));
                for (var i = 0; i < div.children().length; i++) {
                    var indx = div.children()[i].innerHTML.toLowerCase().indexOf($(this).val().toLowerCase()) > -1;
                    var li_cat = div.children()[i].getAttribute("data-cat-id");
                    if (indx && (li_cat == $("#"+($(this).attr("data-cat-name"))).val())) {
                        div.children()[i].classList.remove('hide');
                    } else {
                        $("ul."+$(this).attr("data-ul")).children()[i].classList.add('hide');
                    }
                }
            });

            $("ul.multi_select_ul li").click(function (e) {
                var hidden_multi_select_top_position = $(".hidden_multi_select_top_position");
                var limit =  +hidden_multi_select_top_position.attr("data-limit");

                var btn = document.createElement("button");
                var icon = document.createElement("i");
                var data_id_val = $(this).attr("data-id");
                var input_hidden = document.createElement("input");
                input_hidden.type= "hidden";
                input_hidden.name = hidden_multi_select_top_position.attr("data-name") + "[]";
                input_hidden.value = data_id_val;

                icon.className = "fa fa-times";
                btn.className = "multi_select_btn";

                var search_div = $(this).parent().parent();
                $(this).parent().parent();

                var div =  $("#"+hidden_multi_select_top_position.attr("data-id-fill"));
                var parent = div.parent();

                var is_addable = true;
                parent.find('input[name^="product_id"]').each(function() {
                    if (is_addable) {
                        is_addable = ($(this).val() !== data_id_val)
                    }
                });

                if ((parent.children().length) > limit) {
                    alert("You Can Not Add More than " + limit + " Items")
                } else if (is_addable) {
                    icon.addEventListener("click", function (e) {
                        e.target.parentNode.parentNode.removeChild(e.target.parentNode);
                        var t_top = +hidden_multi_select_top_position.val() + (parent.height()-32);
                        console.log(search_div.css("top"), parent.height(), t_top);
                        search_div.css("top", t_top+"px");

                    });

                    btn.innerHTML = $(this).html();
                    btn.appendChild(icon);
                    btn.appendChild(input_hidden);

                    parent.append(btn);
                    var it = div.clone();
                    div.remove();
                    parent.append(it);

                    var top = +hidden_multi_select_top_position.val() + (parent.height()-32);
                    $(this).parent().parent().css("top", top+"px")
                }

            });

            $(".close_product").on("click", function (e) {
                var hidden_multi_select_top_position = $(".hidden_multi_select_top_position");
                e.target.parentNode.parentNode.removeChild(e.target.parentNode);
                var t_top = +hidden_multi_select_top_position.val() + (parent.height()-32);

            });

            $("ul.custom_select2_ul li").click(function (e) {
                var hidden_custom_select_top_position = $(".hidden_custom_select_top_position");
                $("#"+hidden_custom_select_top_position.attr("data-id-fill")).val($(this).html());

                $("#"+hidden_custom_select_top_position.attr("data-id-fill"))
                    .parent().find(".value_fill").val($(this).attr("data-id"));

                $("#"+hidden_custom_select_top_position.attr("data-id-fill"))
                    .closest('category_select_group').find(".panel_head_name").html($(this).html())

                $("."+$("#"+hidden_custom_select_top_position.attr("data-id-fill"))
                        .attr('data-panel-title')).html($(this).html())

                // value_fill

            });


            $("body").on("click", ".multi_select_parent_div", function (e) {
                $(this).closest('.right_custom_control').find('.multi_select').focus()
            });

            $("body").on("focus", ".multi_select", function (e) {
                var hidden_multi_select_top_position = $(".hidden_multi_select_top_position");
                var multi_select_div = $(".multi_select_div");
                multi_select_div.removeClass("hide");

                var div = $("ul."+$(this).attr("data-ul"));
                for (var i = 0; i < div.children().length; i++) {
                    var li_cat = div.children()[i].getAttribute("data-cat-id");
                    if ((li_cat == $("#"+($(this).attr("data-cat-name"))).val())) {
                        div.children()[i].classList.remove('hide');
                    } else {
                        $("ul."+$(this).attr("data-ul")).children()[i].classList.add('hide');
                    }
                }

                if (hidden_multi_select_top_position.val() === "") {
                    hidden_multi_select_top_position.attr("data-id-fill", $(this).attr('id'));
                    multi_select_div.removeClass("hide");
                    var top = $(this).parent().position().top;
                    var left = $(this).parent().position().left;
                    var width = $(this).parent().width();
                    top = top + $(this).parent().height();
//                    multi_select_div.css("top", (top+30) + "px");
                    multi_select_div.css("top", top + "px");
                    multi_select_div.css("left", left + "px");
                    multi_select_div.css("width", width + "px");
                    multi_select_div.css("position", "absolute");
                    hidden_multi_select_top_position.val((top));
                    hidden_multi_select_top_position.attr("data-id-fill", $(this).attr('id'));
                    hidden_multi_select_top_position.attr("data-limit", $(this).attr('data-limit'));
                    hidden_multi_select_top_position.attr("data-name", $(this).attr('data-name'));
                }
                else if (hidden_multi_select_top_position.attr("data-id-fill") !== $(this).attr('id')) {
                    hidden_multi_select_top_position.attr("data-id-fill", $(this).attr('id'));
                    multi_select_div.removeClass("hide");
                    var top = $(this).parent().position().top;
                    var left = $(this).parent().position().left;
                    var width = $(this).parent().width();

                    top = top + $(this).parent().height();
//                    multi_select_div.css("top", (top+30) + "px");
                    multi_select_div.css("top", top + "px");
                    multi_select_div.css("left", left + "px");
                    multi_select_div.css("width", width + "px");
                    multi_select_div.css("position", "absolute");
                    hidden_multi_select_top_position.val((top));
                    hidden_multi_select_top_position.attr("data-id-fill", $(this).attr('id'));
                    hidden_multi_select_top_position.attr("data-limit", $(this).attr('data-limit'));
                    hidden_multi_select_top_position.attr("data-name", $(this).attr('data-name'));
                }

            });

            $("#add_new_category").on("click", function (e) {
                var count = $("#newly_added_div").children().length;
                var div = '<div class="category_select_group">'+
                            '<div class="category_select_header">'+
                                '<span class="panel_head_name panel_title_'+count+'"></span>'+
                                '<i class="expand_div fa fa-plus"></i>'+
                                '<i class="trash fa fa-trash"></i>'+
                            '</div>'+
                            '<div class="category_select_body hide">'+
                            '<div class="custom_control_group">'+
                                '<div class="left_custom_control">'+
                                    '<label for="">Category</label>'+
                                '</div>'+
                                '<div class="right_custom_control">'+
                                    '<input readonly id="category_'+count+'" data-product-key="product_search_'+count+'" data-panel-title="panel_title_'+count+'" type="text" class="dt2 custom_control custom_select2_input"'+
                                    'placeholder="Category" />'+
                                    '<input id="category_id_'+count+'"  name="category_id_'+count+'" class="value_fill" type="hidden"  />'+
                                '</div>'+
                            '</div>'+
                            '<div class="custom_control_group">'+
                                '<div class="left_custom_control">'+
                                    '<label for="">Position</label>'+
                                '</div>'+
                                '<div class="right_custom_control">'+
                                    '<input type="number" id="position_'+count+'" name="position_'+count+'" class="custom_control" placeholder="Position" />'+
                                '</div>'+
                            '</div>'+
                            '<div class="custom_control_group">'+
                                '<div class="left_custom_control">'+
                                    '<label for="">Products</label>'+
                                '</div>'+
                                '<div class="dt2 right_custom_control">'+
                                    '<div class="dt2 multi_select_parent_div">'+
                                    '<input style="width: 25px; border: none" id="product_search_'+count+'"'+
                                    'data-ul="multi_select_ul" disabled type="text"'+
                                    'data-name="product_id_'+count+'"'+
                                    'data-cat-name="category_id_'+count+'"'+
                                    'class="dt2 custom_control multi_select" data-limit="8" />'+
                                    '</div>'+
                                ' </div>'+
                            '</div>'+
                        '</div>'+
                   ' </div>';
                $("#newly_added_div").append(div)
            });

            $("body").on("click", "i.trash", function (e) {
                console.log($(this).parent().parent().remove())
            });


        });

    </script>
@endpush

