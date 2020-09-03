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
      <img src="{{ asset($relative_path . 'themes/velocity/assets/images/static/12.png')}}" width="100%" height="200">
    </div>
    <div class="col-md-12">
      <p class="htt">
        Safeshop Bangladesh Ltd. - Vendor Agreement
        <br>
        <br>
      </p>
      <p class="ts">
        <b style="font-style: italic;">1. Scope of the Agreement</b> <br>
      </p>
      <p class="ts">
        1.1 The Company shall offer to the Vendor its services for facilitating online sale of the Vendor’s product, which shall include hosting and technology, customer support, payment services for this arrangement, the Vendor shall pay service charges as specified under these presents, to the Company for the sale being effected online.
      </p>
      <p class="ts">
        1.2 Based on mutual discussions, it is agreed by and between the parties hereto that the Vendor shall put up for sale its Products on the said online page, subject to the terms and conditions hereinafter contained. Vendor further agrees and acknowledges that Safeshop Bangladesh Ltd. shall govern the shopping transaction. <br><br>
      </p>
      <p class="ts">
        <b style="font-style: italic;">2. Consideration and Payment Terms</b><br>
      </p>
      <p class="ts">
        2.1 The Company shall collect the Payment on behalf of the Vendor in respect of the Orders received through their online page. In consideration of the services rendered under these presents, the Company shall charge the Services charges to the Vendor at the rates specified
      </p>
      <p class="ts">
        2.2 In the event any order is reversed due to “Damaged product”, “Quality Issue”, “Not delivered” ,“Wrong Item delivered”, or “Lost Item in between transportation”, Vendor agrees that the Company shall levy the Service charges.

      </p>
      <p class="ts">
        2.3 Vendor agrees to bear all the applicable taxes, duties, or other similar payments arising out of the sales transaction of the product through the online page and www.Safeshop.com.bd shall not be responsible to collect, report, or remit any taxes arising from any transaction.
        <br><br>
      </p>
      <p class="ts">
        <b style="font-style: italic;">3. Obligations of the Vendor</b><br>
      </p><p class="ts">
        3.1 Vendor shall upload the product description, images, disclaimer, price and such other details for the products to be displayed and offered for sale through the said online page.
      </p>
      <p class="ts">
        3.2 Vendor shall ensure not to upload any description/image/text/graphic that is unlawful, illegal, objectionable, obscene, and vulgar, opposed to public policy, prohibited or is in violation of intellectual property rights including but not limited to Trademark and copyright of any third party. Vendor shall ensure to upload the product description and image only for the product, which is offered for sale through the online page.
      </p>
      <p class="ts">
        3.3 Vendor shall provide full, correct, accurate and true description of the product to enable the customers to make an informed decision.
      </p>
      <p class="ts">
        3.4 Vendor shall be solely responsible for the quality, quantity, merchantability, guarantee, warranties in respect of the products offered for sale through their online page.
      </p>
      <p class="ts">
        3.5 The Vendor shall dispatch the Products of same description, quality and quantity and price as are described and displayed on the Online Page and for which the Customer has placed the order.
      </p>
      <p class="ts">
        3.6 The Vendor shall not offer any Products for Sale on the online page, which are prohibited for sale,  dangerous, against the public policy, banned, unlawful, and illegal or prohibited in accordance with the laws of Bangladesh.
      </p>
      <p class="ts">
        3.7 The Vendor shall be solely responsible for any dispute that may be raised by the customer relating to the goods, merchandise and services provided by the Vendor.
      </p>
      <p class="ts">
        3.8 The Vendor shall at all time during the pendency of this agreement endeavor to protect and promote  the interests of the Company and ensure that third parties rights including intellectual property rights are not infringed.
      </p>
      <p class="ts">
        3.9 The Vendor shall at all times be responsible for compliance of all applicable laws. <br><br>
      </p>
      <p class="ts">
        <b style="font-style: italic;">4. Company reserves the right </b>
      </p>
      <p class="ts">
        4.1 Vendor agrees and acknowledges that the Company, at all times during the continuance of this Agreement, shall have the right to remove/block/delete any text, graphic, image(s) uploaded on the online page by the Vendor in the event the said text, image, graphic is found to be in violation of law, breach of any of the terms of this Agreement, terms and conditions. In such an event, the Company reserve the right to remove/close the online page of the Vendor without any prior intimation or liability to the Vendor.
      </p><p class="ts">
        4.2 Safeshop Bangladesh Ltd. reserves the right to provide and display appropriate disclaimers and terms of use. <br> <br>
      </p><p class="ts">
        <b style="font-style: italic;">5. Company not Liable</b>
      </p><p class="ts">
        5.1 The Company on the basis of representation by the Vendor has created the online page of the Vendor on www.Safeshop.com.bd portal to enable Vendor to offer the Vendor’s products for sale through the said online page.
      </p><p class="ts">
        5.2 Vendor shall be solely liable for any claims, damages, allegation arising out of the Products offered for sale through its online page (including but not limited to quality, quantity, price, merchantability, use for a particular purpose, or any other related claim) and shall hold the Safeshop Bangladesh Ltd. harmless and indemnified against all such claims and damages.</b>
      </p><p class="ts">
        5.3 Safeshop Bangladesh Ltd. shall not be liable for any claims, damages arising out of any negligence, misconduct or misrepresentation by the Vendor or any of its representatives.
      </p><p class="ts">
        5.4 The Vendor hereby agrees, confirms and acknowledges that the Product is owned by the Vendor and that the Company is merely a facilitator for sale of the Vendor’s Product, hence the Company is not responsible/ liable for the Product, its design, its function and condition manufacturing and selling and financial obligations, warranties, guarantees whatsoever. The Company reserves its right to state appropriate Disclaimers on its website/ online page.
      </p><p class="ts">
        <b style="font-style: italic;">6. Term, Termination and effects of Termination</b>
      </p><p class="ts">
        6.1 The Term of this Agreement shall commence on the date of execution of the contract and shall continue until terminated by either party giving written notice. <br><br>
      </p><p class="ts">
        <b style="font-style: italic;">7. Effect of Termination</b>
      </p><p class="ts">
        7.1 In the event of termination/expiry of this Agreement, the Company shall remove the Links and shall discontinue display of the Products on Online page with immediate effect.
      </p><p class="ts">
        7.2 Company shall not be liable for any loss or damages (direct, indirect or inconsequential) incurred by the Vendor by virtue of termination of this agreement. <br><br>
      </p><p class="ts">
        <b style="font-style: italic;">8. Intellectual Property Rights</b>
      </p><p class="ts">
        8.1 It is expressly agreed and clarified that, except as specified agreed in this Agreement, each Party shall retain all right, title and interest in their respective trademarks and logos and that nothing contained in this Agreement, northe use of the trademark / logos on the publicity, advertising, promotional or other material in relation to the Services shall be construed as giving to any Party any right, title or interest of any nature whatsoever to any of the other Party’s trademarks and / or logos. <br><br>
      </p><p class="ts">
        <b style="font-style: italic;">9. Entire Agreement</b>
      </p><p class="ts">
        9.1 This Agreement embodies the entire agreement and understanding of the Parties and supersedes any
