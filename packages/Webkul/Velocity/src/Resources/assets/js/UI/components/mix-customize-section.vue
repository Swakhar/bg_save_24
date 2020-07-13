<template>
    <div>
        <div class="container-fluid" v-for="item in data_list">
            <div class="col-md-12" >
                <span class="mix-section-title">{{ item.title }}</span>
                <div v-for="(child, index) in item.details" :class="`inline-card card grid-card product-card-new card-${index}`" >
                    <a :href="`http://localhost:8000/mix-category-item/${child.details_slug}`"
                            :title="`${child.details_title}`" class="product-image-container">
                        <img loading="lazy" :alt="`${child.details_title}`"
                             src="http://localhost:8000/cache/medium/product/31/crbATFGOysK0c8SY6A0xGFlwCs6iBBXNlPe4lyJY.jpeg"
                             data-src="http://localhost:8000/cache/medium/product/31/crbATFGOysK0c8SY6A0xGFlwCs6iBBXNlPe4lyJY.jpeg"
                             onerror="this.src='http://localhost:8000/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'"
                             class="card-img-top lzy_img">

                    </a>
                    <div class="card-body">
                        <div class="product-name col-12 no-padding">
                            <a title="Men's Bag" :href="`http://localhost:8000/mix-category-item/${child.details_slug}` " class="unset">
                                <span class="fs163336">{{ child.category_brand_span[0] }}</span>
                                <span class="fs16">{{ child.details_title }}</span>


                            </a>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: "mix-customize-section-home",
        mixins: ['myMixin'],
        props: ['data_list'],

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
    span.fs163336 {
        position: absolute;
        top: -19px;
        display: -webkit-box;
    }
    .product-card-new .card-body .product-name, .product-card-new .card-body .product-rating {
        width: 15rem;
        overflow: inherit;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>