<template>
    <div>
        <div class="container-fluid" v-for="item in data_list">
            <div class="col-md-123s" >
                <span class="mix-section-title">{{ item.title  }}</span>
                <carousel
                        :class="'pagination-hide'"
                        :navigationEnabled="true"
                        :per-page="per_page"
                        :autoplayTimeout="2000"
                        :loop="true"
                        :autoplay="false"
                        :autoplayDirection="'forward'"
                         :mouse-drag="true">
                    <slide :key="`l-sell-${index}`" v-for="(child, index) in item.child">

                        <div v-if="child.is_product == false"
                             :class="`inline-card card grid-card product-card-new card-${index} mix-category-section`" >
                            <a
                               :title="`${child.name}`" >
                                <img loading="lazy" :alt="`${child.name}`"
                                     :src="''"
                                     :realsrc="`/cache/medium/${child.image_url}`"
                                     data-src="/cache/medium/product/31/crbATFGOysK0c8SY6A0xGFlwCs6iBBXNlPe4lyJY.jpeg"
                                     onerror="this.src='/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'"
                                     class="card-img-top lzy_img">

                            </a>
                            <div class="mix-category-section-footer">
                                <a :title="child.name" :href="`/${child.slug}` " class="">
                                    <span class="title-span">{{ child.name }}</span>
                                </a>
                            </div>
                        </div>

                        <div v-else>
                            <product-card
                                    :list="false"
                                    :product="child">
                            </product-card>
                        </div>

                    </slide>

                </carousel>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import { Carousel, Slide } from 'vue-carousel';
    export default {
        name: "customize-category-section",
        mixins: ['myMixin'],
        props: ['data_list', 'per_page'],
        components: {
            carousel: Carousel,
            slide: Slide
        },
        data: function () {
            return {

            }
        },

        mounted: function () {

        },

        methods: {
            clickLi: function (index) {
                this.$emit('passIndexSliderToParent', index)
            },
            quickView: function (event) {
                event.preventDefault();
                event.stopPropagation();

                this.$root.quickView = true;
                this.$root.productDetails = this.quickViewDetails;

                $('body').toggleClass('overflow-hidden');
            }
        }
    }
</script>
<style>
    .inline-card {
        display: inline-block;
    }
    .mix-section-title {
        display: block;
        font-size: 20px;
        color: black;
        font-weight: 600;
    }
    .card-0 {
        margin-left: 0;
    }


    .mix-category-section a {
        text-decoration: none;
        color: black;
    }
    .mix-category-section-footer {
        height: 54px;
    }
    .mix-category-section-footer span.type-span {
        display: block;
        font-size: 15px;
        text-align: center;
    }
    .mix-category-section-footer span.title-span {
        display: block;
        font-size: 16px;
        text-align: center;
    }

</style>