and all other prior and contemporaneous agreements, arrangements and understandings (whether
written or oral) between the Parties with respect to its subject matter. </b> <br><br>
      </p><p class="ts">
        <b style="font-style: italic;">10. Limitation of liability</b>
      </p><p class="ts">
        10.1 Under no circumstances, except in case of breach of contract, will either party be liable to the other party for lost profits, or for any indirect, incidental, consequential, special or exemplary damages arising from the subject matter of this Agreement, regardless of the type of claim and even if that party has been advised of the possibility of such damages, such as, but not limited to loss of revenue or anticipated profits or loss business, unless such loss or damages is proven by the aggrieved party to have been deliberately caused by the other party. <br><br>
      </p><p class="ts">
        <b style="font-style: italic;">11. Relationship of Parties</b>
      </p><p class="ts">
        11.1 Nothing in this Agreement will be construed as creating a relationship of partnership, joint venture,
agency or employment between the Parties. The Company shall not be responsible for the acts or
omissions of the Vendor, and Vendor shall not represent neither has, any power or authority to speak for,
represent, bind or assume any obligation on behalf of the Company. <br><br>
      </p><p class="ts">
        <b style="font-style: italic;">12. Vendor Commission charge Agreement</b>
      </p><p class="ts">
        12.1 The Vendor shall pay the Company a service charge as specified by the Company on every transaction. Company reserves the right to renew the commission charges at any time upon agreeing with the vendor.
      </p>

    </div>
  </div>
</div>

@endsection()
