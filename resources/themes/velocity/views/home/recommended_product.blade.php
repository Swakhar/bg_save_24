<recommended-product-card></recommended-product-card>
@push('scripts')
<script>
    $(document).ready(function () {
        $(".click_to_switch_slider").on("click", function (e) {
            var parent = $(this);
            var width = "";
            var max = 0;
            $(".regular.recommended").each(function() {
                if ($(this).find(".slick-track").css('width').length > max) {
                    max = $(this).find(".slick-track").css('width').length;
                    width = $(this).find(".slick-track").css('width');
                }
                $(this).removeClass("active")
            });
            $("li.click_to_switch_slider").each(function() {
                $(this).removeClass("active")
            });
            parent.addClass("active");
            $("#"+parent.attr('data-id')).addClass("active");

        });

    })

</script>
@endpush


@push('scripts')
<script type="text/x-template" id="recommended-category-list">
    <div :class="`${isMobileView ? '' : 'col-md-12'}`" >
        <shimmer-component v-if="isLoading && !isMobileView"></shimmer-component>
        <template v-else-if="total_size > 0">
            <div>
                <recommended-cat-list :btn_txt="btn_txt"
                                      :active_index="active_index"
                                      :slider_name="slider_name"
                                      :isMobileView="isMobileView"
                                      v-on:passIndexSliderToParent="passIndexSliderToParent"
                        :category_list_recommended="category_list_recommended">
                </recommended-cat-list>
                <div :class="`${isMobileView ? 'col-md-12 recom_cat mobile_view' : 'col-md-10  recom_cat desktop_view'}`" >
                    <div class="container-fluid featured-products">
                        <shimmer-component v-if="isLoading"></shimmer-component>

                        <div :class="`carousel-products  ${isMobileView ? '' : 'vc-full-screen'} ltr`" >
                            <carousel-component
                                    :slides-per-page="isMobileView ? 2 : 6"
                                    navigation-enabled="hide"
                                    pagination-enabled="hide"
                                    id="fearured-products-carousel"
                                    :slides-count="slider_product_list.length">

                                <slide
                                        :key="index"
                                        :slot="`slide-${index}`"
                                        v-for="(product, index) in active_slider">
                                    <product-card
                                            :list="list"
                                            :product="product">
                                    </product-card>
                                </slide>
                            </carousel-component>
                        </div>

                    </div>
                </div>
            </div>
        </template>
    </div>

</script>

<script type="text/javascript">
    (() => {
        Vue.component('recommended-product-card', {
            'template': '#recommended-category-list',
            data: function () {
                return {
                    'list': false,
                    'isLoading': true,
                    'category_list_recommended': [],
                    'total_size': [],
                    'slider_product_list': [],
                    'active_slider': [],
                    'slider_name': "",
                    'active_index': 0,
                    'btn_txt': "",
                    'isMobileView': this.$root.isMobile(),
                }
            },

            mounted: function () {
                this.getFeaturedProducts3();
            },

            methods: {


                'getSizeOfObject': function (obj) {
                    var size = 0, key;
                    for (key in obj) {
                        if (obj.hasOwnProperty(key)) size++;
                    }
                    return size;
                },

                'passIndexSliderToParent': function (index) {
                    this.active_slider = this.slider_product_list[index];
                    this.active_index = index;
                },

                'getFeaturedProducts3': function () {
                    this.$http.get(`${this.baseUrl}/recommended-slider`)
                        .then(response => {
                            this.category_list_recommended = response.data

                            this.total_size = this.getSizeOfObject(this.category_list_recommended);
                            let i = 0;
                            for (obj in this.category_list_recommended) {
                                if (i === 0)
                                    this.active_index = obj;
                                this.slider_product_list[obj] = this.category_list_recommended[obj].products;
                                this.slider_name = this.category_list_recommended[obj].slider_name
                                i += 1;
                            }
                            this.btn_txt = "View All";

                            this.active_slider = this.slider_product_list[this.active_index];

                            this.isLoading = false;
                        })
                        .catch(error => {
                            this.isLoading = false;
                            console.log(this.__('error.something_went_wrong'));
                        })
                }
            }
        })
    })()
</script>
@endpush