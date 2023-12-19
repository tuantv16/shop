<script>

export default {
    components: {
       
    },
    data() {
        return {
            data_range: '',
            limit: 3 // Giới hạn số lượng bản ghi trên 1 trang (config cho toàn dự án)
        }
    },
    props: {
        page: {
            type: Number,
            default: null
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
        this.value = this.data
    },
    methods: {
        createPageUrl(pageNumber) {
            const queryParams = new URLSearchParams(window.location.search);
            const parsedUrl = new URL(window.location.href);
            const uri = parsedUrl.origin + parsedUrl.pathname;
         
            queryParams.set('page', pageNumber); // Cập nhật tham số page
            let url = `${uri}?${queryParams.toString()}`;
           
            return url;
        },

        isDisabled(type, page) {
            let status = false;
            if (type == 'next' && page + 1 > this.totalPage) {
                status = true;
            }

            if (type == 'prev' && page - 1 <= 0) {
                status = true;
            }

            return status;
        },
        getDataRange() {
            let limit = this.limit;
            if (this.page == 1) {
                return `1 - ${limit}`;
            } else {
                const from = this.page * limit;
                const to = from + limit;
                return from + ' - ' + to;
            }
        }
    },
    emits: ['change'],
    watch: {

    },
    mounted() {
         this.data_range = this.getDataRange();   
    }
}
</script>

<template>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <p>Tổng {{ this.totalRecords }} bản ghi ({{ this.data_range }})</p>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="custom-pagination">
                <ul class="pagination" style="float:right">
                
                    <li class="page-item" :class="{ 'disabled': isDisabled('prev', this.page) }">
                        <a class="page-link" v-if="!isDisabled('prev', this.page)" :href="this.createPageUrl(this.page-1)"><i class="fa fa-angle-double-left"></i></a>
                        <a class="page-link" v-if="isDisabled('prev', this.page)"><i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item" v-for="number in this.totalPage" :key="number">
                        <a class="page-link item-active" v-if="number == this.page" :href="this.createPageUrl(number)">{{ number }}</a>
                        <a class="page-link" v-if="number != this.page" :href="this.createPageUrl(number)">{{ number }}</a>
                    </li>
                    <li class="page-item" :class="{ 'disabled': isDisabled('next', this.page) }">
                        <a class="page-link" v-if="!isDisabled('next', this.page)" :href="this.createPageUrl(this.page+1)"><i class="fa fa-angle-double-right"></i></a>
                        <a class="page-link" v-if="isDisabled('next', this.page)"><i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>

<style scoped>
</style>
