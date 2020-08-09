<template>
    <div :ref="reference" class="select2 dt">
        <div class="data-select2-section dt">
            <span v-if="type==='single'" class="btnn dt">
                {{ active_btn }}
                <i @click="remove_btn2($event)" class="fa fa-times"></i>
            </span>
            <span v-else v-for="(li, index) in included_data" class="btnn dt">
                {{ li[aspect_field_value] }}
                <i @click="remove_btn(index, li[aspect_key_value])" class="fa fa-times"></i>
            </span>
        </div>
        <input @focus="focus_in" v-model="typing" type="text" class="control dt"
               @keyup="keyup_in"
                id="name" placeholder="Name">
        <ul :ref="`${reference}_ul`" class="dt hide">
            <li class="dt" @click="li_click" v-for="item in items" :data-value="`${item[key_value]}`">{{ item[field_value] }}</li>
        </ul>
    </div>
</template>

<script>

    export default {
        name: "select4",
        props: ['items', 'key_value', 'field_value', 'aspect_key_value', 'aspect_field_value',
            'type', 'reference', 'v_model', 'included_data', 'index', 'index2', 'index3'],
        components: {

        },
        data() {
            return {
                typing: "",
                checked: false,
                array_included: [],
                already_included: [],
                active_btn: ''
            }
        },
        mounted() {
//            console.log(this.configuration)
        },
        updated() {
            this.beforeLoad()
        },
        created() {

        },
        methods: {
            beforeLoad: function () {
                $(document).click(function(e) {
                    var dt_cl = $(".dt_cl");
                    var container = $(".dt");
                    this.show_shared = !this.show_shared
                    if(!container.is(e.target) &&
                        container.has(e.target).length === 0) {
                        console.log(222)
                        $(".select2 ul").addClass('hide');
                    }
                });
                if (this.type === 'multi') {
                    this.array_included = this.included_data;
                } else {
                    this.active_btn = this.included_data;
                }
//                console.log(this.type, this.included_data)
            },
            keyup_in: function (e) {
                $(e.target).val();
                let child = $(e.target).parent().find('ul').children();
                for (let i = 0; i < child.length; i++) {
                    if ($(child[i]).html().toLowerCase().indexOf($(e.target).val().toLowerCase()) > -1) {
                        $(child[i]).removeClass('hide');
                    } else {
                        $(child[i]).addClass('hide');
                    }
                }
            },
            focus_in: function (e) {
                $(e.target).parent().find('ul').removeClass('hide')
            },
            remove_btn: function (index, delete_item) {
                console.log('')
                this.array_included.splice(index, 1);
                this.$emit('passDataToParentDeleteItem', {
                    val: delete_item,
                    v_model: this.v_model,
                    type: this.type,
                    index: this.index,
                    index2: this.index2,
                    index3: this.index3,
                    aspect_key_value: this.aspect_key_value,
                })
            },
            remove_btn2: function (e) {
                $(e.target).parent().remove()
            },
            li_click: function (e) {
                if (this.type === 'single') {
//                    console.log('single')
                    this.active_btn = $(e.target).html()
                    this.$emit('passDataToParent', {
                        val: {
                            id: $(e.target).attr("data-value"),
                            admin_name: $(e.target).html()
                        },
                        v_model: this.v_model,
                        type: this.type,
                        index: this.index,
                        index2: this.index2,
                        index3: this.index3,
                        html_val: $(e.target).html(),
                        aspect_key_value: this.aspect_key_value,
                        aspect_field_value: this.aspect_field_value,})
                } else {
                    if (this.already_included.indexOf($(e.target).attr("data-value")) === -1) {
//                        this.array_included.push({
//                            [this.aspect_field_value]: $(e.target).html()
//                        });
                        this.already_included.push($(e.target).attr("data-value"));
                        let val = {
                            [this.aspect_key_value]: $(e.target).attr("data-value"),
                            [this.aspect_field_value]: $(e.target).html(),
                        };

                        this.$emit('passDataToParent', {
                            val: {
                                id: $(e.target).attr("data-value"),
                                admin_name: $(e.target).html()
                            },
                            v_model: this.v_model,
                            type: this.type,
                            index: this.index,
                            index2: this.index2,
                            index3: this.index3,
                            key_value: this.key_value,
                            field_value: this.field_value,
                        })
                    }
                }


//                this.$refs[this.reference].append();
            },
            cur_click: function (item) {
                this.$emit('passDataPaginateToParent', item)
            },

        },
        filters: {

        }
    }
</script>

<style scoped>

</style>
