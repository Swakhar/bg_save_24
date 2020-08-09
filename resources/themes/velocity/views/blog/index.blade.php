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
    
  <div class="row"> 
      @include('shop::blog.menu')
      @include('shop::blog.left-sidebar') 
      @include('shop::blog.right-sidebar-hidden')
      <div class="col-md-7 mar_left mar_top">
        @include('shop::blog.header')
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
      @include('shop::blog.right-sidebar')
  </div>
</div>
@endsection()
