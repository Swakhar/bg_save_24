<template>
    <div class="dt parent_multi_select">
        <div class="dt div_to_add_button" @click="focus_parent">
            <input v-model="typing_input" @keyup="typing_input_keyup"
                   @focus="focus_parent"
                   class="dt custom_control" style="width: 20px;border: none;" type="text" placeholder="">
        </div>

        <ul class="hide dt">
            <li @click="li_click" class="dt" :data-value="item.id" v-for="item in items">{{item.name}}</li>
        </ul>
    </div>
</template>

<script>

    export default {
        name: "multi-select",
        props: ['items', 'index1', 'index2', 'index3', 'rule_value_multi'],
        components: {

        },
        data() {
            return {
                typing_input: ""
            }
        },
        mounted() {

        },
        updated() {
            this.editPortionMultiSelect()
        },
        created() {
//            this.editPortionMultiSelect()
        },
        methods: {
            editPortionMultiSelect: function () {
                if (this.typing_input === "") {
                    let multi_value = JSON.parse(this.rule_value_multi);

                    for (let itm in multi_value) {
                        for (let main_arry in this.items) {
                            if ((+multi_value[itm]) == this.items[main_arry].id) {
                                var btn = document.createElement("button");
                                var icon = document.createElement("i");
                                var input_hidden = document.createElement("input");
                                input_hidden.type= "hidden";

                                icon.className = "fa fa-times";
                                btn.className = "multi_select_btn";

                                icon.addEventListener("click", function (ee) {
                                    ee.target.parentNode.parentNode.removeChild(ee.target.parentNode);
                                });

                                btn.innerHTML = this.items[main_arry].name;
                                btn.appendChild(icon);
                                btn.appendChild(input_hidden);
                                console.log(btn);
                                $(".div_to_add_button").append(btn);
                                this.$emit('passDataChildToParent', {
                                    index1: this.index1,
                                    index2: this.index2,
                                    index3: this.index3,
                                    value: this.items[main_arry].id
                                })
                            }
                        }

                    }
                }

            },

            focus_parent: function (e) {
                let tag = $(e.target).prop("tagName");
                if (tag === "INPUT") {
                    $(e.target).parent().parent().find("ul").removeClass("hide")
                } else if (tag === "DIV") {
                    $(e.target).find("input.custom_control").focus();
                }
            },

            typing_input_keyup: function (e) {
                let children = $(e.target).parent().parent().find("ul").children();
                for (let i = 0; i < children.length; i++) {
                    if ($(children[i]).html().toLowerCase().indexOf($(e.target).val().toLowerCase()) > -1) {
                        $(children[i]).removeClass("hide")
                    } else {
                        $(children[i]).addClass("hide")
                    }
                }
                $(e.target).css('width', (this.typing_input.length*9)+20+"px")
            },

            li_click: function (e) {
                var btn = document.createElement("button");
                var icon = document.createElement("i");
                var input_hidden = document.createElement("input");
                input_hidden.type= "hidden";

                icon.className = "fa fa-times";
                btn.className = "multi_select_btn";

                icon.addEventListener("click", function (ee) {
                    ee.target.parentNode.parentNode.removeChild(ee.target.parentNode);
                });

                btn.innerHTML = $(e.target).html();
                btn.appendChild(icon);
                btn.appendChild(input_hidden);
                $(e.target).parent().parent().find("div.div_to_add_button").append(btn);
                this.$emit('passDataChildToParent', {
                    index1: this.index1,
                    index2: this.index2,
                    index3: this.index3,
                    value: $(e.target).attr("data-value")
                })
            }
        },
        filters: {

        }
    }
</script>

<style scoped>
    .parent_multi_select {
        position: relative;
        padding: 10px 0;
    }
    .parent_multi_select ul {
        position: absolute;
        background: white;
        z-index: 9999999;
        box-shadow: 1px 1px 4px 1px grey;
        width: 100%;
        padding: 10px;
        height: 200px;
        overflow-y: scroll;
    }
    .parent_multi_select ul li {
        border-bottom: 1px solid gray;
        padding: 2px 0;
        display: block;
        width: 100%;
        cursor: pointer;
    }
    .parent_multi_select ul li:hover {
        background: #557E99;
        color: white;
    }
    .parent_multi_select .div_to_add_button {
        border: 1px solid #808080b5;
        border-radius: 5px;
    }
</style>