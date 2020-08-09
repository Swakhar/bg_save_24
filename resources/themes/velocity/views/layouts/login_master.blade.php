<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <title>@yield('page_title')</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="content-language" content="{{ app()->getLocale() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ asset($relative_path . 'themes/velocity/assets/css/velocity.css') }}" />
        <link rel="stylesheet" href="{{ asset($relative_path . 'themes/velocity/assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset($relative_path . 'themes/velocity/assets/css/google-font.css') }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700"/>

        {{--<link rel="stylesheet" href="{{ asset('/themes/velocity/assets/css/slick.css') }}" />--}}
        {{--<link rel="stylesheet" href="{{ asset('/themes/velocity/assets/css/slick-theme.css') }}" />--}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
        <link rel="stylesheet" href="{{ asset($relative_path . '/themes/velocity/assets/css/custom_design.css?version='.$version) }}" />
        <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        @if (core()->getCurrentLocale()->direction == 'rtl')
            <link href="{{ asset($relative_path . 'themes/velocity/assets/css/bootstrap-flipped.css') }}" rel="stylesheet">
        @endif

        @if ($favicon = core()->getCurrentChannel()->favicon_url)
            <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
        @else
            <link rel="icon" sizes="16x16" href="{{ asset($relative_path . '/themes/velocity/assets/images/static/v-icon.png') }}" />
        @endif

        <span baseUrl="{{ url()->to('/') }}" id="base_url_span"></span>

        <script
            type="text/javascript"
            src="{{ asset($relative_path . 'themes/velocity/assets/js/jquery.min.js') }}">
        </script>

        <script
            type="text/javascript"
            baseUrl="{{ url()->to('/') }}"
            src="{{ asset($relative_path . 'themes/velocity/assets/js/velocity.js?version='.$version) }}">
        </script>

        <script
            type="text/javascript"
            src="{{ asset($relative_path . 'themes/velocity/assets/js/jquery.ez-plus.js') }}">
        </script>

        @yield('head')

        @section('seo')
            <meta name="description" content="{{ core()->getCurrentChannel()->description }}"/>
        @show

        @stack('css')

        {!! view_render_event('bagisto.shop.layout.head') !!}

    </head>

    <body @if (core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif>
        {!! view_render_event('bagisto.shop.layout.body.before') !!}


        @include('shop::UI.particals')

        <div id="app">
            <div class="modal_pop_up hide">
                <div class="header">
                    <span class="text">{{ __('velocity::app.header.shipping-location-modal-header-text') }}</span>
                </div>
                <div class="body">
                    <span class="cross">x</span>
                    <select name="" class="" id="">
                        <option selected="selected" value="77">Dhaka City</option>
                        <option value="149">Dhaka District</option>
                        <option value="85">Bagerhat</option>
                        <option value="86">Bandarban</option>
                        <option value="87">Barguna</option>
                        <option value="88">Barisal</option>
                        <option value="89">Bhola</option>
                        <option value="90">Bogra</option>
                        <option value="91">Brahmanbaria</option>
                        <option value="92">Chandpur</option>
                        <option value="93">Chapai Nawabganj</option>
                        <option value="94">Chittagong</option>
                        <option value="95">Chuadanga</option>
                        <option value="96">Comilla</option>
                        <option value="97">Cox's Bazar</option>
                        <option value="98">Dinajpur</option>
                        <option value="99">Faridpur</option>
                        <option value="100">Feni</option>
                        <option value="101">Gaibandha</option>
                        <option value="102">Gazipur</option>
                        <option value="103">Gopalganj</option>
                        <option value="105">Habiganj</option>
                        <option value="106">Jamalpur</option>
                        <option value="107">Jessore</option>
                        <option value="108">Jhalokati</option>
                        <option value="109">Jhenaidah</option>
                        <option value="110">Joypurhat</option>
                        <option value="111">Khagrachhari</option>
                        <option value="112">Khulna</option>
                        <option value="113">Kishoreganj</option>
                        <option value="114">Kurigram</option>
                        <option value="115">Kushtia</option>
                        <option value="116">Lakshmipur</option>
                        <option value="117">Lalmonirhat</option>
                        <option value="118">Madaripur</option>
                        <option value="119">Magura</option>
                        <option value="120">Manikganj</option>
                        <option value="121">Meherpur</option>
                        <option value="122">Moulvibazar</option>
                        <option value="123">Munshiganj</option>
                        <option value="124">Mymensingh</option>
                        <option value="131">Nilphamari</option>
                        <option value="125">Naogaon</option>
                        <option value="126">Narail</option>
                        <option value="127">Narayanganj</option>
                        <option value="128">Narsingdi</option>
                        <option value="129">Natore</option>
                        <option value="130">Netrokona</option>
                        <option value="132">Noakhali</option>
                        <option value="133">Pabna</option>
                        <option value="134">Panchagarh</option>
                        <option value="135">Patuakhali</option>
                        <option value="136">Pirojpur</option>
                        <option value="137">Rajbari</option>
                        <option value="138">Rajshahi</option>
                        <option value="139">Rangamati</option>
                        <option value="140">Rangpur</option>
                        <option value="104">Satkhira</option>
                        <option value="141">Shariatpur</option>
                        <option value="142">Sherpur</option>
                        <option value="143">Sirajganj</option>
                        <option value="144">Sunamganj</option>
                        <option value="145">Sylhet</option>
                        <option value="146">Tangail</option>
                        <option value="147">Thakurgaon</option>
                    </select>
                    <button class="">Save</button>
                </div>
            </div>
            {{-- <responsive-sidebar v-html="responsiveSidebarTemplate"></responsive-sidebar> --}}

            <product-quick-view v-if="$root.quickView"></product-quick-view>

            <div class="main-container-wrapper">

                @section('body-header')
                    @include('shop::layouts.top-nav.index')

                    {!! view_render_event('bagisto.shop.layout.header.before') !!}

                    <div class="row">
                        @include('shop::layouts.header.index')
                    </div>


                    {!! view_render_event('bagisto.shop.layout.header.after') !!}

                    <div class="main-content-wrapper col-12 no-padding">
                        @php
                            $velocityContent = app('Webkul\Velocity\Repositories\ContentRepository')->getAllContents();
                        @endphp

                        <content-header
                            url="{{ url()->to('/') }}"
                            :header-content="{{ json_encode($velocityContent) }}"
                            heading= "{{ __('velocity::app.menu-navbar.text-category') }}"
                            category-count="{{ $velocityMetaData ? $velocityMetaData->sidebar_category_count : 10 }}"
                        ></content-header>


                    </div>
                @show

                    <div class="container-fluid ">
                        <div class="row top_banner_three_section">
                            {!! view_render_event('bagisto.shop.layout.content.before') !!}

                            @yield('content-wrapper')

                            {!! view_render_event('bagisto.shop.layout.content.after') !!}
                        </div>
                    </div>


                    <div class="container-fluid">
                    @yield('full-add-first')
                </div>
                <div class="container-fluid cont_recom">
                    @yield('full-recommended-slider')
                </div>

                <div class="container-fluid">
                    @yield('full-on-sale-now')
                </div>

                <div class="container-fluid">
                    @yield('full-add-second')
                </div>

                    <div class="container-fluid">
                        @yield('full-add-third')
                    </div>

                    <div class="container-fluid">
                        @yield('full-needed-slider')
                    </div>

                <div class="container-fluid">

                    {!! view_render_event('bagisto.shop.layout.full-content.before') !!}

                        @yield('full-content-wrapper')

                    {!! view_render_event('bagisto.shop.layout.full-content.after') !!}

                </div>
            </div>
        </div>

        <!-- below footer -->
        @section('footer')
            {!! view_render_event('bagisto.shop.layout.footer.before') !!}

                @include('shop::layouts.footer.index')

            {!! view_render_event('bagisto.shop.layout.footer.after') !!}
        @show

        {!! view_render_event('bagisto.shop.layout.body.after') !!}

        <div id="alert-container"></div>

        <script type="text/javascript">
            (() => {
                window.showAlert = (messageType, messageLabel, message) => {
                    if (messageType && message !== '') {
                        let alertId = Math.floor(Math.random() * 1000);

                        let html = `<div class="alert ${messageType} alert-dismissible" id="${alertId}">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>${messageLabel ? messageLabel + '!' : ''} </strong> ${message}.
                        </div>`;

                        $('#alert-container').append(html).ready(() => {
                            window.setTimeout(() => {
                                $(`#alert-container #${alertId}`).remove();
                            }, 5000);
                        });
                    }
                }

                let messageType = '';
                let messageLabel = '';

                @if ($message = session('success'))
                    messageType = 'alert-success';
                    messageLabel = "{{ __('velocity::app.shop.general.alert.success') }}";
                @elseif ($message = session('warning'))
                    messageType = 'alert-warning';
                    messageLabel = "{{ __('velocity::app.shop.general.alert.warning') }}";
                @elseif ($message = session('error'))
                    messageType = 'alert-danger';
                    messageLabel = "{{ __('velocity::app.shop.general.alert.error') }}";
                @elseif ($message = session('info'))
                    messageType = 'alert-info';
                    messageLabel = "{{ __('velocity::app.shop.general.alert.info') }}";
                @endif

                if (messageType && '{{ $message }}' !== '') {
                    window.showAlert(messageType, messageLabel, '{{ $message }}');
                }

                window.serverErrors = [];
                @if (isset($errors))
                    @if (count($errors))
                        window.serverErrors = @json($errors->getMessages());
                    @endif
                @endif

                window._translations = @json(app('Webkul\Velocity\Helpers\Helper')->jsonTranslations());
            })();
        </script>

        <script
            type="text/javascript"
            src="{{ asset($relative_path . 'vendor/webkul/ui/assets/js/ui.js?version='.$version) }}">
        </script>

        {{--<script src="{{ asset('/themes/velocity/assets/js/slick.js') }}"></script>--}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>

        @stack('scripts')
        <script>
            // landing_top_to_bottom
            $(document).ready(function () {


                var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

$('.radio-group .radio').click(function(){
$(this).parent().find('.radio').removeClass('selected');
$(this).addClass('selected');
});

$(".submit").click(function(){
return false;
})

});
                
                var cross_modal = $("span.cross");
                var modal = $(".modal_pop_up");
                cross_modal.on("click", function () {
                    if (modal.hasClass("landing_top_to_bottom")) {
                        modal.removeClass("landing_top_to_bottom").addClass("hide")
                    }
                });

                $("#top_ham_bargur").hover(function (e) {
                    var side_menu = $("#sidebar-level-0");
                    side_menu.addClass("to_show");
                });

                $("body").mouseover(function(e) {

                    if (e.clientX > 230) {
                        var hasClass = Array.from(e.target.classList).indexOf('com') > -1;
                        if (!hasClass) {
                            var side_menu = $("#sidebar-level-0");
                            side_menu.removeClass("to_show")

                            if (!$(e.target).hasClass('hoverd-nav')) {
                                var sub_categories = $(".sub-categories");
                                sub_categories.css("display", "none");
                            }

                        }
                    }
                })



            });

            window.addEventListener('scroll', function(e) {
                var side_menu = $("#sidebar-level-0");
                var top_ham_bargur = $("#top_ham_bargur");
                if (window.scrollY > 430) {
                    top_ham_bargur.removeClass("hide");
                    side_menu.addClass("hide");
                } else {
                    side_menu.removeClass("hide");
                    side_menu.removeClass("to_show");
                    top_ham_bargur.addClass("hide");
                }
            });

        </script>
    </body>
</html>
