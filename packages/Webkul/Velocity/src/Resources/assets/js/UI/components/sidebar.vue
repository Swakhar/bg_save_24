<template>
    <!-- categories list -->
    <!--$("#sidebar-level-0").removeClass("to_show");-->
    <nav>
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

                    <a @mouseout="toggleSidebar(id, $event, 'mouseout')"
                       @mouseover="toggleSidebar(id, $event, 'mouseover')"
                            :href="`${$root.baseUrl}/${category.slug}`"
                            :class="`category unset ${(category.children.length > 0) ? 'fw6' : ''}`">

                        <div
                                class="category-icon"
                                @mouseout="toggleSidebar(id, $event, 'mouseout')"
                                @mouseover="toggleSidebar(id, $event, 'mouseover')">

                            <img
                                    v-if="category.category_icon_path"
                                    :src="`${$root.baseUrl}/public/uploads/${category.category_icon_path}`" />
                            <!--<img-->
                                    <!--v-if="1"-->
                                    <!--:src="`${$root.baseUrl}/public/uploads/category/5/${categoryIndex+1}.png`" />-->
                        </div>

                        <span  :class="`category-title category-title-level1 ${!category.category_icon_path ? 'none_img' : '' }`">
                            {{ category['name'].length > 25 ? category['name'].substring(0, 25) + '..' : category['name'] }}
                        </span>

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

                            <nav :dynamic="`${self_item=0}`"
                                    class="hoverd-nav sidebar3"
                                    :id="`sidebar-level-${sidebarLevel+categoryIndex}`"
                                    @mouseover="remainBar(`sidebar-level-${sidebarLevel+categoryIndex}`)">
                                <div class="hoverd-nav sub-item-parent-top">
                                    <div class="hoverd-nav " v-for="item in Math.ceil(category.children.length/2)">
                                        <div :class="`hoverd-nav sub-item-parent ${Math.ceil(category.children.length/2)==item?'last':''}`">
                                            <div class="hoverd-nav " v-for="item2 in 2">
                                                <div  class="hoverd-nav sub-item-child"  :f="item" :ff="item2" :fff="subCategoryIndex"
                                                      v-if="(item2-1)+(item-1)*2 == subCategoryIndex"  :key="`${subCategoryIndex}-${categoryIndex}`"
                                                      v-for="(subCategory, subCategoryIndex) in category.children">

                                                    <a
                                                            :id="`sidebar-level-link-2-${subCategoryIndex}`"
                                                            @mouseout="toggleSidebar(id, $event, 'mouseout')"
                                                            :href="`${$root.baseUrl}/${category.slug}/${subCategory.slug}`"
                                                            :class="`hoverd-nav com category-in sub-category unset ${(subCategory.children.length > 0) ? 'fw6' : ''}`">

                                                        <div v-if="subCategory.category_icon_path"
                                                             class="hoverd-nav com category-icon"
                                                             @mouseout="toggleSidebar(id, $event, 'mouseout')"
                                                             @mouseover="toggleSidebar(id, $event, 'mouseover')">

                                                            <img class="hoverd-nav com"
                                                                 v-if="subCategory.category_icon_path"
                                                                 :src="`${$root.baseUrl}/public/uploads/${subCategory.category_icon_path}`" />

                                                        </div>
                                                        <span class="hoverd-nav com category-title category-title-level23">{{ subCategory['name'] }}</span>
                                                    </a>
                                                    <div class="hoverd-nav nested-div com" :key="`${childSubCategoryIndex}-${subCategoryIndex}-${categoryIndex}`"
                                                         v-for="(childSubCategory, childSubCategoryIndex) in subCategory.children">
                                                        <a
                                                                :id="`sidebar-level-link-3-${childSubCategoryIndex}`"
                                                                :class="`com category-in unset ${(subCategory.children.length > 0) ? 'fw6' : ''}`"
                                                                :href="`${$root.baseUrl}/${category.slug}/${subCategory.slug}/${childSubCategory.slug}`">
                                                            <span class="com category-title category-title-level2">{{ childSubCategory.name }}</span>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                    :src="`${$root.baseUrl}/public/uploads/${category.category_icon_path}`" />
                        </div>

                        <span class="category-title category-title-level1"
                              v-bind:title="category['name']"
                              v-bind:dd="category['name'].length">{{ category['name'].length > 25 ? category['name'].substring(0, 25) + '..' : category['name'] }}</span>

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
                                                     :src="`${$root.baseUrl}/public/uploads/${subCategory.category_icon_path}`" />
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
                <div>
                    <i :class="`menu-collapse-i fa fa-${more_menu_icon}`"></i>
                    <span style="margin-left: 3px;">{{ more_menu_txt }}</span>
                </div>
            </div>
        </nav>
        <nav id="loading_nav" class="loading_nav" v-else >
            <div class="shimmer-card">
                <div class="shimmer-wrapper">
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                    <div class="comment animate"></div>
                </div>
            </div>
        </nav>
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
                more_menu_txt: 'More Categories',
                more_menu_icon: 'plus',
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
                //let categoryCount = this.categoryCount ? this.categoryCount : 13;
                let categoryCount = 10;
                let moreSlicedCategories;

                console.log('categoryCount', categoryCount)

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

                console.log(this.moreSlicedCategories)
                if (this.parentSlug)
                    slicedCategories['parentSlug'] = this.parentSlug;

                this.slicedCategories = slicedCategories;
            },

            expand_more_categories: function (this_class, id) {
                if ($("."+this_class).attr("is_expand") == 0) {
                    $("#"+id).removeClass("hide");
                    this.more_menu_txt = 'Close Menu';
                    this.more_menu_icon = 'minus';
                    $("."+this_class).attr("is_expand", 1)
                } else {
                    $("#"+id).addClass("hide");
                    this.more_menu_txt = 'More Categories';
                    this.more_menu_icon = 'plus';
                    $("."+this_class).attr("is_expand", 0);
                }


            }

        }
    }
</script>