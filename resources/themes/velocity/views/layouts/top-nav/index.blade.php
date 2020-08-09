<nav id="top">
    <div class="container-fluid">
        <div class="col-md-4">
            @guest('customer')
            <span class="top_span">Default welcome msg! <span class="link">
                    <a href="{{ route('customer.register.index') }}">Join Free</a></span> or <span class="link"><a
                            href="#">Sign in</a></span></span>
            {{--@include('velocity::layouts.top-nav.locale-currency')--}}
            @endguest
        </div>

        <div class="col-md-8">
            <div class="top_nav_menus">
                <ul>
                    <li>
                        @guest('customer')
                        <a href="/customer/login">
                            <i class="in-i fa fa-user"></i>My Account
                        </a>
                        @endguest
                        @auth('customer')
                        <?php
                        $welcome_message = __('velocity::app.header.welcome-message',
                            ['customer_name' => auth()->guard('customer')->user()->first_name]);
                        ?>
                        <a href="/customer/login" title="{{ $welcome_message }}">
                            <i class="in-i fa fa-user"></i>
                            {{ strlen($welcome_message) > 40 ? substr($welcome_message,0, 8) . '..' :  $welcome_message  }}
                        </a>
                        @endauth
                    </li>
                    <li>
                        <a href="{{ route('customer.wishlist.index') }}"><i class="in-i fa fa-heart"></i>My Wish List</a>
                    </li>
                    <li>
                        <a href="{{ route('velocity.customer.product.compare') }}"><i class="in-i fa fa-check-square"></i>Checkout</a>
                    </li>
                    <li>
                        <a href="/seller/registration"><i class="in-i fa fa-user"></i>Seller Account</a>
                    </li>
                    <li>
                        <a href="#"><i class="in-i fa fa-language"></i>Language</a>
                    </li>
                    @auth('customer')
                    <li>
                        <a href="{{ route('customer.session.destroy') }}" class="unset">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>{{ __('shop::app.header.logout') }}</a>
                    </li>
                    @endauth
                </ul>
            </div>
{{--            @include('velocity::layouts.top-nav.login-section')--}}
        </div>
    </div>
</nav>