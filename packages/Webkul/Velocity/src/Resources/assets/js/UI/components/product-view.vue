<template>
    <div>
        <div class="product_view_left">
            <div class="product_image_product_view">
                <img :src="`${ product_images[0] }`" alt=""/>
            </div>
            <div class="slider_image_product_view">
                <carousel :class="'pagination-hide'"
                          :navigationEnabled="true"
                          :per-page="7"
                          :autoplayTimeout="3000"
                          :loop="true"
                          :autoplay="false"
                          :autoplayDirection="'forward'"
                          :mouse-drag="false">

                    <slide v-for="(image, index) in product_images" >
                        <img loading="lazy"
                             class="slider_image" :src="`${image}`" alt=""/>
                    </slide>

                </carousel>
            </div>
        </div>
        <div class="product_view_right">
            <span class="product_name">{{ product_name }}</span>
            <span class="rating">
                <img v-for="(rat_image, index) in rating_image" :src="rat_image" alt="">
            </span>
            <a class="pdp-link pdp-link_size_s pdp-link_theme_blue pdp-review-summary__link"
               data-spm-anchor-id="a2a0e.pdp.0.0">{{ total }} Ratings</a>
            <div class="pdp-review-summary__divider"></div>
            <a class="pdp-link pdp-link_size_s pdp-link_theme_blue pdp-review-summary__link"
               data-spm-anchor-id="a2a0e.pdp.0.0">15 Answered Questions</a>

            <div>
                <div id="module_product_brand_1" class="pdp-block module">
                    <div class="pdp-product-brand">
                        <span class="pdp-product-brand__name">Brand: </span>
                        <a class="pdp-link pdp-link_size_s pdp-link_theme_blue pdp-product-brand__brand-link"
                           target="_self"
                           href="https://www.daraz.com.bd/best-shopping-online-bd-121064619/?spm=a2a0e.pdp.0.0.49e946aeP2HueI"
                           data-spm-anchor-id="a2a0e.pdp.0.0">Best Shopping Online Bd
                        </a>
                        <div class="pdp-product-brand__divider"></div>
                        <a class="pdp-link pdp-link_size_s pdp-link_theme_blue pdp-product-brand__suggestion-link"
                           target="_self"
                           href="https://www.daraz.com.bd/mobiles-tablets-accessories/best-shopping-online-bd-121064619/"
                           style="max-width: calc(100% - 189px);">More Mobile Accessories from Best Shopping Online Bd</a>
                    </div>
                </div>
            </div>

            <div>
                <div id="module_product_price_1" class="pdp-block module">
                    <div class="pdp-mod-product-price">
                        <div class="pdp-product-price">
                            <span class=" pdp-price pdp-price_type_normal pdp-price_color_orange pdp-price_size_xl"
                                  data-spm-anchor-id="a2a0e.pdp.0.i5.49e946aeP2HueI">৳ {{ product_price }}</span>
                            <div class="origin-block">
                                <span class=" pdp-price pdp-price_type_deleted pdp-price_color_lightgray
                                pdp-price_size_xs">৳ 250</span>
                                <span class="pdp-product-price__discount">-40%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div id="module_promotion_tags"
                     class="pdp-block module">
                    <div class="pdp-mod-product-info-section pdp-mod-promotion-tags">
                        <h6 class="section-title" data-spm-anchor-id="a2a0e.pdp.0.i7.49e946aeP2HueI">Promotions</h6>
                        <div class="section-content">
                            <div class="tag-list" data-spm="promotion_bar">
                                <div class="promotion-tag-item  has-arrow">
                                    <div class="tag-name">Spend ৳ 1,500 get ৳ 70 off</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="qty_div">
                <span style="font-size: 18px;">Quantity</span>
                <span class="cart-qty">
                    <i class="fa fa-minus inc_dec_i"></i>
                    <input type="text" style="text-align: center;
                    height: 30px;
                    top: -4px;
                    width: 60px;
                    font-size: 18px;
                    border: none;">
                    <i class="fa fa-plus inc_dec_i"></i>
                </span>
            </div>

            <div style="margin-top: 10px">
                <button class="btn2 btn-buy-now">Buy Now</button>
                <button class="btn2 btn-cart">Add To Cart</button>
            </div>

        </div>
        <div class="product_view_end">
            <span>dsdsd</span>
            <span>dsdsd</span>
            <span>dsdsd</span>
        </div>

    </div>
</template>

<script>
    import { Carousel, Slide } from 'vue-carousel';
    export default {
        name: "product-view",
        props: ['product_name', 'avg_star_rating', 'product_images',
            'total', 'rating_image', 'short_description', 'product_price'],
        components: {
            carousel: Carousel,
            slide: Slide,
        },
        data() {
            return {

            }
        },
        mounted() {

        },
        created() {
            console.log(this.avg_star_rating)
        },
        methods: {

        },
        filters: {

        }
    }
</script>

<style scoped>

</style>
