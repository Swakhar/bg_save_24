<template>
    <div class="product_add_parent">
        <div class="inner_add_div_top" v-for="(slide, index) in slider_data">
            <a  :href="`/${slide.slug}`">
                <img :src="`${slide.cache_image}`" alt="">
            </a>
        </div>
    </div>

</template>

<script>
    export default {
        name: "slider-add-section",
        props: [],
        components: {

        },
        data() {
            return {
                slider_data: [],
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
                axios.get('/get-slider-add-section')
                    .then(function (response) {
                        that.slider_data = response.data
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
