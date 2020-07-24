<template>
    <div>
        <ul v-if="slicedCategories && slicedCategories.length > 0">
            <li  v-for="(cat, index) in slicedCategories">
                <a :href="`${$root.baseUrl}/${cat.slug}`">{{ cat.name }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "sidebar-new",
        props: [
            'id',
            'addClass',
            'parentSlug',
            'mainSidebar',
            'categoryCount'
        ],
        components: {

        },
        data() {
            return {
                more_menu_txt: 'More Categories',
                more_menu_icon: 'plus',
                slicedCategories: [],
                moreSlicedCategories: [],
                sidebarLevel: Math.floor(Math.random() * 1000),
            }
        },
        mounted() {

        },
        created() {
//            this.formatCategories();
        },
        watch: {
            '$root.sharedRootCategories': function (categories) {
                this.formatCategories(categories);
            }
        },
        methods: {

            formatCategories: function (categories) {
                let slicedCategories = categories;
                //let categoryCount = this.categoryCount ? this.categoryCount : 13;
                let categoryCount = 10;
                let moreSlicedCategories;

                console.log('categoryCount', categories)

                if (
                    slicedCategories
                    && slicedCategories.length > categoryCount
                ) {
                    slicedCategories = categories.slice(0, categoryCount);
                }

                if (categories.length > 10) {

                    console.log((10, categories.length))
                    moreSlicedCategories = categories.slice(10, categories.length);
                }

                this.moreSlicedCategories = moreSlicedCategories;

                console.log('aaa', this.moreSlicedCategories)
                if (this.parentSlug)
                    slicedCategories['parentSlug'] = this.parentSlug;

                this.slicedCategories = slicedCategories;
            },

        },
        filters: {

        }
    }
</script>

<style scoped>

</style>
