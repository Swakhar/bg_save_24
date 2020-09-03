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
      <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/61.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-12">
      <p class="ts">
        We accept most major payment methods that are available in Bangladesh. SafeShop.com.bd will never save your payment information. Therefore, there is no risk at all when you shop on our website. As we are committed to provide you with the best experience on our site, if you think your choice of payment method is missing on our site, please let us know and we will accommodate accordingly. Below is a list of currently accepted methods of payments. <br>
      </p>
      <p class="htt">Available Payment Methods</p>
      <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/SSL-Commerz-Pay-With-logo-All-Size-01-1.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-12">
        <p class="ts">
            1.&nbsp;
We are processing the
payment method through our payment getaway partner. You can use any one of the
following payment methods through our payment getaway partner:&nbsp;<br><br>2. We accept Cash on delivery (COD) throughout Bangladesh.&nbsp;<br>
          <br>3. Our bKash Merchant No.: +8801712492624<br>
          <br>
        </p>
    </div>
    <div class="col-md-3">
        <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/p1.png')}}" width="100%" height="100">
    </div>
    <div class="col-md-3">
        <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/p2.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-3">
        <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/p3.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-3">
        <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/p4.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-12">
        <p class="ts">
            Safeshop.com.bd is a safe and secure E-Commerce Marketplace where you can take new experience of B2B & B2C shopping with lot of money saving opportunities and secure payments.
        </p>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3" style="padding-bottom: 50px;">
      <p class="ts" style="font-size: 2.25rem; text-align: center; font-weight: 400">
        Still have question?
      </p>
      <p class="ts" style="font-size: 1.5rem; text-align: center; font-weight: 700">
        We can help you.
      </p>
      <center>  <a href="{{route('shop.about.contact')}}" style="color: #ffffff;background-color: #343c54;border-radius: 50px;font-size: 1rem;padding: 15px 30px 15px 30px;">Contact Us</a></center>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
      <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/52e1dc404c51ab14f6da8c7dda793678153bdee757596c4870267cd6914dc35abf_1280.jpg')}}" width="100%">
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

@endsection()
