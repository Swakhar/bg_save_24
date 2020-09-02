@if (
    $velocityMetaData
    && $velocityMetaData->subscription_bar_content
    || core()->getConfigData('customer.settings.newsletter.subscription')
)
    <div class="row" style="background: #4A5678;">
        
            <div class="col-md-4">
                @if ($velocityMetaData && $velocityMetaData->subscription_bar_content)
                {!! $velocityMetaData->subscription_bar_content !!}
            @endif
            </div>
            <div class="col-md-8 subscribe_email">
                
                <div class="newsletter_input_div">
                    <form action="{{ route('shop.subscribe') }}">
                        <span class="title">{{ __('velocity::app.customer.login-form.newsletter-text' ) }}</span> <input
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
    
@endif
