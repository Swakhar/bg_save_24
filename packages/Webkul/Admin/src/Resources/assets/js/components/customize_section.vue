<template>
    <div class="content">
        <image-picker v-if="is_show_image_panel"
                      v-on:apply_to_choose="apply_to_choose"
                      :selected_conditions="selected_conditions"
                      :parent_index="parent_index"
                      :parent_index_details="parent_index_details"
                      v-on:visibility_image_Panel="visibility_image_Panel"></image-picker>

        <form class="insert" method="post" action=""
              enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>{{ this.page_title }}</h1>
                </div>
                <div class="page-action">
                    <button type="button" @click="submit" class="btn btn-success">Save</button>
                    <button type="button" @click="addSlider"
                            class="btn btn-warning add_new_category"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="page-content">
                <div class="control-group">

                    <div v-for="(section, index) in sliders" class="main_section_mix">
                        <div class="main_section_mix_header">
                            <span></span>
                            <i @click="removeSlider(index)" class="section_delete fa fa-trash text-danger"></i>
                            <i @click="collapse($event, index)"
                               :class="`section_expand fa fa-${section.icon} text-danger`"></i>
                        </div>
                        <div :class="`main_section_mix_body ${section.is_hide ? 'hide' : ''}`">
                            <div class="form-group">
                                <label for="sections_title">Type</label>
                                <select name="" v-model="section.item_type" class="control" id="">
                                    <option :value="1">Sub Category</option>
                                    <option :value="2">Product</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sections_subtitle">Position</label>
                                <input  type="number" class="dt2 control" v-model="section.position"
                                        id="sections_subtitle" placeholder="Position">
                            </div>
                            <div class="form-group">
                                <label for="sections_slug">Display Name</label>
                                <input  type="text" class="dt2 control" v-model="section.display_name"
                                        id="sections_slug" placeholder="Display Name">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="sections_admin_url"><input type="checkbox" id="sections_admin_url"
                                                                       v-model="section.is_visible">
                                    is visible ?</label>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="sections_title">Category</label>
                                <multiselect
                                             v-model="section.category"
                                             :options="categories"
                                             placeholder="Select Options"
                                             label="name"
                                             :select-label="''"
                                             :multiple="false" :searchable="true"
                                             @input="onChangeCategory(index)"
                                             track-by="name"></multiselect>
                            </div>

                            <div class="form-group">
                                <label for="sections_title2">Items</label>
                                <multiselect v-model="section.include_items"
                                             :options="section.items"
                                             placeholder="Select Options"
                                             label="name"
                                             :select-label="''"
                                             :multiple="true" :searchable="true"
                                             @input="onChange(index)"
                                             track-by="name"></multiselect>
                            </div>

                        </div>
                    </div>

                    <button @click="submit" type="button" class="btn btn-success">Save</button>
                </div>

            </div>
        </form>
    </div>
</template>

<script>

    export default {
        name: "customize_section_admin",
        props: ['condition_rule', 'page_title', 'categories', 'products', 'master_data'],
        components: {

        },
        data() {
            return {
//                page_title: "Slider Settings",
                div_hide: false,
                attributes: [],
                sliders: [],
                items: [],
                sections: [],
                is_show_image_panel: false,
                selected_conditions: [],
                parent_index_details: "",
                parent_index: ""
            }
        },
        mounted() {

        },
        created() {
//            console.log(this.baseUrl)
            this.sliders = this.master_data
        },
        methods: {
            onChangeCategory: function (index) {
                this.sliders[index].items = [];
                if (this.sliders[index].item_type === 1) {
                    let cate = a.where(this.categories, { parent_id: this.sliders[index].category.id });
                    this.sliders[index].items = cate
                } else if (this.sliders[index].item_type === 2) {
                    let prod = a.where(this.products, { category_id: this.sliders[index].category.id });
                    this.sliders[index].items = prod
                } else {
                    alert('Please select type');
                }
            },
            addSections: function () {
                this.sections.push({
                    title: "",
                    subtitle: "",
                    slug: "",
                    admin_url: "",
                    is_visible: "",
                    is_hide: false,
                    icon: "minus",
                    details: [],

                })
            },

            removeCondition: function(index, index2, index3) {
                this.sections[index].details[index2].conditions.splice(index3, 1)
            },



            addSlider: function () {

                this.sliders.push({
                    position: '',
                    display_name: '',
                    category: {},
                    is_visible: '',
                    item_type: '',
                    items: [],
                    include_items: [],
                    is_hide: false,
                    icon: 'minus',
                })
            },

            collapse: function(event, index) {
                this.sliders[index].is_hide = !this.sliders[index].is_hide

                if (this.sections[index].is_hide)
                    this.sliders[index].icon = 'plus';
                else
                    this.sliders[index].icon = 'minus'
            },

            getAdvertisementData: function (e) {
                let that = this;
                axios.get('/admin/cms/get-mix-section')
                    .then(function (response) {
                        that.sections = response.data
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },


            removeSlider: function(index) {
                this.sections.splice(index, 1)
            },
            removeSlider2: function(index, index2) {
                this.sections[index].details.splice(index2, 1)
            },

            submit : function(){

                let that = this;

                axios.post('/admin/cms/customize-section-save', {
                    data: this.sliders
                })
                    .then(data =>{
                        toastr.success(data.data);
                    })
                    .catch(error => {});

            },

            click_to_expand: function (e) {
                let target = $(e.target);
                if (target.hasClass('fa-angle-down')) {
                    target.removeClass('fa-angle-down').addClass('fa-angle-right');
                    target.parent().parent().find('.accordion_body').addClass('hide')
                } else {
                    target.removeClass('fa-angle-right').addClass('fa-angle-down');
                    target.parent().parent().find('.accordion_body').removeClass('hide')
                }

            },

            change_attribute_type: function (e) {
                let types = ['select','multiselect', 'checkbox'];
                if (types.indexOf($(e.target).val()) > -1) {
                    this.is_extra_option_value = true
                } else {
                    this.is_extra_option_value = false
                }

            },
            add_option: function (e) {

                this.total_options.push({
                    option_name: "",
                    sort_order: ""
                })
            },
            minus_option: function (e) {
                this.total_options.length = 0
                $(e.target).parent().parent().remove()
            },

        },
        filters: {

        }
    }
</script>

<style scoped>
    .parent_div_of_custom_category {
        margin: 8px 0;
    }
    .parent_div_of_custom_category_header {
        background: #24587C;
        height: 27px;
        color: white;
        position: relative;
    }
    .parent_div_of_custom_category_header i.expand_div {
        position: absolute;
        right: 9px;
        font-size: 20px;
        top: 4px;
        cursor: pointer;
    }
    .parent_div_of_custom_category_header i.trash {
        position: absolute;
        right: 38px;
        font-size: 20px;
        color: red;
        top: 4px;
        cursor: pointer;
    }
    .parent_div_of_custom_category_body {
        border: 1px solid gray;
        padding: 10px;
    }
    .parent_div_of_custom_category_body .button_section {
        position: relative;
        height: 35px;
    }
    .parent_div_of_custom_category_body .add_new_category {
        position: absolute;
        right: 0;
    }
    .inline_form_3_col {
        width: 33%;
        float: left;
    }
    .trash-condition {
        color: red;
        font-size: 26px;
        margin-left: 11px;
        cursor: pointer;
    }
    .change_cond {
        background: #24587C;
    }
    i.take-picture {
        font-size: 21px;
        cursor: pointer;
    }
    .control-group {
        width: 100%;
    }
</style>