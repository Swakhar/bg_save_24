<template>
    <div class="add_panel">
        <shimmer-component-small :shimmerCount="4" v-if="isLoading"></shimmer-component-small>
        <div v-else class="add_panel_third">
            <div class="add_panel_third_inner"v-for="(slide, index) in slider_data">
                <a  :href="`/${slide.slug}`">
                    <img :src="`${slide.cache_image}`" alt="">
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "add-panel-second",
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
                axios.get('/get-data-add-panel-second')
                    .then(function (response) {
                        that.slider_data = response.data
                        that.isLoading = false
                        if (response.data.length === 0) {
                            $(".add_sec_two").addClass('hide')
                        }
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
