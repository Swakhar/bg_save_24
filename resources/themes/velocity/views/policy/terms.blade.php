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
            <center><h1><u>Privacy Policy</u></h1></center>
            <p class="just">The customer have 3 days to return an item from the date they received the product. The Grocery items will not be covered under return policy.Please note that return policy does not apply for any Global products</p>
            <div class="row">   
                <div class="col-md-12">
                    <h2>Condition to return an item</h2>  
                    <p>If Delivered Product is</p> 
                    <ol class="ol">
                        <li>Broken or </li>
                        <li>Incomplete or </li>
                        <li>Incorrect (presentation different on website).</li>
                    </ol>         
                </div>
                <div class="col-md-12">
                    <h2>Returns accept Conditions</h2>
                    <ol class="ol">
                        <li class="just">The product should be sent with original and undamaged manufacturer packaging / box along with original tags, user manual, warranty cards, freebies and accessories. It should be unused, unwashed and without any damages.</li></br>
                        <li class="just">If the product was delivered in a two layers of packaging, it must be returned in the same condition with return shipping label attached. Do not put tape or stickers on the manufacturer’s box.</li>
                    </ol>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()
