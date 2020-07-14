<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <title>@yield('page_title')</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="content-language" content="{{ app()->getLocale() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ asset('themes/velocity/assets/css/velocity.css') }}" />
        <link rel="stylesheet" href="{{ asset('themes/velocity/assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('themes/velocity/assets/css/google-font.css') }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700"/>

        {{--<link rel="stylesheet" href="{{ asset('/themes/velocity/assets/css/slick.css') }}" />--}}
        {{--<link rel="stylesheet" href="{{ asset('/themes/velocity/assets/css/slick-theme.css') }}" />--}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />
        <link rel="stylesheet" href="{{ asset('/themes/velocity/assets/css/custom_design.css') }}" />
        <link rel="stylesheet" href="{{ asset('/themes/velocity/assets/css/style.css') }}" />
        <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        @if (core()->getCurrentLocale()->direction == 'rtl')
            <link href="{{ asset('themes/velocity/assets/css/bootstrap-flipped.css') }}" rel="stylesheet">
        @endif

        @if ($favicon = core()->getCurrentChannel()->favicon_url)
            <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
        @else
            <link rel="icon" sizes="16x16" href="{{ asset('/themes/velocity/assets/images/static/v-icon.png') }}" />
        @endif



        <script
            type="text/javascript"
            src="{{ asset('themes/velocity/assets/js/jquery.min.js') }}">
        </script>

        <script
            type="text/javascript"
            baseUrl="{{ url()->to('/') }}"
            src="{{ asset('themes/velocity/assets/js/velocity.js') }}">
        </script>

        <script
            type="text/javascript"
            src="{{ asset('themes/velocity/assets/js/jquery.ez-plus.js') }}">
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


        @include('shop::UI.static_particals')

        <div id="app">
            <product-quick-view v-if="$root.quickView"></product-quick-view>

            <div class="main-container-wrapper">

                @section('body-header')
                    @include('shop::layouts.top-nav.index')

                    {!! view_render_event('bagisto.shop.layout.header.before') !!}

                        @include('shop::layouts.header.index')

                    {!! view_render_event('bagisto.shop.layout.header.after') !!}

                    <div class="main-content-wrapper col-12 no-padding">
                        <div class="container">
                            {!! view_render_event('bagisto.shop.layout.content.before') !!}

                                @yield('content-wrapper')

                            {!! view_render_event('bagisto.shop.layout.content.after') !!}
                        </div>
                    </div>
                @show

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
            src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}">
        </script>

        {{--<script src="{{ asset('/themes/velocity/assets/js/slick.js') }}"></script>--}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>

        @stack('scripts')
        <script>

            // landing_top_to_bottom
            $(document).ready(function () {
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
