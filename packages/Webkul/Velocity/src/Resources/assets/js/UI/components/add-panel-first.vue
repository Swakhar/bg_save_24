<template>
    <div class="add_panel">
        <shimmer-component-small :shimmerCount="3" v-if="isLoading"></shimmer-component-small>
        <div v-else class="add_panel_inner" v-for="(slide, index) in slider_data">
            <a :href="`/${slide.slug}`">
                <img data-src="/cache/medium/product/31/crbATFGOysK0c8SY6A0xGFlwCs6iBBXNlPe4lyJY.jpeg"
                     :src="`${slide.cache_image}`"
                     loading="lazy"
                     :onerror="'/vendor/webkul/ui/assets/images/product/large-product-placeholder.png'"

                     alt="">
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "add-panel-first",
        props: [],
        components: {

        },
        data() {
            return {
                slider_data: [],
                isLoading: false,
            }
        },
        mounted() {

        },
        created() {
            this.getData();
        },
        methods: {

            getData: function (e) {
                let that = this;
                that.isLoading = true
                axios.get('/get-data-add-panel-first')
                    .then(function (response) {
                        that.slider_data = response.data
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
