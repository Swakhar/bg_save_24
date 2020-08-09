<template>
    <div :ref="reference" class="select2 dt">
        <div class="data-select2-section dt">
            <span v-if="type==='single'" class="btnn dt">
                {{ active_btn }}
                <i @click="remove_btn2($event)" class="fa fa-times"></i>
            </span>
            <span v-else v-for="(li, index) in array_included" class="btnn dt">
                {{ li[aspect_field_value] }}
                <i @click="remove_btn(index, li[aspect_key_value])" class="fa fa-times"></i>
            </span>
        </div>
        <input @focus="focus_in" v-model="typing" type="text" class="form-control dt custom_control"
               @keyup="keyup_in"
                id="name" placeholder="Name">
        <ul :ref="`${reference}_ul`" class="dt hide">
            <li class="dt" @click="li_click" v-for="item in items" :data-value="`${item[key_value]}`">{{ item[field_value] }}</li>
        </ul>
    </div>
</template>

<script>

    export default {
        name: "select2",
        props: ['items', 'key_value', 'field_value', 'aspect_key_value', 'aspect_field_value',
            'type', 'reference', 'v_model', 'included_data', 'index1', 'index2', 'index3'],
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
            this.in_create();

        },
        methods: {
            beforeLoad: function () {
                $(document).click(function(e) {
                    var dt_cl = $(".dt_cl");
                    var container = $(".dt");
                    this.show_shared = !this.show_shared
//                    console.log(container.is(e.target), container.has(e.target).length)
                    if(!container.is(e.target) &&
                        container.has(e.target).length === 0) {
                        $(".select2 ul").addClass('hide');
                    }
                });


//                console.log(this.type, this.included_data)
            },
            in_create: function () {
                for (let item in this.items) {
                    for (let child in this.included_data) {
                        if (this.items[item][this.key_value] == this.included_data[child]) {
                            this.array_included.push(this.items[item])
                        }
                    }
//                    if (this.items[item][this.key_value] == ) {
//
//                    }
                }
//                console.log(this.included_data)
//                if (this.type === 'multi') {
//                    this.array_included = this.included_data;
//                } else {
//                    this.active_btn = this.included_data;
//                }
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
//                console.log(this.array_included)
            },
            remove_btn: function (index, delete_item) {
                this.array_included.splice(index, 1);
                this.already_included.slice(this.already_included.indexOf(+delete_item), 1);
                this.$emit('passDataToParentDeleteItem', {
                    val: delete_item,
                    v_model: this.v_model,
                    type: this.type,
                    aspect_key_value: this.aspect_key_value,
                    index1: this.index1,
                    index2: this.index2,
                    index3: this.index3,
                })
            },
            remove_btn2: function (e) {
                $(e.target).parent().remove()
            },
            li_click: function (e) {
                if (this.type === 'single') {
//                    console.log('single')
                    this.active_btn = $(e.target).html()
//                    console.log(this.v_model)
//                    this.$emit('passDataToParent', {val: $(e.target).attr("data-value"),
//                        v_model: this.v_model, type: this.type,
//                        html_val: $(e.target).html(),
//                        aspect_key_value: this.aspect_key_value,
//                        aspect_field_value: this.aspect_field_value,})
                } else {
                    if (this.already_included.indexOf($(e.target).attr("data-value")) === -1) {
                        this.array_included.push({
                            [this.aspect_field_value]: $(e.target).html(),
                            [this.aspect_key_value]: $(e.target).attr("data-value")
                        });
                        this.already_included.push(+$(e.target).attr("data-value"));
                        let val = {
                            [this.aspect_key_value]: $(e.target).attr("data-value"),
                            [this.aspect_field_value]: $(e.target).html(),
                        };
//                        console.log(val)

                        this.$emit('passDataToParent', {
                            val: val,
                            v_model: this.v_model,
                            type: this.type,
                            key_value: this.key_value,
                            field_value: this.field_value,
                            index1: this.index1,
                            index2: this.index2,
                            index3: this.index3,
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
    span.btnn.dt {
        background: #524BCC;
        color: white;
        margin: 2px;
        display: inline-block;
        padding: 3px;
    }
    span.btnn.dt i {
        color: #b90a0a;
        cursor: pointer;
        font-size: 20px;
    }
    input {
        width: 86%;
    }
    div.select2 {

    }
    div.select2 ul {
        position: absolute;
        background: white;
        z-index: 999;
        width: 300px;
        box-shadow: 1px 1px 4px 1px grey;
        padding-left: 1px;
        height: 200px;
        overflow-y: scroll;
    }
    div.select2 ul li {
        list-style: none;

        margin: 3px 0;
        padding: 3px 10px;
        cursor: pointer;
    }
    div.select2 ul li:hover {
        background: aliceblue;
    }
</style>
