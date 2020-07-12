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
<div class="container">
                <!-- crumbs --> 
    <div class="row crumbs">
        <div class="col-md-12" style="font-size: 1.5rem;margin-top: 20px;margin-bottom: 20px;">
            <a href="index-2.html" style="color:white;">Continue Shopping</a> <i class="fa fa-long-arrow-right"></i> Get in touch
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding-bottom: 5px;">
            <center><h1><u>Shipping methods</u></h1>
            <p>The Speed of delivery at your destination depends on shipping service you choose at the checkout page. Please make sure that shipping service is available at the desired destination before you place your order. Since we can process one shipping address per order. If you wish to receive the same order in different location then you have to place separate orders and separate payments.
            </p>
            <br>
            <ul class="fa-ul">
                <li><i class="fa fa-truck"></i> Standard shipping: Delivery within 2-3 business days</li>
                <li><i class="fa fa-ship"></i> Express shipping:   Delivery within 1 business days
                </li>
                <li><i class="fa fa-plane"></i> International shipping: Not available currently</li>
            </ul>
            <br>
            <br>
        </div>
    </div> 
</div>
@endsection()
