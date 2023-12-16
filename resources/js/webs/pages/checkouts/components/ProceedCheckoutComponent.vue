

<script>

import { urlBase } from '../../../../common/config/main.js';
import {dataAction} from '../services/dataActions.js';
import {apiMixin} from '../../../../mixins/apiMixin.js';
import { useToast } from 'vue-toastification';
import { useOrderStore } from '../stores/orderStore.js';

export default {
    mixins: [apiMixin],
    components: {

    },
    setup() {
        const toast = useToast();
        const orderStore = useOrderStore();
    return {
            toast,
            orderStore,
        };
    },

    data() {
        return {
            dataCarts : [],
            subtotal : 0
        }
    },
    props: {

        account: {
            type: String,
            default: ''
        },

    },
    created() {

        // console.log(this.account());
        // debugger;
        // lấy localStorage xong gán vào dataCarts rồi xóa luôn localStorage
        let infoCartCheckout = localStorage.getItem('infoCartCheckout');
        this.dataCarts = this.convertData(JSON.parse(infoCartCheckout));

    },
    methods: {
        hanldeOrder() {
            let obj = {};
            obj.infoOrders = this.dataCarts;

            this.$emit('notify-checkout', this.dataCarts);
            $("body #sendFormCustomer").trigger('click');

            console.log(obj);
            debugger;

            dataAction.saveOrder(obj).then((res) => {
                //let data = res.data.results;
                console.log(res);
                debugger;

            }).catch((err) => {

            })
        },
        convertData(carts) {
            let newCarts =  carts.map(row => {
                return {
                    product_id : row.product_id,
                    quantity : parseInt(row.quantity),
                    color_id : parseInt(row.color_id),
                    size_id : parseInt(row.size_id),
                    price: parseInt(row.product_details.price),
                    color_name: row.product_details.color_name,
                    product_code: row.product_details.product_code,
                    product_name: row.product_details.product_name,
                    size_name: row.product_details.size_name,
                    total_amount: parseInt(row.product_details.total_amount),
                    total_amount_label: this.formatPrice(row.product_details.total_amount),
                }
            });

            // tính tổng tiền luôn
            this.subtotal = newCarts.reduce((initResult, item) => initResult + item.total_amount, 0);
            this.subtotal = this.formatPrice(this.subtotal);

            return newCarts;
        },
        formatPrice(value) {
            let val = (value/1).toFixed(0).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+' đ';
        }
    },
    watch: {

    }
}
</script>

<template>
<div class="col-lg-4 col-md-6">
    <div class="checkout__order">
        <h4 class="order__title">Đơn đặt hàng</h4>
        <div class="checkout__order__products">Product <span>Total</span></div>
        <ul class="checkout__total__products">
            <li v-for="(item, key) in this.dataCarts" :key="key" style="display:flex; justify-content:space-between">
                <div>{{ key + 1 }}. {{ item.product_name }}</div>
                <div class="span-price">{{ item.total_amount_label }}</div>
            </li>
        </ul>
        <ul class="checkout__total__all">
            <li>Tổng tiền <span>{{ this.subtotal }}</span></li>
        </ul>
        <button type="button" class="site-btn" @click="hanldeOrder">Đặt hàng</button>
    </div>
</div>
</template>
