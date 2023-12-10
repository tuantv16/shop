

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
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <form-info-customer />
                <proceed-checkout-component />
            </div>

        </div>
    </div>
</section>
<!-- Checkout Section End -->
</template>
