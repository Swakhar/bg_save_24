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
      <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/10.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-12">
      <p class="ts" style="font-size: 1.5">To track your order please enter your Order Id in the box and press the "Track" button. This was given to you on your receipt and in the confirmation email or SMS you should have received.
      </p>
    </div>

    <div class="col-md-6" style="padding-bottom: 50px">
      <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/truck.png')}}" width="100%">
    </div>
    <div class="col-md-6">
      <form method="POST" action="{{ route('contact.message') }}" @submit.prevent="onSubmit" >
                                @csrf()
                                <div class="row">
                                    <div class="col-md-12" style="padding-top: 50px">
                                        <div class="form-group">
                                          <label for="name">Tracking or Shipment Number</label>
                                          <input type="text" class="form-control" id="text" placeholder="Enter Tracking or Shipment Number" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="email">Registred Email address</label>
                                          <input type="email" class="form-control" id="email" placeholder="Enter Registred Email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <center><button type="submit" class="btn btn-primary">Track</button></center>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </form>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3" style="padding-bottom: 50px;">
      <p class="ts" style="font-size: 2.25rem; text-align: center; font-weight: 400">
        Still have question?
      </p>
      <p class="ts" style="font-size: 1.5rem; text-align: center; font-weight: 700">
        We can help you.
      </p>
      <center>  <a href="{{route('shop.about.contact')}}" style="color: #ffffff;background-color: #343c54;border-radius: 50px;font-size: 1rem;padding: 15px 30px 15px 30px;">Contact Us</a></center>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
      <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/52e1dc404c51ab14f6da8c7dda793678153bdee757596c4870267cd6914dc35abf_1280.jpg')}}" width="100%">
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

@endsection()
