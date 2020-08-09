<template>
    <div class="product_view_page">
        <div class="product_view_page_inner">
            <div class="product_image_left_view_page">
                <div class="image_div">
                    <img id="zoom_01"
                         :src="`/cache/original/${images[0]}`"
                         :data-zoom-image="`/cache/original/${images[0]}`" />
                </div>

                <div class="image_slider_div_product">
                    <carousel  :class="'pagination-hide'"
                               :navigationEnabled="true"
                               :per-page="4"
                               :autoplayTimeout="2000"
                               :loop="true"
                               :autoplay="false"
                               :autoplayDirection="'forward'"
                               :mouse-drag="false">
                        <slide :key="`aaa_${index}`" v-for="(slide, index) in images">
                            <img @click="image_switch(`/cache/original/${slide}`)"
                                 :l-src="`/cache/original/${slide}`"
                                 :src="`/cache/small/${slide}`" alt="">
                        </slide>

                    </carousel>
                </div>
            </div>

            <div class="product_content_middle_view_page">
                <span class="product_name">{{ product.name }}</span>
                <span class="rating_div">
                    <img src="/cache/original/rating/rating_0.png" alt="">
                    <img src="/cache/original/rating/rating_0.png" alt="">
                    <img src="/cache/original/rating/rating_0.png" alt="">
                    <img src="/cache/original/rating/rating_0.png" alt="">
                    <img src="/cache/original/rating/rating_0.png" alt="">

                    <span class="rating_txt">No ratings</span>
                </span>

                <span class="show_attr" v-html="span">

                </span>

                <span class="sku">
                    SKU: <span class="brand">{{ product.sku }}</span>
                </span>

                <span class="price_div">
                    <span class="current_price">{{ '৳' + (product.special_price != null ? product.special_price : product.price)  }}</span>
                    <span class="prev_price" v-if="product.special_price != null">{{ '৳' + product.price }}</span>
                </span>

                <div class="button_figure">
                    <i class="cart-i fa fa-minus"></i>
                    <span class="center_span_cart_i">{{ cart_qty }}</span>
                    <i class="cart-i fa fa-plus"></i>
                </div>

                <div class="add_to_cart_panel">
                    <button class="btn btn-product-view">Buy Now</button>
                    <button class="btn btn-product-view">Add to Cart</button>
                </div>

            </div>

            <div class="product_content_end_view_page">

            </div>

        </div>


    </div>
</template>

<script>
    import { Carousel, Slide } from 'vue-carousel';
    export default {
        name: "product_view_page_main",
        props: ['images', 'product', 'span'],
        components: {
            carousel: Carousel,
            slide: Slide,
        },
        data() {
            return {
                products: [],
                product_attribute: [],
                cart_qty: 1
            }
        },
        mounted() {

        },
        created() {
//            this.getData()
            setTimeout(function(){
                $('#zoom_01').elevateZoom({scrollZoom : true});
            }, 1000);

        },
        methods: {
            image_switch: function (src) {
                $("#zoom_01").attr("data-zoom-image", src)
                $("#zoom_01").attr("src", src)
                setTimeout(function(){
                    $('#zoom_01').elevateZoom({scrollZoom : true});
                }, 1000);
            },
            getData: function (e) {
                let that = this;
                axios.get('/get-slug-category-products/'+this.slug)
                    .then(function (response) {
                        that.products = response.data.product;
                        that.product_attribute = response.data.product_attribute;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
        },
        filters: {

        }
    }
</script>

<style scoped>

</style>
