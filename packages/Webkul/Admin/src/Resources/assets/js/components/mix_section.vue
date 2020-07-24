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
                    <button type="button" @click="addSections"
                            class="btn btn-warning add_new_category"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="page-content">
                <div class="control-group">

                    <div v-for="(section, index) in sections" class="main_section_mix">
                        <div class="main_section_mix_header">
                            <span></span>
                            <i @click="removeSlider(index)" class="section_delete fa fa-trash text-danger"></i>
                            <i @click="collapse($event, index)"  :class="`section_expand fa fa-${section.icon} text-danger`"></i>
                        </div>
                        <div :class="`main_section_mix_body ${section.is_hide ? 'hide' : ''}`">
                            <div class="form-group">
                                <label for="sections_title">Title</label>
                                <input  type="text" class="dt2 control" v-model="section.title"
                                        id="sections_title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="sections_subtitle">Sub-Title</label>
                                <input  type="text" class="dt2 control" v-model="section.subtitle"
                                        id="sections_subtitle" placeholder="Sub-Title">
                            </div>
                            <div class="form-group">
                                <label for="sections_slug">Sections Slug</label>
                                <input  type="text" class="dt2 control" v-model="section.slug"
                                        id="sections_slug" placeholder="Sections Slug">
                            </div>
                            <div class="form-group">
                                <label for="sections_admin_url">Sections Admin Url</label>
                                <input  type="text" class="dt2 control" v-model="section.admin_url"
                                        id="sections_admin_url" placeholder="Sections Admin Url">
                            </div>

                            <button type="button" @click="addDetails(index)"
                                    class="btn btn-warning add_new_category"><i class="fa fa-plus"></i></button>

                            <div class="details_section_of_mix" v-for="(details, index2) in section.details">
                                <div class="mix_details_header">
                                    <i @click="removeSlider2(index, index2)" class="section_delete fa fa-trash text-danger"></i>
                                    <i @click="collapse2($event, index, index2)"  :class="`section_expand fa fa-${details.icon} text-danger`"></i>
                                </div>
                                <div :class="`mix_details_body ${details.is_hide ? 'hide' : ''}`">
                                    <div class="form-group">
                                        <label for="details_title">Title</label>
                                        <input  type="text" class="dt2 control" v-model="details.title"
                                                id="details_title" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="details_slug">Slug</label>
                                        <input  type="text" class="dt2 control" v-model="details.slug"
                                                id="details_slug" placeholder="Slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="details_image_url">Image</label>
                                        <input style="width: 88%;" type="text" class="dt2 control" v-model="details.image_url"
                                                id="details_image_url" placeholder="Image Url">
                                        <i @click="show_image_panel(index, index2)"
                                           class="take-picture fa fa-picture-o"></i>
                                    </div>

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th colspan="4">
                                                <button @click="addCondition(index, index2)" type="button"
                                                        class="btn btn-success text-left">Add new condition</button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(condition, index3) in details.conditions">
                                            <th width="20%">
                                                <select v-model="condition.label" name=""
                                                        @change="changeCondition($event, index, index2, index3)"
                                                        class="dt2 control" id="">
                                                    <option  value="">Select Option</option>
                                                    <option :data-value="item.type"
                                                            :index="index3"
                                                            v-for="(item, index3) in attributes"
                                                            :value="`${item.name}`">{{ item.name }}</option>
                                                </select>
                                            </th>
                                            <th width="20%">
                                                <select v-model="condition.rule" name="" class="dt2 control" id="">
                                                    <option value="">Select Option</option>
                                                    <option v-for="rule in condition.rule_array"
                                                            :value="`${rule.operator}`">{{ rule.label }}</option>
                                                </select>
                                            </th>
                                            <th width="55%">
                                                <multiselect v-if="condition.is_multi"
                                                             v-model="condition.rule_value_multi"
                                                             :options="condition.options"
                                                             placeholder="Select Options"
                                                             label="admin_name"
                                                             :select-label="''"
                                                             :multiple="true" :searchable="true"
                                                             @input="onChange(index)"
                                                             track-by="admin_name"></multiselect>
                                                <!--<select4 v-if="condition.is_multi"-->
                                                         <!--:included_data="condition.rule_value_multi"-->
                                                         <!--:items="condition.options"-->
                                                         <!--:key_value="`id`"-->
                                                         <!--:field_value="`admin_name`"-->
                                                         <!--:aspect_key_value="`id`"-->
                                                         <!--:aspect_field_value="`admin_name`"-->
                                                         <!--:index="index"-->
                                                         <!--:index2="index2"-->
                                                         <!--:index3="index3"-->
                                                         <!--:type="`multi`"-->
                                                         <!--:reference="`category_id`"-->
                                                         <!--:v_model="`category_id`"-->
                                                         <!--v-on:passDataToParent="select2"-->
                                                         <!--v-on:passDataToParentDeleteItem="DeleteFromSelect2"-->
                                                <!--&gt;</select4>-->
                                                <input v-model="condition.rule_value" v-else
                                                       type="text" class="dt2 control" />
                                            </th>
                                            <th width="5%">
                                                <i @click="removeCondition(index, index2, index3)" class="table_row_delete fa fa-trash"></i>
                                            </th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
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
        name: "mix-customize-section",
        props: ['condition_rule', 'page_title'],
        components: {

        },
        data() {
            return {
//                page_title: "Slider Settings",
                div_hide: false,
                attributes: [],
                sliders: [],
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
            this.getListAttribute()
            this.getAdvertisementData()
//            console.log(this.baseUrl)
        },
        methods: {
            onChange: function (index) {

            },
            apply_to_choose: function (val) {

                this.sections[val.parent_index].details[val.parent_index_details].image_url = val.image_path
                // image_path
                this.is_show_image_panel = false;
            },
            show_image_panel: function (index, index2) {
                this.selected_conditions = this.sections[index].details[index2].conditions;
                this.parent_index = index;
                this.parent_index_details = index2;
                this.is_show_image_panel = true;
            },
            visibility_image_Panel: function (val) {
                this.is_show_image_panel = val;
            },

            changeCondition: function(event, index, index2, index3) {
                let cur_obj = $(event.target.options[event.target.options.selectedIndex]).attr('data-value');
                let index4 = $(event.target.options[event.target.options.selectedIndex]).attr('index');

                this.sections[index].details[index2].conditions[index3].rule_array = this.condition_rule[cur_obj];

                if (cur_obj === 'multiselect' || cur_obj === 'select') {
//                    console.log(this.attributes[index3])
                    this.sections[index].details[index2].conditions[index3].options = this.attributes[index4].options
                }

                this.sections[index].details[index2].conditions[index3].is_multi = (cur_obj === 'multiselect' || cur_obj === 'select')

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
            addDetails: function (index) {
                console.log(index)
                this.sections[index].details.push({
                    tile: "",
                    slug: "",
                    image_url: "",
                    is_hide: false,
                    icon: 'minus',
                    conditions: []
                })
            },
            addCondition: function (index, index2) {
                console.log(index, index2)
                this.sections[index].details[index2].conditions.push({
                    label: "",
                    rule_array: [],
                    rule: "",
                    rule_value: "",
                    rule_value_multi: [],
                    is_select: false,
                    options: [],
                    is_multi: false
                })
            },
            removeCondition: function(index, index2, index3) {
                this.sections[index].details[index2].conditions.splice(index3, 1)
            },
            collapse: function(event, index) {
                this.sections[index].is_hide = !this.sections[index].is_hide

                if (this.sections[index].is_hide)
                    this.sections[index].icon = 'minus';
                else
                    this.sections[index].icon = 'plus'
            },
            collapse2: function(event, index, index2) {
                this.sections[index].details[index2].is_hide = !this.sections[index].details[index2].is_hide
                if (this.sections[index].details[index2].is_hide)
                    this.sections[index].details[index2].icon = 'minus';
                else
                    this.sections[index].details[index2].icon = 'plus'
            },
            addSlider: function () {
                console.log('aaa')
                this.sliders.push({
                    slug: '',
                    image: '',
                    image_name: '',
                    visibility: true,
                    title: '',
                    idd: 'id_' + this.sliders.length,
                    conditions: []
                })
            },

            getListAttribute: function (e) {
                let that = this;
                axios.get('/admin/catalog/attribute-options')
                    .then(function (response) {
                        that.attributes = response.data
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
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

            readURL: function(input, id) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#'+id).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            },
            on_change_Image: function(e, id) {
                this.readURL($(e.target)[0], id)
            },


            removeSlider: function(index) {
                this.sections.splice(index, 1)
            },
            removeSlider2: function(index, index2) {
                this.sections[index].details.splice(index2, 1)
            },

            submit : function(){

                let that = this;
//                let data = new FormData();
//                for (let i = 0; i < this.sliders.length; i++) {
//                    data.append(this.sliders[i].idd, document.getElementById(this.sliders[i].idd).files[0]);
//                }
//                data.append('data', JSON.stringify());

                axios.post('/admin/cms/mix-customize-section-save', {
                    data: this.sections
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

            removeImageDiv: function (index) {
                this.images.splice(index, 1);
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