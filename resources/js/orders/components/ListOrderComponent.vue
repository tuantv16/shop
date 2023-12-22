
<script>
import {ErrorMessage, Field, Form, useForm} from "vee-validate";
import InputComponent from '../../common/form/InputComponent.vue';
import PaginationComponent from '../../common/Pagination/PaginationComponent.vue';
import SelectBoxComponent from '../../common/form/SelectBoxComponent.vue';
import YesNoComponent from '../../common/form/YesNoComponent.vue';
import {apiMixin} from '../../mixins/apiMixin.js';

import {
    urlBase
} from '../../common/config/main.js';

import moment from 'moment';

export default {
    // name: 'CreateCategoryComponent',
    mixins: [apiMixin],
    components: {
        Form, Field, ErrorMessage,
        InputComponent,
        SelectBoxComponent,
        YesNoComponent,
        PaginationComponent

    },
    data() {
        return {
            objData: {
                order_code: '',
                customer_id: ''
            },
            totalPage: '',
            totalRecords: '',
        }
    },
    created() {
        this.messageSuccess();
        this.objData.page = this.orders.currentPage;
        this.totalPage = this.orders.totalPage;
        this.totalRecords = this.orders.totalRecords;

    },
    methods: {
        onSubmit(dataInputs) {

        },
        formatMyDate(dateString) {
            return moment(dateString).format('YYYY-MM-DD HH:mm:ss');
        }

    },
    props: {
        orders: {
            type: Object,
            default : null
        }
    },
    computed: {

    }
}

</script>

<template>
    <div class="single-product-tab-area mg-b-30">
        <div class="product-status mg-b-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Danh sách đơn hàng</h4>
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày tạo</th>
                                    <th></th>
                                </tr>
                                <tr v-for="(item, key) in this.orders.data" :key="key">
                                    <td>{{  item.order_id }}</td>
                                    <td>{{  item.order_code }}</td>
                                    <td>{{  item.customer.customer_name }}</td>
                                    <td>{{  item.email }}</td>
                                    <td>{{  item.phone }}</td>
                                    <td>{{  item.total }}</td>
                                    <td>{{ formatMyDate(item.created_at) }}</td>
                                    <td>
                                        <a data-toggle="tooltip" title="Edit" class="pd-setting-ed btn" :href="`order-details/${item.id}/edit`"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </table>

                            <pagination-component
                                :page = "this.orders.currentPage"
                                :total-page = "this.orders.totalPage"
                                :total-records = "this.orders.totalRecords"
                            />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
/* CSS cho component ở đây */
</style>
