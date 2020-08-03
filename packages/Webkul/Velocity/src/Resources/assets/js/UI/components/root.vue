<template>
    <ul :class="`top_category_menu ${route_index == 'shop.home.index' ? '' : 'while_float2 hide'}`">
        <folder v-bind:folder="folder.length > 0 ? folder[0] : []"></folder>
    </ul>
</template>

<script>
    import folder from './folder.vue';
    export default {
        name: "root",
        props: ['folder', 'route_index'],
        components: {
            folder: folder
        },
        data() {
            return {

            }
        },
        mounted() {

        },
        created() {

        },
        methods: {
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
