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
    @include('shop::support.header')
</div>
<div class="container">
    <center><h1><u>Track Your Order</u></h1></center>   
    <br>
    <div class="row">   
        <div class="col-md-6">  
            <img src="{{ asset('themes/velocity/assets/images/static/track.png') }}" style="width: 100%; height: 250px;">
        </div>
        <div class="col-md-6" style="border: 1px solid green;"> 
            <p class="just">To track your order please enter your Order Id in the box and press the "Track" button. This was given to you on your receipt and in the confirmation email or SMS you should have received.</p>
            <div class="row">
                <form method="POST" action="{{ route('shop.support.track') }}" @submit.prevent="onSubmit" > 
                    <div class="col-md-12">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Enter Tracking Number" name="track">
                          <div class="input-group-prepend">
                            <button class="btn btn-lg btn-info"style="padding: 0;width: 70px;">Track</button>
                          </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div> 
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="media border p-3">
                <div class="media-body">
                  <h1><strong>Still have question?</strong></h1>
                  <h3>We can help you.</h3>
                  <div class="col-md-12 btn btn-lg sidebar"><a href="{{ route('shop.about.contact') }}">Contact Us</a></div>     
                </div>
                <img src="{{ asset('themes/velocity/assets/images/static/question.png') }}" class="ml-3 mt-3" style=" height: 200px;width: 200px;">
            </div>
        </div>
    </div> 
</div>

@endsection()
