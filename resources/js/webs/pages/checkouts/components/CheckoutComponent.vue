

<script>

import { urlBase } from '../../../../common/config/main.js';
import {dataAction} from '../services/dataActions.js';
import {apiMixin} from '../../../../mixins/apiMixin.js';
import { useToast } from 'vue-toastification';

import FormInfoCustomer from './FormInfoCustomer.vue';
import ProceedCheckoutComponent from './ProceedCheckoutComponent.vue';

export default {
    mixins: [apiMixin],
    components: {

        FormInfoCustomer,
        ProceedCheckoutComponent

    },
    setup() {
        const toast = useToast();

    return {
            toast
        };

    },
    data() {
        return {
            dataCarts : [],
            subTotal : 0
        }
    },
    props: {
        account: {
            type: String,
            default: ''
        },
        customerLogin: {
            type: Array,
            default: []
        },
        dataCartSession: {
            type: Array,
            default: []
        }
    },
    created() {

    },
    methods: {

        hanldeOrder() {
            this.$refs.formInfoRef.submitCustomerForm();
        },

        // trường hợp chưa login
        getDataCart(val) {
            this.dataCarts = val
        },
        // trường hợp chưa login
        getSubTotal(val) {
            this.subTotal = val
        }
    },
    watch: {

    }
}
</script>

<template>
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <form-info-customer ref="formInfoRef"
                 @data-carts="getDataCart"
                 @sub-total="getSubTotal"
                 :customer-login = this.customerLogin
                 :data-cart-session = this.dataCartSession
                 />

                <div class="col-lg-4 col-md-6">
                    <div class="checkout__order">
                        <h4 class="order__title">Đơn đặt hàng</h4>
                        <div class="checkout__order__products">Product <span>Total</span></div>
                        <ul class="checkout__total__products">
                            <li v-for="(item, key) in this.dataCarts" :key="key" style="display:flex; justify-content:space-between">
                                <div>{{ key + 1 }}. {{ item.product_name }} ({{ item.color_name  }}) {{  item.size_name }}</div>
                                <div class="span-price">{{ item.total_amount_label }}</div>
                            </li>
                        </ul>
                        <ul class="checkout__total__all">
                            <li>Tổng tiền <span>{{ this.subTotal }}</span></li>
                        </ul>
                        <button type="button" class="site-btn" @click="hanldeOrder">Đặt hàng</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- Checkout Section End -->
</template>
