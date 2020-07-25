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
    @include('shop::policy.header')
</div>
<div class="container">
    <div class="row" style="padding-bottom: 20px;"> 
        @include('shop::about.menu')
        <div class="col-md-3">
            @include('shop::policy.sidebar')
        </div> 
        <div class="col-md-9 mar_top">
            <center><h1><u>Refund Policy</u></h1></center>
            <p class="just">If you want to refund. Please check whether your product is eligible for a refund. Please keep in mind that the shipping fee & surcharge will be deducted along with the amount paid for your returned product.</p>
            <p class="just">After receiving your product by the respective sellers, the seller will inspect the product or shipment and notify you about the refund status of your order (in 2-3 days).</p>
            <p class="just">Once the product is eligible for refund a credit will be applied to the payment method used on the original order. In case of Case on Delivery (COD) you will be notify you to share your payment information for the refund.</p>
            <p class="just">Please take into account that some credit cards may take an additional 2-10 days for the credit to show on your account so allow as much as 14 days for the credit to be applied.</p>
            <p class="just"><strong>Please note that refund policy does not apply for any Global products.</strong></p>
            <br>
        </div>
        
    </div>
</div>

@endsection()
