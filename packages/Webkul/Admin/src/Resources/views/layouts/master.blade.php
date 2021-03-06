<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>@yield('page_title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if ($favicon = core()->getConfigData('general.design.admin_logo.favicon'))
            <link rel="icon" sizes="16x16" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}" />
        @else
            <link rel="icon" sizes="16x16" href="{{ asset($relative_path . 'vendor/webkul/ui/assets/images/favicon.ico') }}" />
        @endif

        <link rel="stylesheet" href="{{ asset($relative_path . 'vendor/webkul/ui/assets/css/ui.css?version='.$version) }}">
        <link rel="stylesheet" href="{{ asset($relative_path . 'vendor/webkul/admin/assets/css/admin.css?version='.$version) }}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
        @yield('head')

        @yield('css')

        {!! view_render_event('bagisto.admin.layout.head') !!}

        <link rel="stylesheet" href="{{ asset($relative_path . 'vendor/webkul/admin/assets/css/mobile_responsive.css?version='.$version) }}">
        <link rel="stylesheet" href="{{ asset($relative_path . 'vendor/webkul/admin/assets/css/vue-multiselect.min.css?version='.$version) }}">
        <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        <style>
            .alert.alert-danger {
                background: #c10707f7;
            }
        </style>

    </head>

    <body @if (core()->getCurrentLocale() && core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif style="scroll-behavior: smooth;">
        {!! view_render_event('bagisto.admin.layout.body.before') !!}
        <span baseUrl="{{ url()->to('/') }}" style="display: none" id="base_url_span"></span>
        <div id="app">

            <div class="alert-wrapper hide" id="custom_message">
                <div class="alert alert-success">
                    <span class="icon white-cross-sm-icon"></span>
                    <p></p>
                </div>
            </div>

            <div class="top_nav_mobile_version">
                <span class="hambargur">
                    <img id="menu_open_img" class="dt_cl img_ham"
                         src="{{ asset($relative_path . 'vendor/webkul/admin/assets/css/icons/hambarger.png') }}" alt="">
                </span>

                <span class="dt2cl click_to_logou_open top_periosd_click top_nav_mobile_logout">
                    Admin
                    <i class="dt2cl click_to_logou_open top_periosd_click icon arrow-down-icon active"></i>
                    <div class="dt2 show_logout_div hide">
                        <ul class="dt2">
                             <li class="dt2" >
                                <a class="dt2"  href="{{ route('shop.home.index') }}" target="_blank">{{ __('admin::app.layouts.visit-shop') }}</a>
                            </li>
                            <li class="dt2" >
                                <a class="dt2"  href="{{ route('admin.account.edit') }}">{{ __('admin::app.layouts.my-account') }}</a>
                            </li>
                            <li class="dt2" >
                                <a class="dt2"  href="{{ route('admin.session.destroy') }}">{{ __('admin::app.layouts.logout') }}</a>
                            </li>
                        </ul>
                    </div>
                </span>
            </div>

            <flash-wrapper ref='flashes'></flash-wrapper>

            {!! view_render_event('bagisto.admin.layout.nav-top.before') !!}

            @include ('admin::layouts.nav-top')

            {!! view_render_event('bagisto.admin.layout.nav-top.after') !!}


            {!! view_render_event('bagisto.admin.layout.nav-left.before') !!}

            @include ('admin::layouts.nav-left')

            {!! view_render_event('bagisto.admin.layout.nav-left.after') !!}


            <div class="content-container">

                {!! view_render_event('bagisto.admin.layout.content.before') !!}

                @yield('content-wrapper')

                {!! view_render_event('bagisto.admin.layout.content.after') !!}

            </div>
            {!! view_render_event('bagisto.admin.layout.nav-left.before') !!}

            @include ('admin::layouts.nav-left')

            {!! view_render_event('bagisto.admin.layout.nav-left.after') !!}

        </div>

        <span id="base_url" url="{{ url()->to('/') }}"></span>

        <script type="text/javascript">
            window.flashMessages = [];

            @foreach (['success', 'warning', 'error', 'info'] as $key)
                @if ($value = session($key))
                    window.flashMessages.push({'type': 'alert-{{ $key }}', 'message': "{{ $value }}" });
                @endif
            @endforeach

            window.serverErrors = [];
            @if (isset($errors))
                @if (count($errors))
                    window.serverErrors = @json($errors->getMessages());
                @endif
            @endif
        </script>

        <script type="text/javascript" src="{{ asset($relative_path . 'vendor/webkul/admin/assets/js/admin.js?version='.$version) }}"></script>
        <script type="text/javascript" src="{{ asset($relative_path . 'vendor/webkul/ui/assets/js/ui.js?version='.$version) }}"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.full.min.js"></script>

        @stack('scripts')

        <script type="text/javascript">
            $( document ).ready(function() {
                $('.select2').select2();
            });

            window.addEventListener('DOMContentLoaded', function() {
                moveDown = 60;
                moveUp =  -60;
                count = 0;
                countKeyUp = 0;
                pageDown = 60;
                pageUp = -60;
                scroll = 0;

                listLastElement = $('.menubar li:last-child').offset();

                if (listLastElement) {
                    lastElementOfNavBar = listLastElement.top;
                }

                navbarTop = $('.navbar-left').css("top");
                menuTopValue = $('.navbar-left').css('top');
                menubarTopValue = menuTopValue;

                documentHeight = $(document).height();
                menubarHeight = $('ul.menubar').height();
                navbarHeight = $('.navbar-left').height();
                windowHeight = $(window).height();
                contentHeight = $('.content').height();
                innerSectionHeight = $('.inner-section').height();
                gridHeight = $('.grid-container').height();
                pageContentHeight = $('.page-content').height();

                if (menubarHeight <= windowHeight) {
                    differenceInHeight = windowHeight - menubarHeight;
                } else {
                    differenceInHeight = menubarHeight - windowHeight;
                }

                if (menubarHeight > windowHeight) {
                    document.addEventListener("keydown", function(event) {
                        if ((event.keyCode == 38) && count <= 0) {
                            count = count + moveDown;

                            $('.navbar-left').css("top", count + "px");
                        } else if ((event.keyCode == 40) && count >= -differenceInHeight) {
                            count = count + moveUp;

                            $('.navbar-left').css("top", count + "px");
                        } else if ((event.keyCode == 33) && countKeyUp <= 0) {
                            countKeyUp = countKeyUp + pageDown;

                            $('.navbar-left').css("top", countKeyUp + "px");
                        } else if ((event.keyCode == 34) && countKeyUp >= -differenceInHeight) {
                            countKeyUp = countKeyUp + pageUp;

                            $('.navbar-left').css("top", countKeyUp + "px");
                        } else {
                            $('.navbar-left').css("position", "fixed");
                        }
                    });

                    $("body").css({minHeight: $(".menubar").outerHeight() + 100 + "px"});

                    window.addEventListener('scroll', function() {
                        documentScrollWhenScrolled = $(document).scrollTop();

                        if (documentScrollWhenScrolled <= differenceInHeight + 200) {
                            $('.navbar-left').css('top', -documentScrollWhenScrolled + 60 + 'px');
                            scrollTopValueWhenNavBarFixed = $(document).scrollTop();
                        }
                    });
                }
            });
        </script>

        {!! view_render_event('bagisto.admin.layout.body.after') !!}
        <script src="{{ asset($relative_path . 'vendor/webkul/admin/assets/css/menu.js?version='.$version) }}"></script>
        <div class="modal-overlay"></div>
    </body>
</html>