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
      <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/14.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-12">
      <p class="htt">
        Refund Policy
        <br>
        <br>
      </p>
      <p class="ts">
        Thanks for shopping at Safeshop.com.bd. If you do not satisfy with the product then please simply return and get refund. Please check our return, refund and cancellation policy. <br>
      </p>
      <p class="ts">
        If you want to refund. Please check whether your product is eligible for a refund. Please keep in mind that the shipping fee & surcharge will be deducted along with the amount paid for your returned product.<br>
      </p>
      <p class="ts">
        After receiving your product by the respective sellers, the seller will inspect the product or shipment and notify you about the refund status of your order (in 2-3 days).<br>
      </p>
      <p class="ts">
        Once the product is eligible for refund a credit will be applied to the payment method used on the original order. In case of Case on Delivery (COD) you will be notify you to share your payment information for the refund.<br>
      </p>
      <p class="ts">
        Please take into account that some credit cards may take an additional 2-10 days for the credit to show on your account so allow as much as 14 days for the credit to be applied.<br>
      </p>
      <p class="ts">
        Please note that refund policy does not apply for any Global products.<br>
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
