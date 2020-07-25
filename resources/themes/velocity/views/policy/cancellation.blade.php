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
            <center><h1><u>Order Cancellation</u></h1></center>
            <br>
            <br>
            <br>
            <p class="just">No cancellations shall be permissible after the product is dispatched from the sellers.</p>
            <br>
            <br>
            <br>
        </div>
        
    </div>
</div>

@endsection()
