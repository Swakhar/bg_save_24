<template>
    <div>
        <div class="container-fluid" v-for="item in data_list">
            <div class="col-md-123s" >
                <span class="mix-section-title">{{ item.title  }}</span>
                <carousel
                        :class="'pagination-hide'"
                        :navigationEnabled="true"
                        :per-page="6"
                        :autoplayTimeout="2000"
                        :loop="true"
                        :autoplay="false"
                        :autoplayDirection="'forward'"
                         :mouse-drag="false">
                    <slide :key="`l-sell-${index}`" v-for="(child, index) in item.child">
                        <div  :class="`inline-card card grid-card product-card-new card-${index} mix-category-section`" >
                            <a
                               :title="`${child.name}`" >
                                <img loading="lazy" :alt="`${child.name}`"
                                     :src="`/uploads/${child.image_path}`"
                                     data-src="http://localhost:8000/cache/medium/product/31/crbATFGOysK0c8SY6A0xGFlwCs6iBBXNlPe4lyJY.jpeg"
                                     onerror="this.src='http://localhost:8000/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'"
                                     class="card-img-top lzy_img">

                            </a>
                            <div class="mix-category-section-footer">
                                <a title="Men's Bag" :href="`http://localhost:8000/${child.slug}` " class="">
                                    <span class="title-span">{{ child.name }}</span>
                                    <!--<span v-for="category_brand_span in child.category_brand_span" class="type-span">-->
                                        <!--{{ category_brand_span }}-->
                                    <!--</span>-->

                                </a>
                            </div>
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
        props: ['data_list'],
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
    .mix-category-section {
        height: 100%;
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