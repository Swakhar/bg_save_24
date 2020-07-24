<template>
    <div class="image-pickup">
        <span class="title">Pick an image url</span>
        <i @click="click_to_visible_image_panel" class="image-panel-trash fa fa-times"></i>
        <button @click="click_to_apply" class="btn btn-success">Apply</button>
        <div class="">
            <div class="image-show-panel">
                <div class="inline_image_div" v-for="image in images">
                    <img class="selected_image"
                         @click="clickIMage($event)"
                         :data-path="`${image.path}`"
                         :src="'/uploads/'+image.path" alt="">

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "image-picker",
        props: ['selected_conditions', 'parent_index_details', 'parent_index'],
        components: {

        },
        data() {
            return {
                images: [],
                image_path: ""
            }
        },
        updated() {

        },
        mounted() {

        },
        created() {
            this.getProductImage()
        },
        methods: {
            clickIMage: function(event) {
                $('.selected_image').each(function() {
                    $(this).removeClass('active')
                });
                this.image_path = $(event.target).attr('data-path')
                $(event.target).addClass("active")
            },
            image_radio_click: function (event) {
                this.image_path = event.target.getAttribute("data-image-path")
            },
            click_to_visible_image_panel: function () {
                this.$emit('visibility_image_Panel', false)
            },
            click_to_apply: function () {
                this.$emit('apply_to_choose', {
                    parent_index: this.parent_index,
                    parent_index_details: this.parent_index_details,
                    image_path: this.image_path
                })
            },
            getProductImage: function () {
                let that = this;
                axios.post('/admin/cms/product-image-url', {data: that.selected_conditions})
                .then(function (response) {
                    that.images = response.data
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            }
        },
        filters: {

        }
    }
</script>

<style scoped>
    div.image-pickup span.title {
        font-size: 18px;
        color: #000000b0;
        font-weight: bold;
    }
    img.selected_image.active {
        box-shadow: 2px 0px 11px 3px blue;
    }
    div.image-pickup {
        position: fixed;
        z-index: 999;
        background: white;
        width: 80%;
        height: 500px;
        box-shadow: 1px 0px 5px 1px grey;
        left: 12%;
        padding: 20px;
        top: 2%;
        overflow-y: scroll;
    }
    div.div_50_percent {
        float: left;
        width: 50%;
    }
    i.image-panel-trash {
        font-size: 32px;
        position: absolute;
        right: 15px;
        top: 0;
        cursor: pointer;
        color: #c31c1c;
    }
    div.image-show-panel {
        width: 100%;
        margin-top: 25px;
        display: flow-root;
    }
    img.selected_image {
        width: 150px;
        height: 150px;
        cursor: pointer;
    }
    div.inline_image_div {
        display: inline-block;
        box-shadow: 1px 1px 4px 1px grey;
        margin: 3px;
    }
    input.image_choose_check_box {

    }
</style>