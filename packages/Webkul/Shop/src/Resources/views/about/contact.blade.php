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
      <img src="/themes/velocity/assets/images/static/2.png" width="100%" height="200">
    </div>
    <div class="col-md-12">
      <h2 class="htt">
        CONTACT US
      </h2>
      <div style="width: 235px;border-color: #ff5500;border-width: 2px;border-style: solid;"></div>
    </div>
    <div class="col-md-3">
      <center><img src="/themes/velocity/assets/images/static/add.png" width="100%" height="100px"></center>
      <h6 style="color: #343c54;text-align: center; font-weight: 700">ADDRESS</h6>
      <p style="color: #343c54;text-align: center;">31 Issha Khan Road, 1400 Narayanganj, Dhaka</p>
    </div>
    <div class="col-md-3">
      <center>  <img src="/themes/velocity/assets/images/static/pn.png" width="100%" height="100px"></center>
      <h6 style="color: #343c54;text-align: center; font-weight: 700">PHONE NUMBER</h6>
      <p style="color: #343c54;text-align: center;">
      +880 1712-492624</p>
    </div>
    <div class="col-md-3">
      <center><img src="/themes/velocity/assets/images/static/op.png" width="100%" height="100px"></center>
      <h6 style="color: #343c54;text-align: center; font-weight: 700">WE ARE OPEN</h6>
      <p style="color: #343c54;text-align: center;">Saterday to Thursday 9:00 AM- 5:00 PM</p>
    </div>
    <div class="col-md-3">
      <center><img src="/themes/velocity/assets/images/static/em.png" width="100%" height="100px"></center>
      <h6 style="color: #343c54;text-align: center; font-weight: 700">E-MAIL</h6>
      <p style="color: #343c54;text-align: center;">official@safeshop.com.bd</p>
    </div>
    
    <div class="col-md-12">
      <p class="ts" style="font-weight: 900;font-size: 2.25rem;">
        SEND US MESSAGE
      </p>
      <p class="ts" style="color: #343c54;font-size: 1.25">
        Please contact with us in case of your need and we’ll get back to you as quickly as possible.
      </p>
    </div>
    <div class="col-md-12" style="margin-bottom: 50px">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('contact.message') }}" @submit.prevent="onSubmit" >
                                @csrf()
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="name">Your Name:</label>
                                          <input type="text" class="form-control" id="text" placeholder="Enter Name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="email">Your Email:</label>
                                          <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="subject">Subject:</label>
                                          <input type="text" class="form-control" id="subject" placeholder="Enter Subject" name="subject">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="message">Message:</label>
                                          <textarea class="form-control" rows="5" id="message" name="message"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <center><button type="submit" class="btn btn-primary">Submit</button></center>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
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
