<template>
    <div class="content">

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

                    <div v-for="(slider, index) in sliders" class="parent_div_of_custom_category">
                        <div class="accordion_header">Slider
                            <i @click="removeSlider(index)" class="section_delete fa fa-trash text-danger"></i>
                            <i @click="click_to_expand"
                               class="expand_div fa fa-angle-right"></i></div>
                        <div v-bind:class="div_hide ? 'accordion_body hide' : 'accordion_body'" >

                            <div class="form-group">
                                <label for="slider_title">Slider Title</label>
                                <input  type="text" class="dt2 control" v-model="slider.title"
                                        id="slider_title" placeholder="Slider Title">
                            </div>
                            <div class="form-group">
                                <label for="slider_slug">Slider Slug</label>
                                <input  type="text" class="dt2 control" v-model="slider.slug"
                                        id="slider_slug" placeholder="Slider Slug">
                            </div>
                            <div class="form-group">
                                <label for="slider_image">Slider Image</label>
                                <div class="image-wrapper">
                                    <label class="image-item has-image">
                                        <input type="hidden" name="images[image_1]">
                                        <input type="file" @change="on_change_Image($event, slider.idd+'_image')"
                                               accept="image/*" name="images[]" :id="`${slider.idd}`"
                                               multiple="multiple" aria-required="false" aria-invalid="false">
                                        <img :src="`/uploads/${slider.image}`" class="preview" alt="" :id="`${slider.idd}_image`" />
                                        <label @click="removeImageDiv(index)" class="remove-image">Remove Image</label>
                                    </label>
                                </div>
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th colspan="4">
                                        <button @click="addCondition(index)" type="button"
                                                class="btn btn-success text-left">Add new condition</button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(condition, index2) in slider.conditions">
                                    <th width="20%">
                                        <select v-model="condition.label" name=""
                                                @change="changeCondition($event, index, index2)"
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
                                                     track-by="admin_name"></multiselect>
                                        <input v-model="condition.rule_value" v-else
                                               type="text" class="dt2 control" />
                                    </th>
                                    <th width="5%">
                                        <i @click="removeCondition(index, index2)" class="table_row_delete fa fa-trash"></i>
                                    </th>
                                </tr>
                                </tbody>
                            </table>

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
        name: "advertisement-section-two",
        props: ['condition_rule', 'page_title'],
        components: {

        },
        data() {
            return {
//                page_title: "Slider Settings",
                div_hide: false,
                attributes: [],
                sliders: [],
            }
        },
        mounted() {

        },
        created() {
            this.getListAttribute();
            this.getAdvertisementData();
        },
        methods: {
            removeCondition: function(index, index2) {
                this.sliders[index].conditions.splice(index2, 1)
            },
            changeCondition: function(event, index, index2) {
                let cur_obj = $(event.target.options[event.target.options.selectedIndex]).attr('data-value');
                let index3 = $(event.target.options[event.target.options.selectedIndex]).attr('index');
                this.sliders[index].conditions[index2].rule_array = this.condition_rule[cur_obj];
                if (cur_obj === 'multiselect' || cur_obj === 'select') {
                    console.log(this.attributes[index3])
                    this.sliders[index].conditions[index2].options = this.attributes[index3].options
                }
                this.sliders[index].conditions[index2].is_multi = (cur_obj === 'multiselect' || cur_obj === 'select')
                console.log(this.condition_rule[cur_obj], cur_obj)
            },
            addCondition: function (index) {
                this.sliders[index].conditions.push({
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
                axios.get('/admin/cms/get-advertisement-section-two')
                    .then(function (response) {
                        that.sliders = response.data
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
                this.sliders.splice(index, 1)
            },

            submit : function(){

                let that = this;
                let data = new FormData();
                for (let i = 0; i < this.sliders.length; i++) {
                    data.append(this.sliders[i].idd, document.getElementById(this.sliders[i].idd).files[0]);
                }
                data.append('data', JSON.stringify(this.sliders));

                axios.post('/admin/cms/update-advertisement-section-two', data)
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