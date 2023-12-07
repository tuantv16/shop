<script>

import { useCartStore } from '../stores/cartStore';
import {dataAction} from '../services/dataActions.js';

import { urlBase } from '../../../../common/config/main.js';
import moment from 'moment';

export default {
    components: {

    },
    data() {
        return {
            objData: {

            },

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
        formatMoney(value) {
            const formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
                currencyDisplay: 'symbol' // Hiển thị ký hiệu của tiền tệ
            });
            return formatter.format(value);
        },
        hanldeDec(key, number) {
            number = parseInt(number);
            this.dataCarts[key].quantity = (number - 1) == 0 ? 1 : number - 1;
            let totalAmount = this.dataCarts[key].product_details.price * this.dataCarts[key].quantity;
            this.dataCarts[key].total_amount = this.formatMoney(totalAmount);

        },
        hanldeInc(key, number) {
            // chỉ cho nhập max là 10 sản phẩm
            this.dataCarts[key].quantity = (parseInt(number) + 1) <= 10 ? (parseInt(number) + 1) : parseInt(number);
            let totalAmount = this.dataCarts[key].product_details.price * this.dataCarts[key].quantity;
            this.dataCarts[key].total_amount = this.formatMoney(totalAmount);

        },

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
            <td class="cart__close"><i class="fa fa-close"></i></td>
        </tr>
    </tbody>
</table>
</template>
