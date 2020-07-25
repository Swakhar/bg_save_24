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
            <center>
                <h1>Contact Us</h1>
                <p>Please contact with us in case of your need</p>
            </center>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <div><i class="footer_i fa fa-map-marker"></i></div>
                                        <span><p style="font-size: 16px;"><strong>ADDRESS</strong></p><p style="font-size: 12px;"> No 40 Baria Sreet 133/2 NewYork City, NY, United States</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <div><i class="footer_i fa fa-phone"></i></div>
                                        <span><p style="font-size: 16px;"><strong>CALL US</strong></p>
                                        <p style="font-size: 12px;">(+880) 123456789</p>
                                        <p style="font-size: 12px;">(+880) 123456789</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <div><i class="footer_i fa fa-envelope"></i></div>
                                        <span><p style="font-size: 16px;"><strong>EMAIL US</strong></p><p style="font-size: 12px;">example@gmail.com</p>
                                        <p style="font-size: 12px;">info@gmail.com</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <div><i class="footer_i fa fa-map-marker"></i></div>
                                        <span><p style="font-size: 16px;"><strong>WORKING HOURS</strong></p><p style="font-size: 12px;"> Sat-Thu: 9AM to 5PM</p>
                                        <p style="font-size: 12px;"> Friday: 9AM to 1PM</p>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('contact.message') }}" @submit.prevent="onSubmit" >
                                @csrf()
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="name">Your Name:</label>
                                          <input type="text" class="form-control" id="text" placeholder="Enter Name" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <br>
    </div>
</div>

@endsection()
