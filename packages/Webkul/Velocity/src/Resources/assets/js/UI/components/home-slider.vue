<template>
    <div class="slider_parent">

        <div class="carousel-custom">
            <shimmer-component-slider :shimmerCount="1" v-if="isLoading"></shimmer-component-slider>
            <carousel v-else  :class="'pagination-hide'"
                       :navigationEnabled="true"
                       :per-page="1"
                       :autoplayTimeout="3000"
                       :loop="true"
                       :autoplay="true"
                       :autoplayDirection="'forward'"
                       :mouse-drag="false">
                <slide :key="`aaa_${index}`" v-for="(slide, index) in slider_data">
                    <a :href="`/${slide.slug}`" :title="`${slide.title}`">
                        <img loading="lazy"
                             onerror="this.src='/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'"
                             class="slider_image" :src="`${slide.cache_image}`" alt="">
                    </a>
                </slide>

            </carousel>
        </div>
    </div>
</template>

<script>
    import { Carousel, Slide } from 'vue-carousel';
    export default {
        name: "top_slider_category",
        props: [],
        components: {
            carousel: Carousel,
            slide: Slide,

        },
        data() {
            return {
                slider_data: [],
                category_tree: [],
                isLoading: false,
            }
        },
        mounted() {

        },
        created() {
            this.getData();
//            this.getCategoryTree();
        },
        methods: {

            getData: function (e) {
                let that = this;
                that.isLoading = true
                axios.get('/get-slider-data-home-page')
                    .then(function (response) {
                        that.slider_data = response.data;
                        that.isLoading = false
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
