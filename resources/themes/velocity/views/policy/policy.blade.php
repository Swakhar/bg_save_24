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
    <div class="row" style="padding-bottom: 15px;">
        <div class="col-md-12" style="padding-bottom: 5px;">
            <p>Thanks for shopping at Safeshop.com.bd. If you do not satisfy with the product then please simply return and get refund. Please check our return, refund and cancellation policy in bellows:</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <center><h1><u>Return Policy</u></h1></center>
            <p>The customer have 3 days to return an item from the date they received the product. The Grocery items will not be covered under return policy.Please note that return policy does not apply for any Global products</p>
        </div>
        <div class="col-md-12">
            <h2>Condition to return an item</h2>  
            <p>If Delivered Product is</p> 
            <ol class="fa-ul">
                <li><i class="fa fa-check"></i>Broken or </li>
                <li><i class="fa fa-check"></i>Incomplete or </li>
                <li><i class="fa fa-check"></i>Incorrect (presentation different on website).</li>
            </ol>         
        </div>
        <div class="col-md-12">
            <h2>Returns accept Conditions</h2>
            <ol class="fa-ul">
                <li><i class="fa fa-check"></i>The product should be sent with original and undamaged manufacturer packaging / box along with original tags, user manual, warranty cards, freebies and accessories. It should be unused, unwashed and without any damages.</li></br>
                <li><i class="fa fa-check"></i>If the product was delivered in a two layers of packaging, it must be returned in the same condition with return shipping label attached. Do not put tape or stickers on the manufacturer’s box.</li>
            </ol>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <center><h1><u>Refund Policy</u></h1></center>
            <p>If you want to refund. Please check whether your product is eligible for a refund. Please keep in mind that the shipping fee & surcharge will be deducted along with the amount paid for your returned product.</p>
            <p>After receiving your product by the respective sellers, the seller will inspect the product or shipment and notify you about the refund status of your order (in 2-3 days).</p>
            <p>Once the product is eligible for refund a credit will be applied to the payment method used on the original order. In case of Case on Delivery (COD) you will be notify you to share your payment information for the refund.</p>
            <p>Please take into account that some credit cards may take an additional 2-10 days for the credit to show on your account so allow as much as 14 days for the credit to be applied.</p>
            <p><strong>Please note that refund policy does not apply for any Global products.</strong></p>
        </div>
    </div>
</div> 
<div class="container"> 
    <div class="row" style="margin-top: 15px;padding-bottom: 15px;">
        <div class="col-md-12">
           <center><h1><u>Order Cancellation</u></h1></center>
            <p>No cancellations shall be permissible after the product is dispatched from the sellers.</p>
        </div>
    </div> 
</div>
@endsection()
