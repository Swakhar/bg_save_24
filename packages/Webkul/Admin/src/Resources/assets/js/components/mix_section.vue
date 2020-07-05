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
                    <button type="button" @click="click_to_add_parent_row"
                            class="btn btn-warning add_new_category"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="page-content">
                <div class="control-group">

                    <div class="parent_div_of_custom_category"
                         v-for="(parent_item_row, parent_item_index) in parent_rows_iterate">
                        <div class="parent_div_of_custom_category_header">
                            <span class="panel_head_name panel_title_0"></span>
                            <i @click="click_to_expand_parent_div" class="expand_div fa fa-plus"></i>
                            <i @click="click_to_delete_parent_row" class="trash fa fa-trash text-danger"></i>
                        </div>
                        <div class="hide parent_div_of_custom_category_body">
                            <div class="button_section">
                                <button type="button" @click="click_to_add_row(parent_item_index)" id="add_new_category"
                                        class="btn btn-warning add_new_category"><i class="fa fa-plus"></i></button>
                            </div>

                            <div class="custom_control_group">
                                <div class="left_custom_control">
                                    <label for="">Title</label>
                                </div>
                                <div class="right_custom_control">
                                    <input @keyup="parent_slug_generate($event, parent_item_index)"
                                           v-model="parent_item_row.title" class="dt2 custom_control" />
                                </div>
                            </div>

                            <div class="custom_control_group">
                                <div class="left_custom_control">
                                    <label for="">Sub-Title</label>
                                </div>
                                <div class="right_custom_control">
                                    <input v-model="parent_item_row.subtitle" class="dt2 custom_control" />
                                </div>
                            </div>

                            <div class="custom_control_group">
                                <div class="left_custom_control">
                                    <label for="">Slug</label>
                                </div>
                                <div class="right_custom_control">
                                    <input v-model="parent_item_row.slug" class="dt2 custom_control" />
                                </div>
                            </div>


                            <div class="category_select_group" v-for="(item, index) in parent_item_row.rows_iterate">
                                <div class="category_select_header">
                                    <span class="panel_head_name panel_title_0"></span>
                                    <i class="expand_div fa fa-plus"></i>
                                    <i @click="click_to_delete_row" class="trash fa fa-trash text-danger"></i>
                                </div>

                                <div class="category_select_body hide">
                                    <div class="custom_control_group">
                                        <div class="left_custom_control">
                                            <label for="">Title</label>
                                        </div>
                                        <div class="right_custom_control">
                                            <input @keyup="under_parent_slug_generate($event, parent_item_index, index)" v-model="item.title" class="dt2 custom_control" />
                                        </div>
                                    </div>

                                    <div class="custom_control_group">
                                        <div class="left_custom_control">
                                            <label for="">Slug</label>
                                        </div>
                                        <div class="right_custom_control">
                                            <input v-model="item.slug" class="dt2 custom_control" />
                                        </div>
                                    </div>

                                    <div class="custom_control_group" v-for="(item_cond, nested_index) in item.conditions">
                                        <div class="inline_form_3_col">
                                            <select v-model="item_cond.rule_type" class="control"
                                                    @change="attribute_select_change($event, parent_item_index, index, nested_index)"
                                                    name="" id="">
                                                <option :data-type="attr_item.label" :value="JSON.stringify({
                                    key: attr_item.key,
                                    type: attr_item.type,
                                    label: attr_item.label
                                    })"
                                                        v-for="attr_item in condition_attributes2[0].children">{{ attr_item.label }}</option>
                                            </select>
                                        </div>
                                        <div class="inline_form_3_col">
                                            <select v-model="item_cond.rule_operator" name="" class="control">
                                                <option v-for="cond in item_cond.conditions_operator" :value="cond.operator">{{ cond.label }}</option>
                                            </select>
                                        </div>
                                        <div class="inline_form_3_col">
                                            <multi-select v-if="item_cond.showMultiSelect" v-on:passDataChildToParent="categories_selected"
                                                          :index1="parent_item_index"
                                                          :index2="index"
                                                          :index3="nested_index"
                                                          :items="categories"></multi-select>
                                            <input  v-model="item_cond.rule_value" v-else  type="text" class="control">

                                            <i @click="click_to_delete_condition_row(parent_item_index, index, nested_index)"
                                               class="trash-condition fa fa-trash text-danger"></i>
                                        </div>
                                    </div>

                                    <button type="button" @click="item.conditions.push({
                            rule_type: '',
                            rule_operator: '',
                            rule_value: '',
                            conditions_operator: [],
                            showMultiSelect: false
                            })" class="btn btn-btn-success change_cond">Add Condition</button>
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
        props: ['translation_array', 'condition_attributes', 'page_title', 'route'],
        components: {

        },
        data() {
            return {
                attribute_select: "",
                condition_attributes2: {},
                parent_rows_iterate: [],
                rows_iterate: [{slug: "", categories: [], conditions: [], conditions_operator: []}],
                baseUrl: "",
                showMultiSelect: false,
                categories: [],
                conditions: [],
            }
        },
        mounted() {

        },
        created() {
            this.loaded();
            this.getCategories();
        },
        methods: {
            click_to_delete_condition_row: function (parent_item_index, index, nested_index) {
                this.parent_rows_iterate[parent_item_index].rows_iterate[index].conditions.splice(nested_index, 1);
            },
            categories_selected: function (val) {
                let v = JSON.parse(this.parent_rows_iterate[val.index1].rows_iterate[val.index2].conditions[val.index3]
                    .rule_value);
                v.push(this.parent_rows_iterate[val.index1].rows_iterate[val.index2].conditions[val.index3]
                    .rule_value)
                this.parent_rows_iterate[val.index1].rows_iterate[val.index2].conditions[val.index3]
                    .rule_value = JSON.stringify(v);
            },
            click_to_delete_row: function (e) {

            },
            click_to_delete_parent_row: function (e) {

            },
            click_to_expand_parent_div: function (e) {

            },
            click_to_add_row: function (parent_item_index) {
                this.parent_rows_iterate[parent_item_index].rows_iterate.push({title: "", slug: "", categories: [], conditions: []});
            },
            click_to_add_parent_row: function (e) {
                this.parent_rows_iterate.push({
                    slug: "",
                    title: "",
                    subtitle: "",
                    rows_iterate: [{slug: "", categories: [], conditions: []}]
                });
//                this.rows_iterate.push({slug: "", categories: [], conditions: []})
            },
            attribute_select_change: function (event, parent_item_index, index, nested_index) {
                let cur_obj = JSON.parse(event.target.options[event.target.options.selectedIndex].value);
                this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                    .conditions[nested_index].conditions_operator = this.translation_array[cur_obj.type];

                if (cur_obj.label ===  "Categories") {
                    this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                        .conditions[nested_index].showMultiSelect = true;
                } else {
                    this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                        .conditions[nested_index].showMultiSelect = false;
                }
            },
            loaded: function () {
                this.baseUrl = $("#base_url").attr("url");
                this.condition_attributes2 = this.condition_attributes
            },

            getCategories : function() {
                let that = this;
                axios.get(this.baseUrl + '/category-list')
                .then(function (response) {
                    that.categories = response.data.categories
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },

            parent_slug_generate : function(event, parent_item_index) {
                this.parent_rows_iterate[parent_item_index].slug = $(event.target).val().toLowerCase().split(' ').join('-')
                    .split(/[.,\/ -&]/).join('').split('--').join('-')
            },
            under_parent_slug_generate : function(event, parent_item_index, index) {
                this.parent_rows_iterate[parent_item_index].rows_iterate[index].slug = $(event.target).val().toLowerCase().split(' ').join('-')
                    .split(/[.,\/ -&]/).join('')
                    .split('--').join('-')
            },

            submit : function() {
                let that = this;
                console.log(this.parent_rows_iterate)
//                axios.post(this.baseUrl + '/admin/api/attribute-add', {
//                    basic_data: that.data_value,
//                    is_empty_option: this.is_empty_option,
//                    total_options: this.total_options
//                })
//                    .then(data =>{
//                        toastr.success(data.data);
//                    })
//                    .catch(error => {
//                        let msgg = "";
//                        for (let msg in error.response.data.errors) {
//                            msgg += error.response.data.errors[msg][0] + "<br>";
//                        }
//                        toastr.error(msgg);
//                    });
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
</style>