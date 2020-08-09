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
    @include('shop::support.header')
</div>
<div class="container">
    <div class="row" style="padding-bottom: 20px;"> 
        @include('shop::about.menu') 
        <div class="col-md-3">
            @include('shop::support.sidebar')
        </div> 
        <div class="col-md-9 mar_top">
            <center><h1><u>Shipping Methods</u></h1></center>   
            <br>
            <div class="row">   
                <div class="col-md-6">  
                    <img src="{{ asset('themes/velocity/assets/images/static/shipping.png') }}" style="width: 100%; height: 250px;">
                </div>
                <div class="col-md-6" style="border: 1px solid green;"> 
                     <p class="just">The Speed of delivery at your destination depends on shipping service you choose at the checkout page. Please make sure that shipping service is available at the desired destination before you place your order. Since we can process one shipping address per order. If you wish to receive the same order in different location then you have to place separate orders and separate payments.</p>   
                </div>
            </div> 
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <center>
                        <p><strong>Standard Shipping</strong></p>
                        <img src="{{ asset('themes/velocity/assets/images/static/standard.png') }}" style="width: 100%; height: 250px;">
                        <p>Delivery within 2-3 business days</p>
                    </center>
                </div>
                <div class="col-md-4">
                    <center>
                        <p><strong>Express Shipping</strong></p>
                        <img src="{{ asset('themes/velocity/assets/images/static/express.png') }}" style="width: 100%; height: 250px;">
                        <p>Delivery within 1 business days</p>
                    </center>
                </div>
                <div class="col-md-4">
                    <center>
                        <p><strong>International Shipping</strong></p>
                        <img src="{{ asset('themes/velocity/assets/images/static/international.png') }}" style="width: 100%; height: 250px;">
                        <p>Currently Not available </p>
                    </center>
                </div>    
            </div>    
        </div>
        
    </div>
</div>

@endsection()
