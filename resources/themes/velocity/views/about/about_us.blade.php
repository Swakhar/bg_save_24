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

    <div class="row crumbs">
        <div class="col-md-12" style="font-size: 1.5rem;margin-top: 20px;margin-bottom: 20px;">
            <a href="index-2.html" style="color:white;">Continue Shopping</a> <i class="fa fa-long-arrow-right"></i> Get in touch
        </div>

    </div>
    <div><hr></div>
    <div class="row">
        <div class="col-md-2">
            <div class="card bg-primary" style="height: 500px">
                <div class="card-body text-center">
                    <p class="card-text">Advertisement 1</p>
                </div>
            </div>
        </div>  
        <div class="col-md-8" style="padding-bottom: 5px;">
            <div class="about">
                <h1> About SafeShop</h1>
            </div>
            <ul class="fa-ul">
                <li>
                    <h2><i class="fa fa-dot-circle-o" style="color:blue"></i> About US</h2>
                    <p class="just">SafeShop is the Business-to-Business (B2B) and Business-to-Customer (B2C) multivendor E-Commerce Marketplace for the Bangladeshi Businesses and for the retail customers for different products which serves a flawless one stop procurement solutions and new shopping experience. SafeShop has been established with the intention of securing the purchasing triangle of Quality, Cost and Time for you.</p>
                    <center><img src="{{ asset('themes/velocity/assets/images/static/about.png') }}" alt="" height="200px" width="75%"></center><br>
                    <p class="just">SafeShop.com.bd will give you an easy solution to compare market price from different qualified suppliers, get quantity discount, special discount and many more facilities. Our main goal is to provide quality and original product to our valuable customers. We have quality products at competitive market prices from lot of qualified vendor’s and ship right to your office or factory or shop or near to your doorstep.</p>
                    <p>Founded in 2020, the company’s mission is ‘<strong>SAVE Money, SAVE Time</strong>’ and with a slogan ‘<strong>check buy & save</strong>’.</p>
                </li>
                <br><hr>        
                <li> 
                    <h2><i class="fa fa-dot-circle-o" style="color:blue"></i>  Why SafeShop?</h2>
                    <ul class="fa-ul">
                        <li><i class="fa fa-hand-o-right"></i>Safe and secure</li>
                        <li><i class="fa fa-hand-o-right"></i>Brand of Trust</li>
                        <li><i class="fa fa-hand-o-right"></i>Low price </li>
                        <li><i class="fa fa-hand-o-right"></i>100% genuine product</li>
                        <li><i class="fa fa-hand-o-right"></i>Trusted platform</li>
                        <li><i class="fa fa-hand-o-right"></i>Speedy delivery</li>
                    </ul>   
                </li>
                <br><hr>                        
                <li>    
                    <h2><i class="fa fa-dot-circle-o" style="color:blue"></i> What can we do for you ?</h2>
                    <ul class="fa-ul">
                        <li><i class="fa fa-handshake-o"></i>Support 24/7</li>
                        <li><i class="fa fa-handshake-o"></i>Best Quality</li>
                        <li><i class="fa fa-handshake-o"></i>Fastest Delivery </li>
                        <li><i class="fa fa-handshake-o"></i>Customer Care</li>
                    </ul>
                </li>
                <br><hr>        
                <li>    
                    <h2><i class="fa fa-dot-circle-o" style="color:blue"></i> Core Values</h2>
                    <ul class="fa-ul">
                        <li><i class="fa fa-check-square-o"></i>Team Work</li>
                        <li><i class="fa fa-check-square-o"></i>Customer focus and Customer Service</li>
                        <li><i class="fa fa-check-square-o"></i>Goal Oriented </li>
                        <li><i class="fa fa-check-square-o"></i>Trust</li>
                        <li><i class="fa fa-check-square-o"></i>Responsibility</li>
                        <li><i class="fa fa-check-square-o"></i>Integrity</li>
                        <li><i class="fa fa-check-square-o"></i>Transparency</li>
                    </ul>
                </li>
                <br><hr>        
                <li>  
                    <h2><i class="fa fa-dot-circle-o" style="color:blue"></i>BUSINESS VALUES</h2>
                    <ul class="fa-ul">
                        <li><i class="fa fa-check-square-o"></i>Customers Focus</li>
                        <li><i class="fa fa-check-square-o"></i>Vendor Focus</li>
                    </ul>  
                </li>
                <br><hr>        
            </ul>
        </div>
        <div class="col-md-2">
            <div class="card bg-primary">
                <div class="card-body text-center" style="height: 500px">
                    <p class="card-text">Advertisement2</p>
                </div>
            </div>
        </div>
    </div>  
@endsection()
