<customize-category-section2></customize-category-section2>
@push('scripts')
<script>
    $(document).ready(function () {

    })
</script>
@endpush

@push('scripts')
<script type="text/x-template" id="customize-category-section">
    <div>
        <customize-category-section :data_list="data_list"
                                    :per_page="isMobileView ? 2 : (clientWidth >= 1536 ? 7 : 6)">

        </customize-category-section>
    </div>
</script>

<script type="text/javascript">
    (() => {
        Vue.component('customize-category-section2', {
            'template': '#customize-category-section',
            data: function () {
                return {
                    'list': false,
                    'isLoading': true,
                    'data_list': [],
                    'isMobileView': this.$root.isMobile(),
                    'clientWidth': document.documentElement.clientWidth
                }
            },

            mounted: function () {
                this.customize_section_data_front();
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

                'customize_section_data_front': function () {
                    this.$http.get(`${this.baseUrl}/customize-section-home-page`)
                        .then(response => {
                            this.data_list = response.data;
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