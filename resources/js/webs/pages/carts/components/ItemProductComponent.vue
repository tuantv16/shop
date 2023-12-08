<script>

import {dataAction} from '../services/dataActions.js';

import { urlBase } from '../../../../common/config/main.js';

import { useCartStore } from '../stores/cartStore.js';
import {apiMixin} from '../../../../mixins/apiMixin.js';

export default {
    mixins: [apiMixin],
    components: {

    },
    setup() {
        const storeCart = useCartStore();

        return {
            storeCart,
        };

    },
	
    data() {
        return {

        }
    },
    props: {
        dataCarts: {
            type: Array,
            default: null
        },


    },
    created() {


    },
    methods: {

        hanldeDec(key, number) {
            number = parseInt(number);
            this.dataCarts[key].quantity = (number - 1) == 0 ? 1 : number - 1;
            let totalAmount = this.dataCarts[key].product_details.price * this.dataCarts[key].quantity;
            this.dataCarts[key].product_details.total_amount = this.formatMoney(totalAmount);
            this.calculateTotalMoney(this.dataCarts);
        },
        hanldeInc(key, number) {
            // chỉ cho nhập max là 10 sản phẩm
            this.dataCarts[key].quantity = (parseInt(number) + 1) <= 10 ? (parseInt(number) + 1) : parseInt(number);
            let totalAmount = this.dataCarts[key].product_details.price * this.dataCarts[key].quantity;

            this.dataCarts[key].product_details.total_amount = totalAmount;
            this.calculateTotalMoney(this.dataCarts);
        },
        calculateTotalMoney(dataCarts) {
            this.storeCart.setSubTotal(dataCarts);
        },
        delRowCart(keyRow) {
            const cartBefore = this.dataCarts;
            // this.dataCarts = this.dataCarts.filter((item) => item.id !== idToDelete); xóa dựa theo item trong mỗi row
            this.dataCarts.splice(keyRow, 1);

            // cập nhật lại session giỏ hàng
            // Hàm chung để compare cart mới và cũ (sử dụng cho cả trường hợp Khách vãng lai)
            let dataUpdateCart = compareCart(cartBefore, this.dataCarts);

            this.updateCart(dataUpdateCart);

            console.log(this.dataCarts);
            debugger;
            // call api update data cart trong session
        },
        // hàm này sẽ dùng chung cho trường hợp khách chưa login và đã login (merge localStorage)
        compareCart(cartBefore, cartCurrent) {

        },
        updateCart() {
            // call api update session
        }
    },
    watch: {
        value: function (val) {
            this.$emit('change', val)
        },
    }
}
</script>



<template>
<table>
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Tổng tiền33</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(item, key) in dataCarts" :key="key">
            <td class="product__cart__item">
                <div class="product__cart__item__pic">
                    <img src="frontend/img/shopping-cart/cart-1.jpg" alt="">
                </div>
                <div class="product__cart__item__text">
                    <h6>{{ item.product_details.product_name }}</h6>
                    <p>
                        <span>Màu {{ item.product_details.color_name }},  </span>
                        <span>size {{ item.product_details.size_name }}</span>
                    </p>
                    <h5>{{ this.formatMoney(item.product_details.price) }}</h5>
                </div>
            </td>
            <td class="quantity__item">
                <div class="quantity">
                    <div class="pro-qty-2">
                        <span class="fa fa-angle-left dec qtybtn" @click="hanldeDec(key, item.quantity)"></span>
                        <input type="text" name="quantity" v-model="item.quantity">
                        <span class="fa fa-angle-right inc qtybtn" @click="hanldeInc(key, item.quantity)"></span>
                    </div>
                </div>
            </td>
            <td class="cart__price">{{  this.formatMoney(item.product_details.total_amount) }}</td>
            <td class="cart__close"><span class="item-del-cart" @click="delRowCart(key)"><i class="fa fa-close"></i></span></td>
        </tr>
    </tbody>
</table>
</template>
