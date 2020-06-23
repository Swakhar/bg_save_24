<section class="recommended_title_top">
    <span class="title">Recommended for you</span>
    <button class="btn_view_all">View All</button>
</section>
<section class="recommended_cat_list">

    <?php
       $recommended_slider = \Webkul\CMS\Models\HomeSlider::GetRecommendedSlider();
       $slider = [];
       foreach ($recommended_slider as $key => $value) {
           $slider[$value->id]['category_name'] = $value->category_name;
           $slider[$value->id]['products'][] = $value;
       }
    ?>
    <ul >
        <?php $i = 0; ?>
        @foreach($slider as $key => $value)
            <li data-id="cat_recom_{{ $key }}" class="click_to_switch_slider {{ $i == 0 ? 'active' : '' }}">{{ $value['category_name'] }}</li>
                <?php $i += 1; ?>
        @endforeach

    </ul>
</section>
<?php $i = 0; ?>
@foreach($slider as $key => $value)
<section id="cat_recom_{{ $key }}" class="{{ $i == 0 ? 'active' : '' }} regular slider recommended">
    @foreach($value['products'] as $key => $product)
    <div class="regular_slider_inner">
        <a title="{{ $product->product_name }}" class="regular_slider_href" href="/{{ $product->product_name }}">
            <img src="{{ asset('vendor/webkul/admin/assets/images/3.webp') }}">
            <button class="slider_quick_view_btn" >Quick View</button>
        </a>
    </div>
    @endforeach
</section>
<?php $i += 1; ?>
@endforeach

@push('scripts')
<script>
    $(document).ready(function () {
        $(".click_to_switch_slider").on("click", function (e) {
            var parent = $(this);
            var width = "";
            var max = 0;
            $(".regular.recommended").each(function() {
                if ($(this).find(".slick-track").css('width').length > max) {
                    max = $(this).find(".slick-track").css('width').length;
                    width = $(this).find(".slick-track").css('width');
                }
                $(this).removeClass("active")
            });
            $("li.click_to_switch_slider").each(function() {
                $(this).removeClass("active")
            });
            // slick-track
            $("#"+parent.attr('data-id')).find(".slick-track").css('width', width);
            console.log(width)
            parent.addClass("active");
            $("#"+parent.attr('data-id')).slick('slickPlay');
            $("#"+parent.attr('data-id')).addClass("active");

        });


        $(".regular").slick({
            draggable: true,
//            autoplay: true, /* this is the new line */
            autoplaySpeed: 2000,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            touchThreshold: 1000,
        });

        $(".regular.active").slick({
            draggable: true,
            autoplay: true, /* this is the new line */
            autoplaySpeed: 2000,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            touchThreshold: 1000,
        });

        const ws = new WebSocket('ws://localhost:8080/chat')

        console.log(ws)


    })

</script>
@endpush