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
                <h1>Career</h1>
            </center>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <p>Welcome to career portal of SafeShop.com.bd!!</p>
                    <p>If you are interested to start your career with us, please send us your current CV at our email!!</p>
                    <br>    
                </div>
                <div class="col-md-12">   
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('shop.about.career.save') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">
                            @csrf()
                            <div class="col-md-12">
                                <div class="form-group">
                                          <label for="name">Your Email:</label>
                                          <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                          <label for="name">Your Phone No:</label>
                                          <input type="text" class="form-control" id="phone" placeholder="Enter Phone No" name="phone">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                          <label for="name">Your CV(.pdf):</label>
                                          <input type="file" class="form-control-file border" name="cv">
                                </div>
                            </div>
                            <div class="col-md-4">    </div>
                            <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <br>
    </div>
</div>

@endsection()
