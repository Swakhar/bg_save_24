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
        <div class="col-md-12" style="padding-bottom: 5px;">
            <center><h1><u>Top FAQs</u></h1></center>
        </div>
        <div class="col-md-12">
            <h2><i class="fa fa-quora"></i>1. How can I check my order status?</h2>
            <p>You can check the status of your order by clicking "Track Order" below.</p>
            <div class="btn btn-large btn-primary"><a href="" style="color:white;">Track Order</a></div>
        </div>
        <div class="col-md-12">
            <h2><i class="fa fa-quora"></i>2. How can I return/replace an item?</h2>
            <p>Click on "Return/Replace" below and select the reason to initiate return or replacement of your item. Our courier partner will pick it up from your place. Do keep the product tags and packaging intact.
            You can return/replace an item within 3 days of delivery. <a href="">Click here</a> to read our 3 days Easy Return policy.</p>
            <div class="btn btn-large btn-primary" ><a href="" style="color:white;">Return Order</a></div>
        </div>
        <div class="col-md-12">
            <h2><i class="fa fa-quora"></i>3. What are the different modes of payment available?</h2>
            <p>We are processing the payment method through our payment getaway partner. You can use any one of the following payment methods through our payment getaway partner:</p>
            <ul class="fa-ul">
                <li><i class="fa fa-credit-card"></i> Credit card</li>
                <li><i class="fa fa-credit-card"></i> Credit card EMI of leading banks</li>
                <li><i class="fa fa-cc-visa"></i> Debit card</li>
                <li><img src="{{ asset('themes/velocity/assets/images/static/COD.png') }}"></i> Cash on Delivery</li>
                <li><img src="{{ asset('themes/velocity/assets/images/static/bkash.png') }}"> Bkash</li>
                <li><i class="fa fa-paper-plane"></i> Rocket etc.</li>
            </ul>
        </div>
        <div class="col-md-12">
            <h2><i class="fa fa-quora"></i>4. What are the different modes of shipping method available?</h2>
            <p>We are processing the shipping method through our shipping partner. You can use any one of the following shipping method through our shipping partner:</p>
            <ul class="fa-ul">
                <li><i class="fa fa-truck"></i> Standard Delivery</li>
                <li><i class="fa fa-ship"></i> Express Delivery</li>
                <li><i class="fa fa-handshake-o"></i> Cash on Delivery</li>
            </ul>
        </div>
        <div class="col-md-12">
            <h2><i class="fa fa-quora"></i>6. How can I cancel my order?</h2>
            <p>Go to <a href="">My Orders</a> and tap on order you wish to cancel. Click on <a href="">CANCEL</a></p>
            <p>Cancellation is not allowed if the order has been shipped.</p>
        </div>
        <div class="col-md-12">
            <h2><i class="fa fa-quora"></i>7. When can I expect refund for my returned item?</h2>
            <p>Once we receive the original item, we will do quality check. Please check our <a href="">return and refund</a> policy. We will also keep you updated on email and SMS.</p>
        </div><div class="col-md-12">
            <h2><i class="fa fa-quora"></i>8. I don't remember my password. Help!</h2>
            <p>Don't worry! You can always login using your registered email ID or mobile number.</p>
            <p>Please click the link <a href="">forgot password</a> and follow the step.</p>
        </div><div class="col-md-12">
            <h2><i class="fa fa-quora"></i>9. How to raise query/complaint?</h2>
            <p>For any type of query/complaint please click the link <a href="">Contact us</a> and send us email. We will take care of your query/complaint and solve the issue as soon as possible.</p>
        </div>
        <div class="col-md-12">
            <h2><i class="fa fa-quora"></i>10. I want to sell my items on SafeShop. Who do I get in touch with?</h2>
            <p>Go to our website and click on <a href="">Seller Account</a>. Fill in your details and we'll get in touch with you.</p>
            <p> <a href="">Click here</a> to know more.</p>
        </div>
        <div class="col-md-12">
            <h2><i class="fa fa-quora"></i>11. Why do i need to pat VAT(Value Added Tax) on products purchased through E-Commerce?</h2>
            <p>As per the recent circular given by National Board Of Revenue (NBR), Bangladesh, SafeShop is required to collect applicable VAT from customers, for selling products through E-Commerce channel as VAT exemption on online shopping is only applicable for those companies which do not have physical outlets.</p>
            <p>The rate of VAT is <strong>7.5 %</strong>.</p></br>
        </div>
    </div> 
</div>
@endsection()
