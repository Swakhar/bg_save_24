<template>
    <!-- categories list -->
    <!--$("#sidebar-level-0").removeClass("to_show");-->
    <nav
        :id="id"
        @mouseover="remainBar(id)"
        :class="`sidebar ${addClass ? addClass : ''}`"
        v-if="slicedCategories && slicedCategories.length > 0">

        <ul type="none" class="side-nav-ul">
            <li
                :key="categoryIndex"
                :id="`category-${category.id}`"
                class="category-content cursor-pointer"
                @mouseout="toggleSidebar(id, $event, 'mouseout')"
                @mouseover="toggleSidebar(id, $event, 'mouseover')"
                v-for="(category, categoryIndex) in slicedCategories">

                <a
                    :href="`${$root.baseUrl}/${category.slug}`"
                    :class="`category unset ${(category.children.length > 0) ? 'fw6' : ''}`">

                    <div
                        class="category-icon"
                        @mouseout="toggleSidebar(id, $event, 'mouseout')"
                        @mouseover="toggleSidebar(id, $event, 'mouseover')">

                        <img
                            v-if="category.category_icon_path"
                            :src="`${$root.baseUrl}/storage/${category.category_icon_path}`" />
                    </div>

                    <span class="category-title category-title-level1">{{ category['name'] }}</span>

                    <i
                        class="rango-arrow-right pr15 pull-right"
                        @mouseout="toggleSidebar(id, $event, 'mouseout')"
                        @mouseover="toggleSidebar(id, $event, 'mouseover')"
                        v-if="category.children.length && category.children.length > 0">
                    </i>
                </a>

                <div
                    class="com sub-category-container"
                    v-if="category.children.length && category.children.length > 0">

                    <div
                        @mouseout="toggleSidebar(id, $event, 'mouseout')"
                        @mouseover="remainBar(`sidebar-level-${sidebarLevel+categoryIndex}`)"
                        :class="`sub-categories sub-category-${sidebarLevel+categoryIndex} cursor-default`">

                        <nav
                            class="sidebar"
                            :id="`sidebar-level-${sidebarLevel+categoryIndex}`"
                            @mouseover="remainBar(`sidebar-level-${sidebarLevel+categoryIndex}`)">

                            <ul type="none" class="com">
                                <li class="com"
                                    :key="`${subCategoryIndex}-${categoryIndex}`"
                                    v-for="(subCategory, subCategoryIndex) in category.children">

                                    <a
                                        :id="`sidebar-level-link-2-${subCategoryIndex}`"
                                        @mouseout="toggleSidebar(id, $event, 'mouseout')"
                                        :href="`${$root.baseUrl}/${category.slug}/${subCategory.slug}`"
                                        :class="`com category sub-category unset ${(subCategory.children.length > 0) ? 'fw6' : ''}`">

                                        <div
                                            class="com category-icon"
                                            @mouseout="toggleSidebar(id, $event, 'mouseout')"
                                            @mouseover="toggleSidebar(id, $event, 'mouseover')">

                                            <img class="com"
                                                v-if="subCategory.category_icon_path"
                                                :src="`${$root.baseUrl}/storage/${subCategory.category_icon_path}`" />
                                        </div>
                                        <span class="com category-title category-title-level23">{{ subCategory['name'] }}</span>
                                    </a>

                                    <ul type="none" class="nested com">
                                        <li class="com"
                                            :key="`${childSubCategoryIndex}-${subCategoryIndex}-${categoryIndex}`"
                                            v-for="(childSubCategory, childSubCategoryIndex) in subCategory.children">

                                            <a
                                                :id="`sidebar-level-link-3-${childSubCategoryIndex}`"
                                                :class="`com category unset ${(subCategory.children.length > 0) ? 'fw6' : ''}`"
                                                :href="`${$root.baseUrl}/${category.slug}/${subCategory.slug}/${childSubCategory.slug}`">
                                                <span class="com category-title category-title-level2">{{ childSubCategory.name }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </li>
        </ul>

        <ul id="more_categories" type="none" class="hide side-nav-ul">
            <li
                    :key="categoryIndex"
                    :id="`category-${category.id}`"
                    class="category-content cursor-pointer"
                    @mouseout="toggleSidebar(id, $event, 'mouseout')"
                    @mouseover="toggleSidebar(id, $event, 'mouseover')"
                    v-for="(category, categoryIndex) in moreSlicedCategories">

                <a
                        :href="`${$root.baseUrl}/${category.slug}`"
                        :class="`category unset ${(category.children.length > 0) ? 'fw6' : ''}`">

                    <div
                            class="category-icon"
                            @mouseout="toggleSidebar(id, $event, 'mouseout')"
                            @mouseover="toggleSidebar(id, $event, 'mouseover')">

                        <img
                                v-if="category.category_icon_path"
                                :src="`${$root.baseUrl}/storage/${category.category_icon_path}`" />
                    </div>

                    <span class="category-title category-title-level1"
                          v-bind:title="category['name']"
                          v-bind:dd="category['name'].length">{{ category['name'].length > 22 ? category['name'].substring(0, 18) + '........' : category['name'] }}</span>

                    <i
                            class="rango-arrow-right pr15 pull-right"
                            @mouseout="toggleSidebar(id, $event, 'mouseout')"
                            @mouseover="toggleSidebar(id, $event, 'mouseover')"
                            v-if="category.children.length && category.children.length > 0">
                    </i>
                </a>

                <div
                        class="com sub-category-container"
                        v-if="category.children.length && category.children.length > 0">

                    <div
                            @mouseout="toggleSidebar(id, $event, 'mouseout')"
                            @mouseover="remainBar(`sidebar-level-${sidebarLevel+categoryIndex}`)"
                            :class="`sub-categories sub-category-${sidebarLevel+categoryIndex} cursor-default`">

                        <nav
                                class="sidebar"
                                :id="`sidebar-level-${sidebarLevel+categoryIndex}`"
                                @mouseover="remainBar(`sidebar-level-${sidebarLevel+categoryIndex}`)">

                            <ul type="none" class="com">
                                <li class="com"
                                    :key="`${subCategoryIndex}-${categoryIndex}`"
                                    v-for="(subCategory, subCategoryIndex) in category.children">

                                    <a
                                            :id="`sidebar-level-link-2-${subCategoryIndex}`"
                                            @mouseout="toggleSidebar(id, $event, 'mouseout')"
                                            :href="`${$root.baseUrl}/${category.slug}/${subCategory.slug}`"
                                            :class="`com category sub-category unset ${(subCategory.children.length > 0) ? 'fw6' : ''}`">

                                        <div
                                                class="com category-icon"
                                                @mouseout="toggleSidebar(id, $event, 'mouseout')"
                                                @mouseover="toggleSidebar(id, $event, 'mouseover')">

                                            <img class="com"
                                                 v-if="subCategory.category_icon_path"
                                                 :src="`${$root.baseUrl}/storage/${subCategory.category_icon_path}`" />
                                        </div>
                                        <span class="com category-title category-title-level23">{{ subCategory['name'] }}</span>
                                    </a>

                                    <ul type="none" class="nested com">
                                        <li class="com"
                                            :key="`${childSubCategoryIndex}-${subCategoryIndex}-${categoryIndex}`"
                                            v-for="(childSubCategory, childSubCategoryIndex) in subCategory.children">

                                            <a
                                                    :id="`sidebar-level-link-3-${childSubCategoryIndex}`"
                                                    :class="`com category unset ${(subCategory.children.length > 0) ? 'fw6' : ''}`"
                                                    :href="`${$root.baseUrl}/${category.slug}/${subCategory.slug}/${childSubCategory.slug}`">
                                                <span class="com category-title category-title-level2">{{ childSubCategory.name }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </li>
        </ul>

        <div @click="expand_more_categories('more_option_expand', 'more_categories')" is_expand="0" class="more_option_expand">
            <i class="fa fa-plus"></i> More Categories
        </div>
    </nav>
</template>

<script type="text/javascript">
    export default {
        props: [
            'id',
            'addClass',
            'parentSlug',
            'mainSidebar',
            'categoryCount'
        ],

        data: function () {
            return {
                slicedCategories: [],
                moreSlicedCategories: [],
                sidebarLevel: Math.floor(Math.random() * 1000),
            }
        },

        watch: {
            '$root.sharedRootCategories': function (categories) {
                this.formatCategories(categories);
            }
        },

        methods: {
            remainBar: function (id) {
                let sidebar = $(`#${id}`);
                if (sidebar && sidebar.length > 0) {
                    sidebar.show();

                    let actualId = id.replace('sidebar-level-', '');

                    let sidebarContainer = sidebar.closest(`.sub-category-${actualId}`)
                    if (sidebarContainer && sidebarContainer.length > 0) {
                        sidebarContainer.show();
                    }

                }
            },

            formatCategories: function (categories) {
                let slicedCategories = categories;
                let categoryCount = this.categoryCount ? this.categoryCount : 9;
                let moreSlicedCategories;


                if (
                    slicedCategories
                    && slicedCategories.length > categoryCount
                ) {
                    slicedCategories = categories.slice(0, categoryCount);
                }

                if (categories.length > 9) {

                    console.log((10, categories.length))
                    moreSlicedCategories = categories.slice(9, categories.length);
                }

                this.moreSlicedCategories = moreSlicedCategories;

                console.log(this.moreSlicedCategories)
                if (this.parentSlug)
                    slicedCategories['parentSlug'] = this.parentSlug;

                this.slicedCategories = slicedCategories;
            },

            expand_more_categories: function (this_class, id) {
                if ($("."+this_class).attr("is_expand") == 0) {
                    $("#"+id).removeClass("hide");
                    $("."+this_class).attr("is_expand", 1)
                } else {
                    $("#"+id).addClass("hide");
                    $("."+this_class).attr("is_expand", 0);
                }


            }

        }
    }
</script>