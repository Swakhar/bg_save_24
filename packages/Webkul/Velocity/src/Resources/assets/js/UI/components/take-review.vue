<template>
    <div>
        <v-modal name="login_error">This is a modal</v-modal>
        <loading :active.sync="isLoading"
                 :can-cancel="true"
                 :on-cancel="onCancel"
                 :is-full-page="fullPage"></loading>

        <div class="left_review">
            <span>Your rating quality</span>
        </div>
        <div class="right_review">
            <div class="block_seperate">
                <span class="label3">Nickname</span>
                <input class="ct" type="text" v-model="nickname" placeholder="Nickname">
            </div>
            <div class="block_seperate">
                <span class="label3">Summary</span>
                <input class="ct" type="text" v-model="title" placeholder="Summary">
            </div>
            <div class="block_seperate">
                <span class="label3">Review</span>
                <textarea class="ct" name="" v-model="comment" id="" cols="30" placeholder="Review" rows="3"></textarea>
            </div>
            <div class="block_seperate">
                <img @mouseover="mouseover(1)" class="rate_1" src="/cache/original/rating/rating_0.png" alt="">
                <img @mouseover="mouseover(2)" class="rate_2" src="/cache/original/rating/rating_0.png" alt="">
                <img @mouseover="mouseover(3)" class="rate_3" src="/cache/original/rating/rating_0.png" alt="">
                <img @mouseover="mouseover(4)" class="rate_4" src="/cache/original/rating/rating_0.png" alt="">
                <img @mouseover="mouseover(5)" class="rate_5" src="/cache/original/rating/rating_0.png" alt="">
            </div>
            <div class="block_seperate">
                <button @click="submit" class="btn2 btn-cart">Submit Review</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "take-review",
        props: ['product_id'],
        components: {
        },
        data() {
            return {
                isLoading: false,
                fullPage: true,
                nickname: '',
                title: '',
                comment: '',
                rating: 0,
            }
        },
        mounted() {

        },
        created() {


        },
        methods: {
            submit: function () {
                let that = this;
                this.isLoading = true;
                axios.post('/submit-review', {
                    nickname: that.nickname,
                    title: that.title,
                    comment: that.comment,
                    rating: that.rating,
                    product_id: that.product_id
                })
                    .then(data =>{
                        this.isLoading = false
                        toastr.success(data.data);
                    })
                    .catch(error => {
                        this.$modal.show('login_error')
                    });
            },
            mouseover: function (index) {
                for (let i = 1; i <= 5; i++ ) {
                    $('.rate_'+i).attr('src', '/cache/original/rating/rating_0.png')
                }
                for (let i = 1; i <= index; i++ ) {
                    $('.rate_'+i).attr('src', '/cache/original/rating/rating_full.png')
                }
                this.rating = index

            },

            getData: function (e) {
                let that = this;
                axios.get('/get-slug-category-products/'+this.slug)
                    .then(function (response) {
                        that.products = response.data.product;
                        that.product_attribute = response.data.product_attribute;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
        },
        filters: {

        }
    }
</script>

<style scoped>

</style>
