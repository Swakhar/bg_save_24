@extends('shop::layouts.master')

@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('customHelper', 'Webkul\Velocity\Helpers\Helper')
@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

@php
    $total = $reviewHelper->getTotalReviews($product);
    $avgRatings = $reviewHelper->getAverageRating($product);
    $avgStarRating = ceil($avgRatings);
    $productImages = [];
    $images = $productImageHelper->getGalleryImages($product);
    foreach ($images as $key => $image) {
        array_push($productImages, $image['medium_image_url']);
    }
@endphp

@section('page_title')
    {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
@stop

@section('seo')
    <meta name="description" content="{{ trim($product->meta_description) != "" ? $product->meta_description : str_limit(strip_tags($product->description), 120, '') }}"/>

    <meta name="keywords" content="{{ $product->meta_keywords }}"/>

    @if (core()->getConfigData('catalog.rich_snippets.products.enable'))
        <script type="application/ld+json">
            {!! app('Webkul\Product\Helpers\SEO')->getProductJsonLd($product) !!}
        </script>
    @endif

    <?php $productBaseImage = app('Webkul\Product\Helpers\ProductImage')->getProductBaseImage($product); ?>

    <meta name="twitter:card" content="summary_large_image" />

    <meta name="twitter:title" content="{{ $product->name }}" />

    <meta name="twitter:description" content="{{ $product->description }}" />

    <meta name="twitter:image:alt" content="" />

    <meta name="twitter:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:type" content="og:product" />

    <meta property="og:title" content="{{ $product->name }}" />

    <meta property="og:image" content="{{ $productBaseImage['medium_image_url'] }}" />

    <meta property="og:description" content="{{ $product->description }}" />

    <meta property="og:url" content="{{ route('shop.productOrCategory.index', $product->url_key) }}" />
@stop

@push('css')
    <style type="text/css">
        .related-products {
            width: 100%;
        }
        .recently-viewed {
            margin-top: 20px;
        }
        .store-meta-images > .recently-viewed:first-child {
            margin-top: 0px;
        }
        .main-content-wrapper {
            margin-bottom: 0px;
        }
    </style>
@endpush

@section('full-content-wrapper')
<?php
        // /cache/medium/rating/rating_full.png
        $rating_image = [];
 for ($i = 1; $i <= $avgStarRating; $i++) {
     $rating_image[] = "/cache/medium/rating/rating_full.png";
 }
 for ($i = $avgStarRating+1; $i <= 5; $i++) {
     $rating_image[] = "/cache/medium/rating/rating_0.png";
 }
?>
    <div class="row no-margin">
        <section class="col-12 product-detail">
            <product-view :avg_star_rating="{{ $avgStarRating }}"
                          :product_images="{{ json_encode($productImages, true) }}"
                          :rating_image="{{ json_encode($rating_image, true) }}"
                          :total="{{ $total }}"
                    :product_name="'{{ $product->name }}'">

            </product-view>

            <div style="width: 100%;display: flex;">
                <div class="product_view_more_information">
                    <div class="more_information_header_css">
                        <span onclick="nab_switch('p_f')" class="more_information_header active" id="p_f">Product Features</span>
                        <span onclick="nab_switch('m_i')" class="more_information_header" id="m_i">More Information</span>
                        <span onclick="nab_switch('p_rev')" class="more_information_header" id="p_rev">Reviews</span>
                    </div>
                    <div class="more_information_body">
                        <div :data-fillup="'p_f'" class="more_body active p_f" >
                            {!! $product->short_description !!}
                        </div>
                        <div :data-fillup="'m_i'" class="more_body hide m_i">
                            <table class="product_details_table">
                                <tr>
                                    <td width="50%">SKU</td>
                                    <td width="50%">545445</td>
                                </tr>
                                <tr>
                                    <td width="50%">Brand</td>
                                    <td width="50%">545445</td>
                                </tr>
                                <tr>
                                    <td width="50%">Unit Of Measurement</td>
                                    <td width="50%">545445</td>
                                </tr>
                            </table>
                        </div>

                        <div :data-fillup="'p_rev'" class="more_body hide p_rev">
                            Write your own review
                            You are reviewing Atta 2kg
                            <div>
                                <div class="left_review">
                                    <span>Your rating quality</span>
                                </div>
                                <div class="right_review">
                                    <div class="block_seperate">
                                        <span class="label3">Nickname</span>
                                        <input class="ct" type="text" placeholder="Nickname">
                                    </div>
                                    <div class="block_seperate">
                                        <span class="label3">Summary</span>
                                        <input class="ct" type="text" placeholder="Summary">
                                    </div>
                                    <div class="block_seperate">
                                        <span class="label3">Review</span>
                                        <textarea class="ct" name="" id="" cols="30" placeholder="Review" rows="3"></textarea>
                                    </div>
                                    <div class="block_seperate">
                                        <button class="btn2 btn-cart">Submit Review</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
<script>
    function nab_switch (cond) {
        $('.more_body').each(function(i, obj) {
            $(this).addClass('hide').removeClass('active')
        });
        $('.more_information_header').each(function(i, obj) {
            $(this).removeClass('active')
        });
        $("."+cond).removeClass('hide').addClass('active')
        $("#"+cond).addClass('active')
        console.log(cond)
    }
</script>
@endpush