

<script>

import { urlBase } from '../../../../common/config/main.js';
import {dataAction} from '../services/dataActions.js';
import {apiMixin} from '../../../../mixins/apiMixin.js';
import { useToast } from 'vue-toastification';


export default {
    mixins: [apiMixin],
    components: {

    },
    setup() {
        const toast = useToast();

    return {
            toast
        };

    },
    data() {
        return {

        }
    },
    props: {

        account: {
            type: String,
            default: ''
        },

    },
    created() {


    },
    methods: {

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
            <li>01. Vanilla salted caramel <span>$ 300.0</span></li>
            <li>02. German chocolate <span>$ 170.0</span></li>
            <li>03. Sweet autumn <span>$ 170.0</span></li>
            <li>04. Cluten free mini dozen <span>$ 110.0</span></li>
        </ul>
        <ul class="checkout__total__all">
            <li>Subtotal <span>$750.99</span></li>
            <li>Total <span>$750.99</span></li>
        </ul>

        <button type="submit" class="site-btn">Đặt hàng</button>
    </div>
</div>
</template>
