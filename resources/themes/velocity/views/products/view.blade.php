@extends('shop::layouts.master')

@section('page_title')
    {{ $current_cat_name }}
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
//        $rating_image = [];
// for ($i = 1; $i <= $avgStarRating; $i++) {
//     $rating_image[] = "/cache/medium/rating/rating_full.png";
// }
// for ($i = $avgStarRating+1; $i <= 5; $i++) {
//     $rating_image[] = "/cache/medium/rating/rating_0.png";
// }
?>
    <div class="row2 no-margin">
        <section class="col-12 product-detail">
            <?php
                $exist = ['name', 'sku', 'price', 'special_price',
                    'special_price_from', 'special_price_to',
                    'product_id', 'type'];
                $cur_product = [];
                foreach ($product as $key => $value) {
                    if (in_array($key, $exist)) {
                        $cur_product[$key] = $value;
                    }
                }
            ?>
            <product-view
                    :product="{{ json_encode($cur_product, true) }}"
                    :images="{{ json_encode($images, true) }}"
                    :span="'{{ $span }}'"

            >

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
                            <div class="options_details_show">
                                {!! $html !!}
                            </div>
                        </div>

                        <div :data-fillup="'p_rev'" class="more_body hide p_rev">
                            Write your own review
                            You are reviewing <span style="color: #F36000;">{{ $product->name }}</span>
                            <div>
                                <take-review :product_id="{{ $product->product_id }}"></take-review>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
<script src="{{ asset($relative_path . 'themes/jquery.elevatezoom.js?version=2.7') }}"></script>
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