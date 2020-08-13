<template>
    <div class="product_view_page">
        <div class="product_view_page_inner">
            <div class="product_image_left_view_page">
                <div class="image_div">
                    <img id="zoom_01"
                         :src="`/cache/original/${data_Image[0]}`"
                         :data-zoom-image="`/cache/original/${data_Image[0]}`" />
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
                        <slide :key="`aaa_${index}`" v-for="(slide, index) in data_Image">
                            <img @click="image_switch(`/cache/original/${slide}`)"
                                 :l-src="`/cache/original/${slide}`"
                                 :src="`/cache/medium/${slide}`" alt="">
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

                <span class="sku">
                    SKU: <span class="brand">{{ product.sku }}</span>
                </span>
                <span class="show_attr" v-html="span">

                </span>

                <div v-for="(pretty_option, index) in pretty_option_data">
                    <span class="attribute_name_product_view">{{ pretty_option.name }}</span>
                    <div v-if="pretty_option.is_color == 1">
                        <span class="color_display" v-for="(d, ind) in pretty_option.data"
                              @click="product_switch($event, d.option_id, pretty_option.position)"
                              v-bind:style="`background: ${d.rgb_code};`">

                        </span>
                    </div>
                    <div v-else>
                        <span class="other_display"
                              @click="product_switch($event, d.option_id, pretty_option.position)"
                              v-for="(d, ind) in pretty_option.data">
                            {{ d.option_name }}
                        </span>
                    </div>

                </div>


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
                    <button class="btn btn-product-view add_cart" @click="cart_add">
                        <a class="tooltips" href="#">
                            <span v-if="is_missing">Please provide missing information</span></a>
                        Add to Cart</button>
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
        name: "configure-product-view",
        props: ['images', 'options_product', 'pretty_option_data',
            'span', 'product', 'option_count', 'product_data'],
        components: {
            carousel: Carousel,
            slide: Slide,
        },
        data() {
            return {
                products: [],
                product_attribute: [],
                cart_qty: 1,
                min_qty: 1,
                my_val: [],
                filtered_option: [],
                data_Image: [],
                is_missing: false,
                product_id: 0
            }
        },
        mounted() {
            this.data_Image = this.images
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
                    'product_id': this.product_id,
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
                if (this.filtered_option.length === this.option_count) {
                    that.addToCart()
                } else {
                    that.is_missing = true;
                    setTimeout(function(){
                        that.is_missing = false;
                    }, 2000);
                }
            },
            cart_value_inc: function (conditions) {
                let that = this;
                if (that.filtered_option.length === that.option_count) {
                    if (conditions) {
                        that.cart_qty += 1;
                    } else {
                        if (that.min_qty < (that.cart_qty-1)) {
                            that.cart_qty -= 1;
                        }
                    }
                } else {
                    that.is_missing = true;
                    setTimeout(function(){
                        that.is_missing = false;
                    }, 2000);

                }

            },
            product_switch: function (event, option_id, position) {
                if (this.filtered_option[+position] === undefined) {
                    this.filtered_option.push(option_id);
                } else {
                    this.filtered_option[+position] = +option_id;
                }
                let all_child = $(event.target).parent().children();
                for (let i = 0; i < all_child.length; i++) {

                    $(all_child[i]).removeClass('active')
                }
                $(event.target).addClass('active')
                if (this.option_count === this.filtered_option.length) {
                    this.call_to_switch_product()
                }
            },
            call_to_switch_product: function () {
                let product_id = "";
                for (let index in this.options_product) {
                    console.log(this.options_product[index]['options'].join('_'), this.filtered_option.join('_'))
                    if (this.options_product[index]['options'].join('_') === this.filtered_option.join('_')) {
                        product_id = index
                        this.product_id = index
                    }

                }
                this.images.length = 0
                for (let index in this.product_data[product_id]['images']) {
                    this.data_Image.push(this.product_data[product_id]['images'][index])
                    this.product.price = this.product_data[product_id]['price']
                }
                $("#zoom_01").data('zoom-image', '/cache/original/'+this.data_Image[0]).elevateZoom({scrollZoom : true});

            },
            dispatchAction: function (action, index) {
                this.pretty_option_data[+index]['selected'] = action
                //product_data
                console.log(action, index)
            },
            image_switch: function (src) {
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
