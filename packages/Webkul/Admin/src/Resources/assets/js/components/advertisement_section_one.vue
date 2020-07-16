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
                            <i @click="click_to_delete_parent_row(parent_item_index)" class="trash fa fa-trash text-danger"></i>
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

                        </div>
                    </div>


                    <button @click="submit" type="button" class="btn btn-success">Save</button>
                </div>

            </div>
        </form>
    </div>
</template>

<script>

    import Select2 from './shared/Select2.vue';
    export default {
        name: "advertisement-section-one",
        props: ['page_title'],
        components: {
            select2: Select2
        },
        data() {
            return {
                attribute_select: "",
                condition_attributes2: {},
                parent_rows_iterate: [],
                rows_iterate: [{slug: "", categories: [], conditions: [], conditions_operator: []}],
                baseUrl: "",
                show_multi_select: false,
                categories: [],
                conditions: [],
                is_edit_mode: false,
                is_show_image_panel: false,
                parent_index: 0,
                under_parent_index: 0,
            }
        },
        updated() {
//          console.log(this.condition_attributes)
        },
        mounted() {

        },
        created() {
            this.loaded();
            this.getCategories();
        },
        methods: {
            select2: function (val) {
                this.parent_rows_iterate[val.index1].rows_iterate[val.index2]
                    .conditions[val.index3]['multi'].push(+val.val[val.key_value]);

            },

            select2Delete: function (val) {
                console.log(val)
                for (let child in this.parent_rows_iterate[val.index1].rows_iterate[val.index2]
                   .conditions[val.index3]['multi']) {
                    console.log(this.parent_rows_iterate[val.index1].rows_iterate[val.index2]
                        .conditions[val.index3]['multi'][child], val.val)
                    if (this.parent_rows_iterate[val.index1].rows_iterate[val.index2]
                            .conditions[val.index3]['multi'][child] == val.val) {
                        this.parent_rows_iterate[val.index1].rows_iterate[val.index2]
                            .conditions[val.index3]['multi'].splice(child, 1)
                    }
                }
//                this.parent_rows_iterate[val.index1].rows_iterate[val.index2]
//                    .conditions[val.index3]['multi'].push(+val.val[val.key_value]);

            },

            attribute_select_change: function (event, parent_item_index, index, nested_index) {
                let cur_obj = JSON.parse($(event.target.options[event.target.options.selectedIndex]).attr('data-value'));

                if (this.condition_attributes2[0].children[cur_obj].type === "multiselect" &&
                    this.condition_attributes2[0].children[cur_obj].label === "Categories" ) {
                    this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                        .conditions[nested_index].show_multi_select = 1;
                    console.log(this.condition_attributes2[0].children[cur_obj].options[0].children)
                } else if (this.condition_attributes2[0].children[cur_obj].type === "multiselect") {
                    console.log(this.condition_attributes2[0].children[cur_obj].options)
                    this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                        .conditions[nested_index].show_multi_select = 1;
                } else if (this.condition_attributes2[0].children[cur_obj].type === "select") {
                    console.log(this.condition_attributes2[0].children[cur_obj].options)
                    this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                        .conditions[nested_index].show_multi_select = 0;
                } else {
                    this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                        .conditions[nested_index].show_multi_select = 0;
                }
//                console.log('cur_obj', this.condition_attributes2[0].children[cur_obj]['options'])
                this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                    .conditions[nested_index].data_List = this.condition_attributes2[0].children[cur_obj]['options'];
                this.parent_rows_iterate[parent_item_index].rows_iterate[index]
                    .conditions[nested_index].conditions_operator = this.translation_array[this.condition_attributes2[0].children[cur_obj].type];

            },
            visibility_image_Panel: function (val) {
                this.is_show_image_panel = val;
            },
            apply_to_choose: function (val) {
                console.log(val)
                this.parent_rows_iterate[val.parent_index].rows_iterate[val.under_parent_index]
                    .image_url = val.image_path;
                this.is_show_image_panel = false;
            },
            click_to_delete_condition_row: function (parent_item_index, index, nested_index) {
                this.parent_rows_iterate[parent_item_index].rows_iterate[index].conditions.splice(nested_index, 1);
            },
            categories_selected: function (val) {

                let parse_arr = JSON.parse(this.parent_rows_iterate[val.index1].rows_iterate[val.index2]
                    .conditions[val.index3].rule_value_multi);
                console.log('parse_arr', parse_arr)
                let parse_arr2 = JSON.parse(parse_arr)
                console.log(parse_arr2.indexOf(+val.value.toString()))
                if (parse_arr2.indexOf(+val.value.toString()) === -1) {
                    parse_arr2.push(+val.value.toString())
                }
                console.log('parse_arr2', parse_arr2)
                this.parent_rows_iterate[val.index1].rows_iterate[val.index2].conditions[val.index3]
                    .rule_value_multi = JSON.stringify(JSON.stringify(parse_arr2))
            },
            click_to_delete_row: function (parent_item_index, index) {
                this.parent_rows_iterate[parent_item_index].rows_iterate.splice(parent_item_index, 1);
            },
            click_to_delete_parent_row: function (parent_item_index) {
                this.parent_rows_iterate.splice(parent_item_index, 1);
            },
            click_to_expand_parent_div: function (e) {

            },
            visibility_change: function (event, parent_item_index) {
//                console.log($(event))
                this.parent_rows_iterate[parent_item_index].is_visible =
                    (this.parent_rows_iterate[parent_item_index].is_visible == 1 ? 0 : 1);
                console.log(this.parent_rows_iterate[parent_item_index].is_visible)
            },
            click_to_add_row: function (parent_item_index) {
                //
                this.parent_rows_iterate[parent_item_index].rows_iterate.push({title: "", slug: "",
                    is_visible: 0, admin_url: "", categories: [], conditions: []});
            },
            click_to_add_parent_row: function (e) {
                this.parent_rows_iterate.push({
                    slug: "",
                    title: "",
                    subtitle: "",
                    rows_iterate: []
                });
            },

            loaded: function () {
                this.baseUrl = $("#base_url").attr("url");
                this.condition_attributes2 = this.condition_attributes
                this.getMixSections();
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

            getMixSections : function() {
                let that = this;
                axios.get(this.baseUrl + '/admin/cms/get-mix-section')
                    .then(function (response) {
                        let i = 0;
                        for (let parent in response.data) {
                            that.parent_rows_iterate.push({
                                slug: response.data[parent].slug,
                                admin_url: response.data[parent].admin_url,
                                subtitle: response.data[parent].subtitle,
                                is_visible: response.data[parent].is_visible,
                                title: response.data[parent].title,
                                rows_iterate: []
                            });
                            for (let row_iterate in response.data[parent]['rows_iterate']) {
                                if (row_iterate !== "") {
                                    that.parent_rows_iterate[i].rows_iterate
                                        .push(response.data[parent]['rows_iterate'][row_iterate])
                                }
                            }
                            i += 1;
                        }
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
                axios.post(this.baseUrl + '/admin/cms/mix-customize-section-save',
                    {data: this.parent_rows_iterate})
                    .then(data =>{
                        toastr.success(data.data);
                    })
                    .catch(error => {
                    });
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
</style>