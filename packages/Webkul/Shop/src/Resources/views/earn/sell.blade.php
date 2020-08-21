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
      <img src="/themes/velocity/assets/images/static/18.png" width="100%" height="200">
    </div>
    <div class="col-md-8">
      <h1 class="htt" style="font-size: 3.75rem">
        SELL ON SAFESHOP
      </h1>
      <p class="ts">
        Open your online store now
      </p>
    </div>
    <div class="col-md-4" style="margin-top: 40px">
      <a href="" style="text-transform: uppercase;
    font-weight: 700;
    border-style: none;
    font-size: 1.875rem;
    padding: 22px 25px 22px 24px;background-color: #343c54;">Start Selling</a>
    </div>
    <div class="col-md-12">
      <br><br><br><br>
      <center>
        <p class="ts" style="font-size: 1.875rem">BECOME A SELLER 3 EASY STEP</p>
        <p class="ts">Follow the below steps</p>
      </center>
    </div>
    <div class="col-md-6">
      <img src="/themes/velocity/assets/images/static/s1.png" width="100%" height="170">
      <center><p class="htt" style="font-size: 1.5rem">
        Seller Registration
      </p></center>
      <p class="ts" style="font-size: 1.25rem">-Complete your seller registration Process</p>
      <p class="ts" style="font-size: 1.25rem">-Login your Safeshop seller account</p>
      <p class="ts" style="font-size: 1.25rem">-List your products with all informations</p>
    </div>
    <div class="col-md-6">
      <img src="/themes/velocity/assets/images/static/s2.png" width="100%" height="170">
      <center><p class="htt" style="font-size: 1.5rem">
        Order Receieve and Start Selling
      </p></center>
      <p class="ts" style="font-size: 1.25rem">-Complete Product listing and Start your selling </p>
      <p class="ts" style="font-size: 1.25rem">-For all you need, use your Safeshop seller panel</p>
      <p class="ts" style="font-size: 1.25rem">-Manage your order, shipment etc. from your seller panel</p>
    </div>
    <div class="col-md-6" style="padding-top: 70px">
      <a href="" style="text-transform: uppercase;
    font-weight: 700;
    border-style: none;
    font-size: 1.875rem;
    margin: -66px 120px 0 auto;
    padding: 22px 25px 22px 24px;background-color: #343c54;">Start Selling</a>
    <h1 class="htt" style="font-size:1.875rem; margin-left: 20px;">SELL ON SAFESHOP</h1>
    </div>
    <div class="col-md-6">
      <img src="/themes/velocity/assets/images/static/s3.png" width="100%" height="170">
      <center><p class="htt" style="font-size: 1.5rem">Receieve Payment and Grow Business</p></center>
      <p class="ts">-Receieve payment at your account timely</p>
      <p class="ts">-Grow your business with safeshop </p>
    </div>
    
    <div class="col-md-12">
     <p class="htt" style="font-size: 2.25rem">
       <b>SafeShop Seller Features and Facilities
        </b>
     </p>
     <p class="ts">
       Safeshop vendor registration process is ongoing. You can contact with us and get lot of exciting offeres & facilities and start to sell your products/ Services and grow your business with safeshop. To start your 100% transparent, sequire & reliable business at Safeshop marketplace, you can contact directly and boost your business.We believe honesty is main key to maintain our business relationship. For maintaining long term business relationship & satisify our Lawal B2B & B2C customers all around Bangladesh, Safeshop Bangladesh Ltd. (safeshop.com.bd) is the one stop marketplace. Safeshop Features and Benifits for Official Vendors-
     </p>
    </div>
    <div class="col-md-6" style="padding-bottom: 30px">
      <img src="/themes/velocity/assets/images/static/57e7d5454b52af14f6da8c7dda793678153bdee757596c4870267cd6914dc459b0_1280.png" width="100%">
    </div>
    <div class="col-md-6">
      <ul class="ts">
        <li><i></i>Minimum cost for your business  </li>
        <li><i></i>Quick and timely payment</li>
        <li><i></i>100% Transparent, sequire & reliable marketplace</li>
        <li><i></i>No initial registration fees</li>
        <li><i></i>Reliable and friendly vendor support </li>
        <li><i></i>B2B & B2C marketplace</li>
        <li><i></i>No hidden charges</li>
        <li><i></i>Sell accross Bangladesh</li>
        <li><i></i>Easy and First Shipping</li>
        <li><i></i>Vendor training</li>
      </ul>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/lc.png" width="100%" height="100px">
      <center><p class="ts">Low Cost</p></center>
    </div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/tp.png" width="100%" height="100px">
      <center><p class="ts">Timely Payment</p></center>
    </div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/trp.png" width="100%" height="100px">
      <center><p class="ts">Transparent</p></center>
    </div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/nr.png" width="100%" height="100px">
      <center><p class="ts">No Registration Fees</p></center>
    </div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/vs.png" width="100%" height="100px">
      <center><p class="ts">Vendor Support</p></center>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/b2b.png" width="100%" height="100px">
      <center><p class="ts">B2B & B2C</p></center>
    </div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/nh.png" width="100%" height="100px">
      <center><p class="ts">No Hidden Charges</p></center>
    </div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/ab.png" width="100%" height="100px">
      <center><p class="ts">Sell Accross Bangladesh</p></center>
    </div>
    <div class="col-md-2">
      <img src="/themes/velocity/assets/images/static/ess.png" width="100%" height="100px">
      <center><p class="ts">Easy  Shipping</p></center>
    </div>
    <div class="col-md-2" style="padding-bottom: 40px">
      <img src="/themes/velocity/assets/images/static/vt.png" width="100%" height="100px">
      <center><p class="ts">Vendor Training</p></center>
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
      <img src="/themes/velocity/assets/images/static/52e1dc404c51ab14f6da8c7dda793678153bdee757596c4870267cd6914dc35abf_1280.jpg" width="100%">
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-12" style="padding-bottom: 20px">
      <h2 style="font-weight: 700;color: #ff5500;">Our Brands
        </h2>
      <div style="width: 200px;border-color: #ff5500;border-width: 2px;border-style: solid;"></div>
    </div>
    <div class="col-md-12" style="padding-bottom: 50px">
                    <div id="myCarousel2" class="carousel slide w-100" data-ride="carousel">
                        <div class="carousel-inner w-100" role="listbox">
                            <div class="carousel-item active">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="col-lg-2 col-md-6">
                                    <div class="card" style="margin-top: 10px">
                                        <div class="card-body">
                                           <img src="/themes/velocity/assets/images/static/lg.png" width="100%" height="100px">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next bg-dark w-auto" href="#myCarousel2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
  </div>
</div>

@endsection()
