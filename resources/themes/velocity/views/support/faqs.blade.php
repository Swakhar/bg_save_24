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
    @include('shop::support.header')
</div>
<div class="container">
    <div class="row" style="padding-bottom: 20px;"> 
        @include('shop::about.menu') 
        <div class="col-md-3">
            @include('shop::support.sidebar')
        </div> 
        <div class="col-md-9 mar_top">
            <center><h1><u>FAQs</u></h1></center>   
            <br>
            <div class="row">
                <div class="col-md-12"> 
                    <button class="accordion"><i class="fa fa-plus"></i>How can I check my order status?</button>
                    <div class="panel">
                        <p class="just">You can check the status of your order by clicking "Track Order" below.</p>
                        <div class="btn btn-large btn-primary"><a href="" style="color:white;">Track Order</a></div>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>How can I return/replace an item?</button>
                    <div class="panel">
                        <p class="just">Click on "Return/Replace" below and select the reason to initiate return or replacement of your item. Our courier partner will pick it up from your place. Do keep the product tags and packaging intact. You can return/replace an item within 3 days of delivery. <a href="">Click here</a> to read our 3 days Easy Return policy.</p>
                        <div class="btn btn-large btn-primary" ><a href="" style="color:white;">Return Order</a></div>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>What are the different modes of payment available?</button>
                    <div class="panel">
                        <p class="just">We are processing the payment method through our payment getaway partner. You can use any one of the following payment methods through our payment getaway partner:</p>
                        <ul class="fa-ul">
                            <li><i class="fa fa-credit-card"></i> Credit card</li>
                            <li><i class="fa fa-credit-card"></i> Credit card EMI of leading banks</li>
                            <li><i class="fa fa-cc-visa"></i> Debit card</li>
                            <li><img src="{{ asset('themes/velocity/assets/images/static/COD.png') }}"></i> Cash on Delivery</li>
                            <li><img src="{{ asset('themes/velocity/assets/images/static/bkash.png') }}"> Bkash</li>
                            <li><i class="fa fa-paper-plane"></i> Rocket etc.</li>
                        </ul>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>What are the different modes of shipping method available?</button>
                    <div class="panel">
                        <p class="just">We are processing the shipping method through our shipping partner. You can use any one of the following shipping method through our shipping partner:</p>
                        <ul class="fa-ul">
                            <li><i class="fa fa-truck"></i> Standard Delivery</li>
                            <li><i class="fa fa-ship"></i> Express Delivery</li>
                            <li><i class="fa fa-handshake-o"></i> Cash on Delivery</li>
                        </ul>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i> I have received a call/SMS/email asking for money</button>
                    <div class="panel">
                        <p class="just">Beware: We NEVER request our customers for unsolicited financial information or advance payments in exchange of rewards. All our offers are available ONLY on our website and app. Please DO NOT respond to any Phone call/Email/SMS claiming to offer rewards/lucky draw prizes on behalf of SafeShop</p>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>How can I cancel my order?</button>
                    <div class="panel">
                        <p class="just">Go to <a href="">My Orders</a> and tap on order you wish to cancel. Click on <a href="">CANCEL</a></p>
                        <p class="just">Cancellation is not allowed if the order has been shipped.</p>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>When can I expect refund for my returned item?</button>
                    <div class="panel">
                        <p class="just">Once we receive the original item, we will do quality check. Please check our <a href="">return and refund</a> policy. We will also keep you updated on email and SMS.</p>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>I don't remember my password. Help!</button>
                    <div class="panel">
                        <p class="just">Don't worry! You can always login using your registered email ID or mobile number.</p>
                        <p class="just">Please click the link <a href="">forgot password</a> and follow the step.</p>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>How to raise query/complaint?</button>
                    <div class="panel">
                        <p class="just">For any type of query/complaint please click the link <a href="">Contact us</a> and send us email. We will take care of your query/complaint and solve the issue as soon as possible.</p>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>I want to sell my items on SafeShop. Who do I get in touch with?</button>
                    <div class="panel">
                        <p class="just">Go to our website and click on <a href="">Seller Account</a>. Fill in your details and we'll get in touch with you.</p>
                        <p> <a href="">Click here</a> to know more.</p>
                    </div>
                    <button class="accordion"><i class="fa fa-plus"></i>Why do i need to pat VAT(Value Added Tax) on products purchased through E-Commerce?</button>
                    <div class="panel">
                        <p class="just">As per the recent circular given by National Board Of Revenue (NBR), Bangladesh, SafeShop is required to collect applicable VAT from customers, for selling products through E-Commerce channel as VAT exemption on online shopping is only applicable for those companies which do not have physical outlets.</p>
                        <p>The rate of VAT is <strong>7.5 %</strong>.</p></br>
                    </div>
                </div> 
            </div>
        </div>
    </div> 
</div>

@endsection()
