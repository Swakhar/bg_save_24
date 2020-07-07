<template>
    <div class="image-pickup">
        <span class="title">Pick an image url</span>
        <i @click="click_to_visible_image_panel" class="image-panel-trash fa fa-times"></i>
        <div class="search_panel control-group">
            <div class="div_50_percent">
                <select name="" id="" class="control">
                    <option value="">Select Category </option>
                    <option value="">asdas </option>
                    <option value="">asdas </option>
                    <option value="">asdas </option>
                    <option value="">asdas </option>
                    <option value="">asdas </option>
                </select>
            </div>
            <div class="div_50_percent">
                <select name="" id="" class="control">
                    <option value="">Select Product </option>
                    <option value="">asdas </option>
                    <option value="">asdas </option>
                    <option value="">asdas </option>
                    <option value="">asdas </option>
                    <option value="">asdas </option>
                </select>
                <button :disabled="image_path == ''" @click="click_to_apply" class="btn btn-success">Apply</button>
            </div>
        </div>

        <div class="">
            <div class="image-show-panel">
                <div class="inline_image_div" v-for="image in images">
                    <img class="selected_image" :src="'/uploads/'+image.path" alt="">
                    <input :data-image-path="image.path"
                           v-on:change="image_radio_click"
                           :value="image.path"
                           class="image_choose_check_box" type="radio" name="common" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "image-picker",
        props: ['under_parent_index', 'parent_index', 'inside_row_data'],
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
            image_radio_click: function (event) {
                this.image_path = event.target.getAttribute("data-image-path")
            },
            click_to_visible_image_panel: function () {
                this.$emit('visibility_image_Panel', false)
            },
            click_to_apply: function () {
                this.$emit('apply_to_choose', {
                    parent_index: this.parent_index,
                    under_parent_index: this.under_parent_index,
                    image_path: $( "input[name='common']" ).val()
                })
            },
            getProductImage: function () {
                if (this.inside_row_data.conditions.length > 0) {
                    let conditions = [];
                    for (let ind in this.inside_row_data.conditions) {
                        conditions.push({
                            rule_operator: this.inside_row_data.conditions[ind].rule_operator,
                            rule_operator: this.inside_row_data.conditions[ind].rule_operator,
                        });
                        console.log(this.inside_row_data.conditions[ind])
                    }
                }
//                let that = this;
//                axios.get('/admin/cms/product-image-url')
//                .then(function (response) {
//                    that.images = response.data
//                })
//                .catch(function (error) {
//                    // handle error
//                    console.log(error);
//                })
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
    div.image-pickup {
        position: absolute;
        z-index: 999;
        background: white;
        width: 80%;
        min-height: 600px;
        box-shadow: 1px 0px 5px 1px grey;
        left: 12%;
        padding: 20px;
        top: -9%;
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
    }
    div.inline_image_div {
        display: inline-block;
        box-shadow: 1px 1px 4px 1px grey;
        margin: 3px;
    }
    input.image_choose_check_box {

    }
</style>