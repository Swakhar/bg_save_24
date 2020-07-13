<template>
    <div>
        <section class="recommended_title_top">
            <span class="title">{{ slider_name }}</span>
            <a href="#" class="btn-home btn_view_all">{{ btn_txt }}</a>
        </section>
        <div class="col-md-2" style="    max-width: 14.6667%;
    padding-right: 3px;
    margin-right: -13px;">
            <section class="recommended_cat_list">
                <ul >
                    <li @click="clickLi(index)"
                            v-for="(cat, index) in category_list_recommended" data-id="cat_recom"
                        :class="`click_to_switch_slider ${index == active_index ? 'active': ''}`">{{ cat.category_name }}</li>
                </ul>
            </section>
        </div>

    </div>
</template>

<script type="text/javascript">
    export default {
        mixins: ['myMixin'],
        props: ['category_list_recommended', 'btn_txt', 'slider_name', 'active_index'],

        data: function () {
            return {
                quickView: null,
                quickViewDetails: false,
            }
        },

        mounted: function () {

        },

        methods: {
            clickLi: function (index) {
                this.$emit('passIndexSliderToParent', index)
            },
        }
    }
</script>