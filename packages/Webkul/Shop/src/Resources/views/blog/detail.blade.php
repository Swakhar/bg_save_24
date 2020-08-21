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
      <img src="/themes/velocity/assets/images/static/4.png" width="100%" height="200">
    </div>
    <div class="col-md-8  mar_top">
        @foreach($blogs as $blog)   
            <div class="card">
              <div class="card-header">
                @if($blog->image)
                  <img src="/cache/medium/blogs/{{$blog->image}}" height="400px" width="100%">
                @endif
              </div>
              <div class="card-body">
                <p><strong>{{$blog->headline}}</strong></p>
                <p style="color: #039ee3;"><i class="fa fa-calendar" aria-hidden="true"></i> {{$blog->created_at}}</p>
                <br>
                <div>{!!$blog->description!!}</div>
                <br>
                @if($blog->video)
                  <iframe src="{{$blog->video}}" name="iframe_a"></iframe>
                @endif
              </div>
              <div class="card-footer">
                <a class="btn btn-lg btn-info" href="{{route('shop.about.blog_id',$blog->id)}}">Read More<i class="fa fa-angle-right"></i></a>
              </div>
            </div>
            <br>
            @endforeach
      </div>
      <div class="col-md-4" style="padding-top: 50px">
        <div class="row">
          <div class="col-md-12">
            <form method="POST" action="{{ route('shop.about.blog_search') }}" @submit.prevent="onSubmit" >
                @csrf()
                <div class="input-group" style="background: #f8f8f8;width: 100%;border-radius: 50px;height: 50px;">
                  <input type="text" class="form-control" placeholder="Enter keywords" name="search" style="height: 50px;">
                  <div class="input-group-prepend">
                    <button style="width: 30px"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </form>
          </div>
          <div class="col-md-12">
            <h4>Recent Post</h4>
            @foreach($recents as $recent)
              <a href="{{route('shop.about.blog_id',$recent->id)}}" style="color: black">{{$recent->headline}}</a>
              <p style="color: #707070;"><i class="fa fa-calendar" aria-hidden="true"></i> {{$blog->created_at}}</p>
              <hr>
            @endforeach
          </div>
          <div class="col-md-12">
            <h4>Search Post Within Date</h4>
            <form method="POST" action="{{ route('shop.about.blog_date') }}" @submit.prevent="onSubmit" >
                @csrf()
                <div class="form-group">
                  From<input type="date" class="form-control-file border" name="from" required>
                </div>
                <div class="form-group">
                  To<input type="date" class="form-control-file border" name="to" required>
                </div>
                <center>
                  <button class="btn btn-primary btn-sm" type="submit">Search</button>
                </center>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>

@endsection()

