<template>
    <div class="shimmer-card-container small">
        <carousel-component
            id="shimmer-carousel"
            navigation-enabled="hide"
            pagination-enabled="hide"
            :slides-count="shimmerCountInt + 1"
            :slides-per-page="shimmerCountInt">

                <slide
                    :key="count"
                    :slot="`slide-${count}`"
                    v-for="count in shimmerCountInt">

                    <div class="shimmer-card small">
                        <div class="shimmer-wrapper">
                            <div class="shimmer-product-image animate small"></div>
                            <div class="comment animate"></div>
                            <div class="comment animate"></div>
                            <div class="comment animate"></div>
                        </div>
                    </div>
                </slide>
        </carousel-component>
    </div>
</template>

<script>
    export default {
        props: {
            'shimmerCount': {
                default: 6,
            },
        },

        data: function () {
            return {
                shimmerCountInt: parseInt(this.shimmerCount),
            }
        }
    }
</script>

<style>
    .shimmer-card-container.small {
        width: 100%;
        height: 82px;
    }

    .shimmer-card.small {
        margin: 0;
        padding: 0;
        border: 2px solid #fff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        height: 80px;
    }

    .shimmer-product-image.small {
        width: 100%;
        height: 50px;
    }

    .comment {
        height: 10px;
        background: #777;
        margin-top: 20px;
    }

    .shimmer-wrapper {
        width: 0px;
        animation: fullView 0.5s forwards linear;
    }

    @keyframes fullView {
        100% {
            width: 100%;
        }
    }

    .animate {
        animation : shimmer 2s infinite;
        background: linear-gradient(to right, #eff1f3 4%, #e2e2e2 25%, #eff1f3 36%);
        background-size: 1000px 100%;
    }

    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }
</style>
