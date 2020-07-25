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
            <center><h1><u>Payment Methods</u></h1></center>   
            <p class="just"><br> We accept most major payment methods that are available in Bangladesh. SafeShop.com will never save your payment information. Therefore, there is no risk at all when you shop on our website. As we are committed to provide you with the best experience on our site, if you think your choice of payment method is missing on our site, please let us know and we will accommodate accordingly. Below is a list of currently accepted methods of payments.</p>
            <br>
            <div class="row"> 
                <div class="col-md-12"> 
                    <div id="myCarousel3" class="carousel slide w-100" data-ride="carousel">
                            <div class="carousel-inner w-100" role="listbox">
                                <div class="carousel-item active">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card" style="margin-top: 10px">
                                            <div class="card-body">
                                               <img class="img-fluid" src="{{ asset('themes/velocity/assets/images/static/payments/ab.png') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card" style="margin-top: 10px">
                                            <div class="card-body">
                                               <img class="img-fluid" src="{{ asset('themes/velocity/assets/images/static/payments/asia.png') }}">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card" style="margin-top: 10px">
                                            <div class="card-body">
                                               <img class="img-fluid" src="{{ asset('themes/velocity/assets/images/static/payments/brac.png') }}">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card" style="margin-top: 10px">
                                            <div class="card-body">
                                               <img class="img-fluid" src="{{ asset('themes/velocity/assets/images/static/payments/master.png') }}">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel3" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next bg-dark w-auto" href="#myCarousel3" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
            </div>
            <br> 
            <hr>
            <div class="row">
                <div class="col-md-12">  
                    <center><h1><u>Cash on Delivery</u></h1></center>
                    <p class="just"><img src="{{ asset('themes/velocity/assets/images/static/payments/cod.png') }}" style="width: 100%; height: 250px;">Cash on delivery is available for deliveries within Bangladesh only</p> 
                    <img src="{{ asset('themes/velocity/assets/images/static/logo_slogan.png') }}" style="width: 100%; height: 250px;">
                    <img src="{{ asset('themes/velocity/assets/images/static/ssl.png') }}" style="width: 100%; height: 250px;">
                </div>
            </div>    
        </div>
        
    </div>
</div>

@endsection()
