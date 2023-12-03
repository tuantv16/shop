

<script>

export default {
    data() {
        return {

        }
    },
    components: {

    },
    props: {
        currentPage: {
            type: Number,
            default: 1
        },
        totalPage: {
            type: Number,
            default: null
        },
        totalRecords: {
            type: Number,
            default: null
        },
    },
    created() {

        // if (this.currentPage instanceof Proxy && Array.isArray(this.currentPage)) {
        //     this.currentPage = 1;
        // }

    },
    methods: {
        handlePageClick(page) {
            this.$emit('handle-click-number-page', page);
        },
    }

}
</script>
<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="product__pagination">
                <a class="mg-5" :class="this.currentPage == index ? 'active' : ''" v-for="index in 10" :key="index" @click="handlePageClick(index)">{{ index }}</a>
            </div>
        </div>
    </div>
</template>
