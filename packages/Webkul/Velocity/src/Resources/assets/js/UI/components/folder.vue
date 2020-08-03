<template>
    <li v-if="folder.parent_id === 1 || folder.parent_id === 0" :p_t="folder.parent_id"
        :class="`folder${folder.parent_id === 1 ? ' sel' : (folder.parent_id === 0 ? '' : ' position_div_1')}`"

        >
        <a class="cat_hideve" v-if="folder.parent_id > 0"
           @mouseover="mouseOverLi('ref_'+folder.id, $event, folder.parent_id, index)" :href="folder.slug">
            <img class="category_logo"
                          :src="`/cache/original/${folder.category_icon_path}`" alt="" />

            <span :title="folder.name" :class="`${folder.parent_id === 1 ? 'li_span_cat_menu' :
            'cat_hideve'}`">{{ folder.name.length > 32 ? folder.name.substr(0, 28) + '...' : folder.name }}</span>
            <i v-if="folder.parent_id > 0 && folder.children.length > 0"
               @mouseover="mouseOverLi('ref_'+folder.id, $event, folder.parent_id, index)"
               class="category_angle fa fa-angle-right" aria-hidden="true"></i>
        </a>

        <ul :lop="folder.parent_id" :ref="'ref_'+folder.id" :class="`${folder.parent_id === 1 ? 'sub-folders hide'
        : (folder.parent_id == 0 ? '' : 'top_category_menu2')}`"
            @mouseleave="mouseleaveLi($event)"
            v-if="folder.children && folder.children.length > 0" >
            <folder :class="index > 9 ? 'hide must_hide' : ''"
                    v-bind:index="index"
                    :key="'a'+index" v-for="(child, index) in folder.children"
                    v-bind:folder="child"></folder>
            <li @click="clickToExpand($event)" :class="`folder sel`"
                v-if="folder.parent_id === 0"
                style="border-top: 1px solid gray;padding-left: 7px;border-bottom: 1px solid gray;cursor:pointer">

                    <i class="fa fa-plus expand-ii" style="color: black;
                    border: 1px solid gray;
                    font-size: 13px;
                    padding: 2px;margin-right: 3px;"></i>
                    <span  title="More Categories" class="li_span_cat_menu">More Categories</span>
            </li>
        </ul>

    </li>

    <div v-else :class="`div_it_side_menu cat_hideve ${folder.children.length > 0 ? 'have_child' : ''} `">
        <a :class="`folder div_it_side_menu_a ${folder.children.length > 0 ? 'have_child' : ''}`"
           :href="'/'+folder.slug">{{ folder.name }}</a>
        <folder :class="index > 9 ? 'hide must_hide' : ''"
                v-bind:index="index"
                :key="'a'+index" v-for="(child, index) in folder.children"
                v-bind:folder="child"></folder>
    </div>

</template>

<script>

    export default {
        name: "folder",
        props: ['folder', 'index'],
        components: {

        },
        data() {
            return {

            }
        },
        mounted() {

        },
        created() {

        },
        updated() {
            this.advanceClassAssingn()
        },
        methods: {
            mouseleaveLi(event) {
            },
            mouseOverLi(ref, event, parent_id, index) {
                event.stopPropagation();
                if (parent_id === 1) {
                    $('.sub-folders').each(function(i, obj) {
                        $(this).addClass('hide')
                    });
                    if ($(event.target).prop("tagName") == "A") {
                        $($(event.target).parent().children()[1]).removeClass('hide');
                        $($(event.target).parent().children()[1]).css("top", "-"+ ((index)*43+21) + 'px');
                    }
                    if ($(event.target).prop("tagName") == "SPAN") {
                        $($(event.target).parent().parent().children()[1]).removeClass('hide');
                        $($(event.target).parent().parent().children()[1]).css("top", "-"+ ((index)*43+21) + 'px');
                    }
                    if ($(event.target).prop("tagName") == "I") {
                        $($(event.target).parent().parent().children()[1]).removeClass('hide');
                        $($(event.target).parent().parent().children()[1]).css("top", "-"+ ((index)*43+21) + 'px');
                    }
                }
            },
            advanceClassAssingn: function() {
                $('.sub-folders').each(function(i, obj) {
                    let childs = $(this).children();
                    let k = 0;
                    let div2 = document.createElement("div");
                    div2.className = 'float_left_parent2';
                    let div = [];
                    for (let j = 0; j < childs.length/2; j++) {
                        div[j] = document.createElement("div");
                        div[j].className = 'float_left_parent';
                    }
                    for (let j = 0; j < childs.length; j++) {
                        $($(childs[j]).children()[0]).addClass('head_a');
                        console.log(Math.floor(j/2))
                        div[Math.floor(j/2)].appendChild(childs[j]);
                    }
                    for (let j = 0; j < div.length; j++) {
                        div2.appendChild(div[j])
                    }
                    console.log(div2)
                    $(this).children().remove()
                    $(this).append(div2)

                });
            },
            clickToExpand: function(event) {
                event.preventDefault();
                console.log()
                //expand-ii
                if ($(event.target).prop("tagName") == "LI") {
                    if ($($(event.target).children()[0]).hasClass('fa-plus')) {
                        $($(event.target).children()[0]).removeClass('fa-plus').addClass('fa-minus');
                        $($(event.target).children()[1]).html('Close Menu')
                    } else {
                        $($(event.target).children()[0]).removeClass('fa-minus').addClass('fa-plus');
                        $($(event.target).children()[1]).html('More Categories')
                    }
                } else if ($(event.target).prop("tagName") == "SPAN") {
                    if ($($(event.target).parent().children()[0]).hasClass('fa-plus')) {
                        $($(event.target).parent().children()[0]).removeClass('fa-plus').addClass('fa-minus');
                        $($(event.target).parent().children()[1]).html('Close Menu')
                    } else {
                        $($(event.target).parent().children()[0]).removeClass('fa-minus').addClass('fa-plus');
                        $($(event.target).parent().children()[1]).html('More Categories')
                    }
                }

                $('.must_hide').each(function(i, obj) {
                    if ($(this).hasClass('hide')) {
                        $(this).removeClass('hide')
                    } else {
                        $(this).addClass('hide')
                    }
                });

                $("ul.sub-folders").height($("ul.top_category_menu li ul").height())
            },
            expand() {
                if (this.folder.leaf) {
                    return;
                }

                this.folder.expanded = !this.folder.expanded;
            }
        },
        filters: {

        }
    }
</script>

<style scoped>

</style>
