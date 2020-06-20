@if (
    $velocityMetaData
    && $velocityMetaData->subscription_bar_content
    || core()->getConfigData('customer.settings.newsletter.subscription')
)
    <div class="rows">
        <div class="news_letter col-lg-12">
            @if ($velocityMetaData && $velocityMetaData->subscription_bar_content)
                {!! $velocityMetaData->subscription_bar_content !!}
            @endif

            <div class="col-lg-7 subscribe_email">
                <span class="title">{{ __('velocity::app.customer.login-form.newsletter-text') }}</span>
                <div class="newsletter_input_div">
                    <form action="{{ route('shop.subscribe') }}">
                        <input
                                type="email"
                                name="subscriber_email"
                                class="control subscribe-field"
                                placeholder="{{ __('velocity::app.customer.login-form.your-email-address') }}"
                                required />
                        <button class="theme-btn subscribe-btn fw6">
                            {{ __('shop::app.subscription.subscribe') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="newsletter-subscription">--}}
        {{--<div class="newsletter-wrapper row col-lg-12">--}}
            {{--@if ($velocityMetaData && $velocityMetaData->subscription_bar_content)--}}
                {{--{!! $velocityMetaData->subscription_bar_content !!}--}}
            {{--@endif--}}

            {{--@if (core()->getConfigData('customer.settings.newsletter.subscription'))--}}
                {{--<div class="subscribe-newsletter col-lg-8">--}}
                    {{--<div class="form-container">--}}
                        {{--<form action="{{ route('shop.subscribe') }}">--}}
                            {{--<div class="subscriber-form-div">--}}
                                {{--<div class="control-group">--}}
                                    {{--<span class="newsletter-subscription-title">SIGN UP FOR NEWSLETTER</span>--}}
                                    {{--<input--}}
                                        {{--type="email"--}}
                                        {{--name="subscriber_email"--}}
                                        {{--class="control subscribe-field"--}}
                                        {{--placeholder="{{ __('velocity::app.customer.login-form.your-email-address') }}"--}}
                                        {{--required />--}}

                                    {{--<button class="theme-btn subscribe-btn fw6">--}}
                                        {{--{{ __('shop::app.subscription.subscribe') }}--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
@endif
