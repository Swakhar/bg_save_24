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
      <img src="/themes/velocity/assets/images/static/3.png" width="100%" height="200">
    </div>
    <div class="col-md-8">
      <p class="ts" style="font-size: 1.5">Welcome to career portal of SafeShop Bangladesh Ltd.
      </p>
      <p class="ts" style="font-size: 1.5">If you are interested to start your career with us, please send us your current CV at our email!
      </p>
    </div>
    
    <div class="col-md-8" style="margin-bottom: 50px;">
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
                            <div class="col-md-12">
                                    <center><button type="submit" class="btn btn-primary">Submit</button></center>
                            </div>
                        </form>
                    </div>
    <div class="col-md-4">
      <img src="/themes/velocity/assets/images/static/5ee6dc404252b108f5d084609629317e113fdce15b4c704c7c2879d19148c651_1280.jpg" width="100%">
    </div>
  </div>
</div>

@endsection()
