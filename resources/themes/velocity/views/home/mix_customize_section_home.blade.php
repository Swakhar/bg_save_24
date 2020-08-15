<mix-category-section></mix-category-section>
@push('scripts')
<script>
    $(document).ready(function () {

    })
</script>
@endpush

@push('scripts')
<script type="text/x-template" id="mix-category-section">
    <div>
        <mix-customize-section-home :data_list="data_list"
                                    :per_page="isMobileView ? 2 : (clientWidth >= 1536 ? 7 : 6)"></mix-customize-section-home>
    </div>
</script>

<script type="text/javascript">
    (() => {
        Vue.component('mix-category-section', {
            'template': '#mix-category-section',
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
                this.mix_section_data_front();
                console.log('clientWidth', this.clientWidth)
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

                'mix_section_data_front': function () {
                    this.$http.get(`${this.baseUrl}/mix-category-item-front`)
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