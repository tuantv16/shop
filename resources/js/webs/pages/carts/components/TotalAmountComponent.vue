<script>

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
            useTotal: storeCart.getTotal
        };

    },
	
    data() {
        return {
            sub_total: 0,
            total_amount: 0
        }
    },
    props: {
        dataCarts: {
            type: Array,
            default: null
        },
        subTotal: {
            type: Number,
            default: 0
        },
        totalAmount: {
            type: Number,
            default: 0
        },
    },
    created() {
        // this.sub_total = this.storeCart.sub_total > 0 ? this.storeCart.sub_total : this.subTotal;
        // this.total_amount = this.storeCart.total > 0 ? this.storeCart.total : this.totalAmount;
        this.storeCart.sub_total_format = this.storeCart.sub_total > 0 ? this.storeCart.sub_total : this.subTotal;
        this.storeCart.total = this.storeCart.total > 0 ? this.storeCart.total : this.totalAmount;
    },
    methods: {
       

    },
    watch: {
        
    }
}
</script>

<template>
         <div class="col-lg-4">
            <div class="cart__discount">
                <h6>Mã giảm giá</h6>
                <form action="#">
                    <input type="text" placeholder="Coupon code">
                    <button type="submit">Áp dụng</button>
                </form>
            </div>
            <div class="cart__total">
                <h6>Tổng cộng giỏ hàng</h6>
                <ul>
                    <li>Tạm tính<span>{{ this.storeCart.sub_total_format }}</span></li>
                    <li>Tổng tiền <span>{{ this.storeCart.sub_total_format }}</span></li>
                </ul>
                <a href="#" class="primary-btn">Proceed to checkout</a>
            </div>
        </div>
</template>
