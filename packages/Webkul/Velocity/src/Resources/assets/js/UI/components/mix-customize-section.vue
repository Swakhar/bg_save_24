<template>
    <div>
        <div class="container-fluid" v-for="item in data_list">
            <div class="col-md-123 default_section" >
                <span class="mix-section-title">{{ item.title }}</span>
                <a :href="`/${item.slug}`" class="default_section_btn btn_view_all">View All</a>
                <carousel
                        :class="'pagination-hide'"
                        :navigationEnabled="true"
                        :per-page="per_page"
                        :autoplayTimeout="2000"
                        :loop="true"
                        :autoplay="false"
                        :autoplayDirection="'forward'"
                         :mouse-drag="false">
                    <slide :key="`mix-sell-${index}`" v-for="(child, index) in item.child">
                        <div  :class="`inline-card card grid-card product-card-new card-${index} mix-category-section`" >
                            <a :href="`/mix-category-item/${child.details_slug}`"
                               :title="`${child.details_title}`" >
                                <img loading="lazy" :alt="`${child.details_title}`"
                                     :src="`/cache/medium/${child.image_url}`"
                                     :data-src="`/cache/medium/${child.image_url}`"
                                     onerror="this.src='/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'"
                                     class="card-img-top lzy_img">

                            </a>
                            <div class="mix-category-section-footer">
                                <span class="hide" :set="c=''"></span>
                                <span :set="c += category_brand_span + '\n' "
                                      v-for="(category_brand_span, inde) in child.attr" class="hide">
                                        {{ category_brand_span }}
                                </span>
                                <a :title="c" :href="`/mix-category-item/${child.details_slug}` " class="">
                                    <span class="title-span">{{ child.details_title }}</span>
                                    <span v-for="category_brand_span in child.attr" class="type-span">
                                        {{ category_brand_span.length > 17 ? category_brand_span.substr(0, 15) + '...' : category_brand_span }}
                                    </span>
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
        name: "mix-customize-section-home",
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
        font-weight: 600;
    }

</style>