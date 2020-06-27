<div class="flash_sales">
    {{--<span class="section_title">Flash Sale</span>--}}
    <div class="flash_sales_head">
        <div class="display_text_flash_sales">
            <span  class="inline_span">Customize name</span>

            <a href="#" class="btn-home btn_view_all">{{ __('velocity::app.home.view-all') }}</a>
        </div>

    </div>
    <?php $is_sub_cat = true; ?>
    @if (!$is_sub_cat)
    <div class="customize_product_body">
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】</span>
            <span class="price">৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】</span>
            <span class="price">৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】</span>
            <span class="price">৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】</span>
            <span class="price">৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】</span>
            <span class="price">৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】</span>
            <span class="price">৳44.99</span>
        </a>
    </div>
    @else
    <div class="customize_category_body">
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】50 Pcs</span>
            <span class="price">From ৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】50 Pcs</span>
            <span class="price">From ৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】50 Pcs</span>
            <span class="price">From ৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】50 Pcs</span>
            <span class="price">From ৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】50 Pcs</span>
            <span class="price">From ৳44.99</span>
        </a>
        <a href="#" class="flash_div_href">
            <img class="flash_product" src="{{ asset('vendor/webkul/admin/assets/images/01.jpg') }}" alt="">
            <span class="fs-card-title">【Local Ready Stock】50 Pcs</span>
            <span class="price">From ৳44.99</span>
        </a>

    </div>
    @endif
</div>