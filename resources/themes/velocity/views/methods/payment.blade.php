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
            <center><h1><u>Billing & Payments method</u></h1>
            <p><strong>We assure that online payment and managing your account is more secure, convenient and time saving.</strong></p>
            <br>
            <h2>Billing</h2>
            <p><strong>Please note</strong>, your billing amount will be shown in Bangladeshi Taka on the payment gateway.</p>
            <br>
            <h2>Payment options</h2>
            <p><strong>You can purchase Safeshop products by following payment methods 
            Visa, AMEX and MasterCard (debit, credit and gift cards), bKash and cash-on-delivery.</strong></p>
            <br>
            <h2>Credit card payments</h2>
            <p>The total payable/billed amount for your respective order will be charged to your credit card once your card has been approved. For each order, a receipt will be generated. Your billed amount exceeds your credit limit of your Credit card, then it’s automatically cancels your order.</p>
            <br>
            <h2>Debit card payments</h2>
            <p>The total payable/billed amount for your respective order will be charged to your debit card once your card has been approved. For each order, a receipt will be generated.</p>
            <p>Once your order has been confirmed, a system-generated bill will be sent to your email address and you can find in your Safeshop account.</p>
            <br>
            <br>
        </div>
    </div> 
</div>
@endsection()
