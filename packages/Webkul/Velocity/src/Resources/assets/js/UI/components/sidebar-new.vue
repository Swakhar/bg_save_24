<template>
    <div>
        <root v-bind:folder="sidebar_categories" v-bind:route_index="route_index"></root>
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
                sidebar_categories: []
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
