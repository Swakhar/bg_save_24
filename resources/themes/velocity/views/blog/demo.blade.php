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
<div class="row">
  div.col-md-3
<div class="navbar-left">
    @include('shop::blog.left-sidebar')
</div>
<div class="container blog-content">
    @include('shop::blog.header')
</div>
</div>
<div class="container blog-content">
    <div class="row">
        
        <div class="col-md-12">
            @foreach($blogs as $blog)   
            <div class="card">
              <div class="card-header" style="background-color: #1749b8;color: bisque;"><p><strong>Topic: {{$blog->headline}}</strong></p></div>
              <div class="card-body">
                @if($blog->image)
                  <img src="http://localhost:8000/cache/medium/blogs/{{$blog->image}}" height="400px" width="100%">
                @endif
                <br>
                {!!$blog->description!!}
                <br>
                @if($blog->video)
                  <iframe src="{{$blog->video}}" name="iframe_a"></iframe>
                @endif
              </div>
              <div class="card-footer">
                Date: {{$blog->created_at}}
              </div>
            </div>
            <br>
            @endforeach
        </div> 
    </div>
</div>
<div class="navbar-right">
    <div class="card">
      <div class="card-header">Latest</div>
      <div class="card-body">
        @foreach($recents as $recent)
          <a href="{{route('shop.about.blog_id',$recent->id)}}" style="color: black">{{$recent->headline}}</a>
          <hr>
        @endforeach
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-header">Search Topic</div>
      <div class="card-body">
        <form method="POST" action="{{ route('shop.about.blog_search') }}" @submit.prevent="onSubmit" >
            @csrf()
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Enter keywords" name="search">
              <div class="input-group-prepend">
                <button style="width: 30px"><i class="fa fa-search"></i></button>
              </div>
            </div>
        </form>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-header">Search Within Date</div>
      <div class="card-body">
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
@endsection()
