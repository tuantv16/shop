<script>

import {dataAction} from '../services/dataActions.js';

import { urlBase } from '../../../../common/config/main.js';

import { useCartStore } from '../stores/cartStore.js';
import {apiMixin} from '../../../../mixins/apiMixin.js';
import { useToast } from 'vue-toastification';

export default {
    mixins: [apiMixin],
    components: {

    },
    setup() {
        const toast = useToast();
        const storeCart = useCartStore();

        return {
            storeCart,
            toast
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
        account: {
            type: String,
            default: ''
        },



    },
    created() {
        this.storeCart.updateCart(this.dataCarts);

        if (this.account == '') {
            let cartLocal = localStorage.getItem('infoCart');
            if (cartLocal != null) {
                cartLocal = JSON.parse(cartLocal);
                let obj = {};
                obj.carts = cartLocal;
                obj.isLogin = false;
                dataAction.getFullInfoCartApi(obj).then(res => {
                    if (res.data.status == 'success') {
                        this.storeCart.setSubTotal(res.data.data);
                    }
                });
            }
            
        }

    },
    methods: {

        // giảm số lượng sản phẩm
        hanldeDec(key, number) {

            number = parseInt(number);
            this.dataCarts[key].quantity = (number - 1) == 0 ? 1 : number - 1;
            let totalAmount = this.dataCarts[key].product_details.price * this.dataCarts[key].quantity;

            this.dataCarts[key].product_details.total_amount = totalAmount;
            this.calculateTotalMoney(this.dataCarts);

            this.storeCart.updateCart(this.dataCarts);

        },
        // Tăng số lượng sản phẩm
        hanldeInc(key, number) {
            this.dataCarts[key].quantity = (parseInt(number) + 1) <= 10 ? (parseInt(number) + 1) : parseInt(number);
                let totalAmount = this.dataCarts[key].product_details.price * this.dataCarts[key].quantity;

                this.dataCarts[key].product_details.total_amount = totalAmount;
                this.calculateTotalMoney(this.dataCarts);

                //update Cart ở store
                this.storeCart.updateCart(this.dataCarts);
        },
        // tính tổng
        calculateTotalMoney(dataCarts) {
            this.storeCart.setSubTotal(dataCarts);
        },
        //xóa sản phẩm ra khỏi giỏ hàng
        delRowCart(keyRow) {
            // this.dataCarts = this.dataCarts.filter((item) => item.id !== idToDelete); xóa dựa theo item trong mỗi row
            this.dataCarts.splice(keyRow, 1);
            this.storeCart.updateCart(this.dataCarts);

            if (this.dataCarts.length <= 0) {
                this.toast.warning('Giỏ hàng đang trống');
                return false;
            }

            this.storeCart.setSubTotal(this.dataCarts);

            this.toast.success('Bạn vừa xóa 1 loại sản phẩm trong giỏ hàng');

        },
        // getFullInfoCart(data, isLogin) {
        //     let obj = {};
        //     obj.carts = data;
        //     obj.isLogin = isLogin;
        //     dataAction.getFullInfoCartApi(obj).then(res => {
        //             if (res.data.status == 'success') {
        //                 this.
        //                 console.log(res);
        //                 debugger;
        //                 //this.dataCarts = res.data.data;
        //                 //localStorage.setItem('infoCart', this.dataCarts);
        //             }
        //         });

        // }

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
            <th>Tổng tiền</th>
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
