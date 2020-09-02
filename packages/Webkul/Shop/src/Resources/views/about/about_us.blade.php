@extends('shop::layouts.static_master')

@php
    $channel = core()->getCurrentChannel();

    $homeSEO = $channel->home_seo;

    if (isset($homeSEO)) {
        $homeSEO = json_decode($channel->home_seo);

        $metaTitle = $homeSEO->meta_title;

        $metaDescription = $homeSEO->meta_description;

        $metaKeywords = $homeSEO->meta_keywords;
    }
@endphp

@section('page_title')
    {{ isset($metaTitle) ? $metaTitle : "" }}
@endsection

@section('head')

    @if (isset($homeSEO))
        @isset($metaTitle)
            <meta name="title" content="{{ $metaTitle }}" />
        @endisset

        @isset($metaDescription)
            <meta name="description" content="{{ $metaDescription }}" />
        @endisset

        @isset($metaKeywords)
            <meta name="keywords" content="{{ $metaKeywords }}" />
        @endisset
    @endif
@endsection

@section('content-wrapper')
<div class="container mar_top_about">
    <div class="row crumbs">
    <div class="col-md-11" style="font-size: 1.5rem;margin-top: 20px;margin-bottom: 20px;">
        <a href="{{route('shop.home.index')}}" style="color:#0f3bb7;">Home</a> <i class="fa fa-chevron-right"></i> {{$menu}}
    </div>
    @include('shop::layouts.menu_nav')
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <img src="{{ asset('themes/velocity/assets/images/static/1.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-12">
      <h2 class="ht">
        Safeshop Bangladesh Ltd.
      </h2>
      <div style="width: 275px;border-color: #ff5500;border-width: 2px;border-style: solid;"></div>
      <p class="nt">SafeShop Bangladesh Ltd. is a Business-to-Business (B2B) and Business-to-Consumer (B2C) Marketplace for the Bangladeshi Businesses and for the retail customers for different products which serves a flawless one stop procurement solutions and new shopping experience. SafeShop has been established with the intention of securing the purchasing triangle of Quality, Cost and Time for you.<br>
      <br>SafeShop.com.bd will give you an easy solution to compare market price from different qualified suppliers, get quantity discount, special discount and many more facilities. Our main goal is to provide quality and original product to our valuable customers. We have quality products at competitive market prices from lot of qualified vendor’s and ship right to your office or factory or shop or your doorstep.<br>
      </p>
    </div>
    <div class="col-md-12">
      <img src="/themes/velocity/assets/images/static/57e2d54a4c56ac14f6da8c7dda793678153bdee757596c4870267cd59149c55cbb_1280.jpg" height="508" width="761">
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5" style="color: #ffffff;
    background-color: #343c54;margin-top: -100px;">
      <br><br><br>
      <h3 style="font-size: 1.875rem;
    font-family: 'Archivo Black';margin: 40px 4px 0 0; color: #ff5500 !important;">Safeshop</h3>
    <p style="font-style: italic;
    font-family: 'Source Sans Pro';
    font-size: 1.25rem;
    margin: 20px 4px 0 0;">
      Safeshop Bangladesh - New Experience of B2B & B2C E-Commerce Marketplace in Bangladesh<br><br><br>
    </p>
    </div>
    <div class="col-md-5" style="margin-top: -100px;background: #ffffff;">
      <br><br><br>
      <h3 style="font-size: 1.875rem;
    font-family: 'Archivo Black';margin: 40px 4px 0 0; color: #ff5500 !important;">Slogan</h3>
    <p style="font-style: italic;
    font-family: 'Source Sans Pro';
    font-size: 1.875rem;
    font-weight: 700;
    margin: 20px 0 0; color: #343c54 !important;">
      CHECK BUY & SAVE<br><br><br>
    </p>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5">
      <h3 style="font-size: 1.875rem;
    font-family: 'Archivo Black';margin: 40px 4px 0 0; color: #ff5500 !important;">Mission</h3>
    <p style="font-style: italic;
    font-family: 'Source Sans Pro';
    font-size: 1.875rem;
    font-weight: 700;
    margin: 20px 0 0; color: #343c54 !important;">
      SAVE MONEY &amp; SAVE TIME
    </p>
    </div>
    <div class="col-md-5" style="color: #ffffff;
    background-color: #343c54;">
      <h3 style="font-size: 1.875rem;
    font-family: 'Archivo Black';margin: 40px 4px 0 0; color: #ff5500 !important;">Vision</h3>
    <p style="font-style: italic;
    font-family: 'Source Sans Pro';
    font-size: 1.25rem;
    margin: 20px 4px 0 0;">
      To be market leader by giving the best Experience of B2B & B2C E-Commerce marketplace  in Bangladesh<br><br><br>
    </p>
    </div>
    <div class="col-md-6">
      <img src="/themes/velocity/assets/images/static/online_shop_logo1.png" height="137px" width="100%" style="margin: 79px 28px 0 auto;">
      <p style="font-size: 1.5rem;
    font-weight: 700;margin: 0px 0px 0px 220px;">Check Buy &amp; Save</p>
    </div>
    <div class="col-md-6">
      <h2 style="font-weight: 700;
    font-size: 3.75rem;
    margin: 79px 0 0;color: #343c54 !important;">safe<font style="#ff5500 !important;">shop</font> Logo
      </h2>
      <p style="font-size: 1.125rem;
    font-family: 'Source Sans Pro';
    margin: 24px 0 0; color: #343c54 !important;">Safeshop logo exist 3 color which is blue, orange and white. Safe shield cover the Safeshop S alphabet which ensure your safe and secure shopping at our B2B and B2C marketplace.</p>
    </div>
    <div class="col-md-12">
      <h2 style="font-weight: 700;color: #ff5500;">Why SafeShop?
        </h2>
      <div style="width: 275px;border-color: #ff5500;border-width: 2px;border-style: solid;"></div>
    </div>
    <div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/ss.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Safe & Secure</p>
      <p class="ts" style="text-align:center;font-size: 1rem">
        Trusted and Secure marketplace for B2B & B2C E-Commerce Marketplace in Bangladesh. <br><br><br>
      </p>
    </div>
    <div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/lm.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Lowest Market Price</p>
      <p class="ts" style="text-align:center;font-size: 1rem">
        Safeshop will provide you the best market price by comparing the price with best renowned brands products
      </p>
    </div>
    <div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/oc.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Online and COD Payment</p>
      <p class="ts" style="text-align:center;font-size: 1rem">
        Safeshop will provide you the best and secure payment service with all available payment methods in Bangladesh. ''Cash on Delivery'' available all over Bangladesh
      </p>
    </div><div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/sd.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Speed & Timely Delivery</p>
      <p class="ts" style="text-align:center;font-size: 1rem">
        Safeshop will provide you speed and timely delivery all over Bangladesh
      </p>
    </div><div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/er.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Easy Return</p>
      <p class="ts" style="text-align:center;font-size: 1rem">
        Safeshop has easy return policy which will give you more comfortable for your online shopping
      </p>
    </div><div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/247.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">24/7 Customer Service</p>
      <p class="ts" style="text-align:center;font-size: 1rem">
        Safeshop customer representative understand the customer values and they always give you best possible support
      </p>
    </div>
    <div class="col-md-12">
      <h2 style="font-weight: 700;color: #ff5500;">Core Values
        </h2>
      <div style="width: 205px;border-color: #ff5500;border-width: 2px;border-style: solid;"></div>
    </div>
    <div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/tw.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Team Work</p>

    </div>
    <div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/247.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Customer focus and Customer Service</p>

    </div>
    <div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/go.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Goal Oriented</p>

    </div><div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/tr.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Trust & Responsibility
      </p>

    </div><div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/in.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Integrity</p>

    </div><div class="col-md-4">
      <center><img src="/themes/velocity/assets/images/static/trans.png"></center>
      <p class="ts" style="text-align:center;font-size: 1.5rem">Transparency</p>

    </div>
    <div class="col-md-12" style="padding-bottom: 20px">
      <h2 style="font-weight: 700;color: #ff5500;">Our Brands
        </h2>
      <div style="width: 200px;border-color: #ff5500;border-width: 2px;border-style: solid;"></div>
    </div>
    <div class="col-md-12" style="padding-bottom: 50px">
                    <div id="myCarousel2" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            <div class="carousel-item active">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next bg-dark w-auto" href="#myCarousel2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
  </div>
</div>

@endsection()
