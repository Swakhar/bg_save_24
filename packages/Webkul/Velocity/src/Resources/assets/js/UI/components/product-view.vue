<template>
    <div class="product_view_page">
        <div class="product_view_page_inner">
            <div class="mobile_view">
                <span class="product_name">{{ product.name }}</span>
            </div>
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

            <div class="product_content_middle_view_page desktop_view">
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
                    <i @click="cart_value_inc(false)" class="cart-i fa fa-minus"></i>
                    <span class="center_span_cart_i">{{ cart_qty }}</span>
                    <i @click="cart_value_inc(true)" class="cart-i fa fa-plus"></i>
                </div>

                <div class="add_to_cart_panel">
                    <button class="btn btn-product-view buy_now" @click="buy_now">Buy Now</button>
                    <button class="btn btn-product-view add_cart" @click="cart_add">Add to Cart</button>
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
                cart_qty: 1,
                min_qty: 0
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
            'addToCart': function () {
                this.isButtonEnable = false;
                let url = `${this.$root.baseUrl}/cart/add`;

                this.$http.post(url, {
                    'quantity': this.cart_qty,
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'product_id': this.product.product_id,
                })
                    .then(response => {
                        //this.isButtonEnable = true;

                        if (response.data.status == 'success') {
                            this.$root.miniCartKey++;

                            if (this.moveToCart == "true") {
                                let existingItems = this.getStorageValue('wishlist_product');

                                let updatedItems = existingItems.filter(item => item != this.productFlatId);

                                this.$root.headerItemsCount++;
                                this.setStorageValue('wishlist_product', updatedItems);
                            }

                            window.showAlert(`alert-success`, this.__('shop.general.alert.success'), response.data.message);

                            if (this.reloadPage == "1") {
                                window.location.reload();
                            }
                        } else {
                            window.showAlert(`alert-${response.data.status}`, response.data.label ? response.data.label : this.__('shop.general.alert.error'), response.data.message);

                            if (response.data.redirectionRoute) {
                                window.location.href = response.data.redirectionRoute;
                            }
                        }
                    })
                    .catch(error => {
                        console.log(this.__('error.something_went_wrong'));
                    })
            },
            cart_value_inc: function (conditions) {
                let that = this;
                if (conditions) {
                    that.cart_qty += 1;
                } else {
                    if (that.min_qty < (that.cart_qty-1)) {
                        that.cart_qty -= 1;
                    }
                }
            },
            buy_now: function () {
                let that = this;
                if (this.filtered_option.length === this.option_count) {

                } else {
                    that.is_missing = true;
                    setTimeout(function(){
                        that.is_missing = false;
                    }, 2000);
                }
            },
            cart_add: function () {
                let that = this;
                that.addToCart()
            },
            image_switch: function (src) {
                $("#zoom_01").attr("data-zoom-image", src);
                $("#zoom_01").attr("src", src);
                $("#zoom_01").data('zoom-image', src).elevateZoom({scrollZoom : true});
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
