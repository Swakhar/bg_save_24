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
        <div class="col-md-12">
            <div class="track" style="padding-bottom: 5px;">
                <div class="row track_input">
                    <form>
                        <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="track" placeholder="Enter Tracking Number" class="tr_in"><button class="tr_btn">Enter</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection()
