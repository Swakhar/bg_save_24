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
      <img src="/themes/velocity/assets/images/static/7.png" width="100%" height="200">
    </div>
    <div class="col-md-12">
      <p class="ts" style="font-size: 1.5">The Speed of delivery at your destination depends on shipping service you choose at the checkout page. Please make sure that shipping service is available at the desired destination before you place your order. Since we can process one shipping address per order. If you wish to receive the same order in different location then you have to place separate orders and separate payments.
      </p>
    </div>
    
    <div class="col-md-3"></div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/sh.png">
    </div>
    <div class="col-md-7">
      <p class="htt">
        Standard Shipping
      </p>
      <p class="ts">
        Delivery within 2-3 business days
      </p>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/es.png">
    </div>
    <div class="col-md-7">
      <p class="htt">
        Express Shipping
      </p>
      <p class="ts">
        Delivery within 1 business days
      </p>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/is.png">
    </div>
    <div class="col-md-7">
      <p class="htt">
        International Shipping
      </p>
      <p class="ts">
        Currently Not available
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
      <img src="/themes/velocity/assets/images/static/52e1dc404c51ab14f6da8c7dda793678153bdee757596c4870267cd6914dc35abf_1280.jpg" width="100%">
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

@endsection()
