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
    @include('shop::about.header')
</div>
<div class="container">
    <div class="row" style="padding-bottom: 20px;">
        @include('shop::about.menu')
        <div class="col-md-3">
            @include('shop::about.sidebar')
        </div>
        <div class="col-md-9 mar_top">
            <center><h1><u>About SafeShop</u></h1></center>
            <img src="{{ asset('themes/velocity/assets/images/static/about_us.png') }}" style="width: 100%; height: 250px;">   
            <p class="just"><br> SafeShop is a Business-to-Business (B2B) and Business-to-Customer (B2C) multivendor E-Commerce Marketplace for the Bangladeshi Businesses and for the retail customers for different products which serves a flawless one stop procurement solutions and new shopping experience.</p>
            <br>
            <hr>    
            <div class="row">   
                <div class="col-md-5">
                    <img src="{{ asset('themes/velocity/assets/images/static/about.png') }}" style="width: 100%; height: 408px;">    
                </div>
                <div class="col-md-7" style="border: 1px solid green;"> 
                    <p class="just">SafeShop has been established with the intention of securing
                    the purchasing triangle of Quality, Cost and Time for you.
                    SafeShop.com.bd will give you an easy solution to compare
                    market price from different qualified suppliers, get quantity
                    discount, special discount and many more facilities. Our main
                    goal is to provide quality and original product to our valuable
                    customers. We have quality products at competitive market
                    prices from lot of qualified vendor’s and ship right to your office
                    or factory or shop or near to your doorstep.</p>    
                </div>
            </div> 
            <br>
            <hr>    
            <div class="row">
                <div class="col-md-12" style="padding-right: 0px">
                    <center><h1><u>Why you buy from SafeShop?</u></h1></center>
                </div>
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            <div class="carousel-item active">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img class="img-fluid" src="{{ asset('themes/velocity/assets/images/static/free.png') }}">
                                           <p style="font-size: : 10px">Feee Delivery</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img class="img-fluid" src="{{ asset('themes/velocity/assets/images/static/24.png') }}">
                                            <p style="font-size: : 10px">24/h Service</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img class="img-fluid" src="{{ asset('themes/velocity/assets/images/static/secured.png') }}">
                                            <p style="font-size: : 10px">Secured Payment</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img class="img-fluid" src="{{ asset('themes/velocity/assets/images/static/exchange.png') }}">
                                            <p style="font-size: : 10px">Easy Exchange</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next bg-dark w-auto" href="#myCarousel" role="button" data-slide="next">
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
                    <center><h1><u>Customers Feedback</u></h1></center>
                </div>
                <div class="col-md-4">
                    <h2>Easy to customize</h2>
                    <p class="just">The product should be sent with original and undamaged manufacturer packaging / box along with original tags, user manual, warranty cards, freebies and accessories. It should be unused, unwashed and without any damages.The product should be sent with original and undamaged manufacturer packaging / box along with original tags, user manual, warranty cards, freebies and accessories. It should be unused, unwashed and without any damages.</p>
                    <p>By <span>Ronald</span> on June 20, 2020</p>
                </div>
                <div class="col-md-4">
                    <h2>Easy to customize</h2>
                    <p class="just">The product should be sent with original and undamaged manufacturer packaging / box along with original tags, user manual, warranty cards, freebies and accessories. It should be unused, unwashed and without any damages.The product should be sent with original and undamaged manufacturer packaging / box along with original tags, user manual, warranty cards, freebies and accessories. It should be unused, unwashed and without any damages.</p>
                    <p>By <span>Ronald</span> on June 20, 2020</p>
                </div>
                <div class="col-md-4">
                    <h2>Easy to customize</h2>
                    <p class="just">The product should be sent with original and undamaged manufacturer packaging / box along with original tags, user manual, warranty cards, freebies and accessories. It should be unused, unwashed and without any damages.The product should be sent with original and undamaged manufacturer packaging / box along with original tags, user manual, warranty cards, freebies and accessories. It should be unused, unwashed and without any damages.</p>
                    <p>By <span>Ronald</span> on June 20, 2020</p>
                </div>
            </div>
            <br>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <center><h1><u>Mission Vision and Values</u></h1></center>
                </div>
                <div class="col-md-6"></div>
                    <img src="{{ asset('themes/velocity/assets/images/static/mission.png') }}" style="width: 100%; height: 250px;">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <img src="{{ asset('themes/velocity/assets/images/static/mission2.png') }}" style="width: 100%; height: 250px;">
                </div>
                <div class="col-md-6">
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
                </div>
                <div class="col-md-6">
                    <h2><i class="fa fa-dot-circle-o" style="color:blue"></i>BUSINESS VALUES</h2>
                    <ul class="fa-ul">
                        <li><i class="fa fa-check-square-o"></i>Customers Focus</li>
                        <li><i class="fa fa-check-square-o"></i>Vendor Focus</li>
                    </ul>
                </div>
            </div>
            <br>
            <hr>
            <div class="row">
                <div class="col-md-12" style="padding-right: 0px">
                    <center><h1><u>Our Brand</u></h1></center>
                </div>
                <div class="col-md-12">
                    <div id="myCarousel2" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            <div class="carousel-item active">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <h1>Demo</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <h1>Demo</h1>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <h1>Demo</h1>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <h1>Demo</h1>
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
            <br>
            <hr>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <center>
                        <p>Thanks for visiting our Website!!</p>
                        <p><a href="#">safeshop.com.bd</a></p>
                    </center>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection()
