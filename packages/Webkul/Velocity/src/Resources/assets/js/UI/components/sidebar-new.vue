<template>
    <div v-if="!isMobileView">
        <root v-bind:folder="sidebar_categories" v-bind:route_index="route_index"></root>
    </div>
    <div v-else>
            <div v-if="is_menu_visible" class="menu_open_mobile_view_category">
                <div class="top_menu_head">
                    <ul class="left">
                        <li @click="back($event)"><i class="fa fa-arrow-left"></i></li>
                        <li><span>Categories</span></li>
                    </ul>
                    <ul class="right">
                        <li><i class="fa fa-search"></i></li>
                        <li><i class="fa fa-shopping-cart"></i></li>
                        <li><i class="fa fa-ellipsis-v"></i></li>
                    </ul>
                </div>
                <div class="top_menu_body">
                    <ul>
                        <li v-for="(cat, index) in sidebar_categories[0].children">{{ cat.name }}</li>
                    </ul>
                </div>
            </div>
            <div class="full-width-static-footer">
                <ul>
                    <li>
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </li>
                    <li @click="click_cat_menu($event)">
                        <i class="fa fa-list"></i>
                        <span>Category</span>
                    </li>
                    <li>
                        <i class="fa fa-shopping-cart"></i>
                        <span class="">Cart</span>
                    </li>
                    <li>
                        <i class="fa fa-user"></i>
                        <span>Account</span>
                    </li>
                </ul>
            </div>
    </div>
</template>

<script>
    export default {
        name: "sidebar-new",
        props: ['route_index'],
        components: {

        },
        data() {
            return {
                'isMobileView': this.$root.isMobile(),
                sidebar_categories: [],
                is_menu_visible: false,
                category_enter_list: []
            }
        },
        mounted() {

        },
        created() {
            this.getData();
        },
        watch: {

        },
        methods: {
            back: function (event) {
                this.is_menu_visible = true;
                if ($(event.target).prop('tagName') == "I") {
                    this.category_enter_list.splice((this.category_enter_list.length-1), 1)
                    if (this.category_enter_list.length === 0) {
                        this.is_menu_visible = false;
                    }
                }

            },
            click_cat_menu: function (event) {
                this.is_menu_visible = true;
                if ($(event.target).prop('tagName') == "I") {
                    $($(event.target).parent().children()[1]).addClass('active');
                }
                else if ($(event.target).prop('tagName') == "SPAN") {
                    $(event.target).addClass('active');
                    this.category_enter_list.push({
                        id: 0
                    })
                }
            },
            getData: function (e) {
                let that = this;
                axios.get('/categories-front-data')
                    .then(function (response) {
                        that.sidebar_categories = that.TreeGen(response.data);
//                        console.log(that.sidebar_categories)
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },

            TreeGen: function (list) {
                let map = {}, node, roots = [], i;
                for (i = 0; i < list.length; i += 1) {
                    map[list[i]['id']] = i;
                    list[i]['children'] = [];
                }
                for (i = 0; i < list.length; i += 1) {
                    node = list[i];
                    if (node.parent_id !== 0) {
//                        console.log(node.parent_id)
                        if (list[map[node.parent_id]] !== undefined) {
                            list[map[node.parent_id]]['children'].push(node);
                        }
                    } else {
                        roots.push(node);
                    }
                }
                return roots;
            }

        },
        filters: {

        }
    }
</script>

<style scoped>

</style>
