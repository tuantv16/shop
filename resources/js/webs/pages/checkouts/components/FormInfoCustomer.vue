

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
<div class="col-lg-8 col-md-6">
                <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                here</a> to enter your code</h6>
                <h6 class="checkout__title">Chi tiết thanh toán</h6>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout__input">
                            <p>Tên khách hàng<span>*</span></p>
                            <input type="text">
                        </div>
                    </div>
                </div>
                <div class="checkout__input">
                    <p>Country<span>*</span></p>
                    <input type="text">
                </div>
                <div class="checkout__input">
                    <p>Address<span>*</span></p>
                    <input type="text" placeholder="Street Address" class="checkout__input__add">
                    <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                </div>
                <div class="checkout__input">
                    <p>Town/City<span>*</span></p>
                    <input type="text">
                </div>
                <div class="checkout__input">
                    <p>Country/State<span>*</span></p>
                    <input type="text">
                </div>
                <div class="checkout__input">
                    <p>Postcode / ZIP<span>*</span></p>
                    <input type="text">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout__input">
                            <p>Phone<span>*</span></p>
                            <input type="text">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout__input">
                            <p>Email<span>*</span></p>
                            <input type="text">
                        </div>
                    </div>
                </div>
                <div class="checkout__input__checkbox">
                    <label for="acc">
                        Chấp nhận tạo tài khoản
                        <input type="checkbox" id="acc">
                        <span class="checkmark"></span>
                    </label>
                    <p>Create an account by entering the information below. If you are a returning customer
                    please login at the top of the page</p>
                </div>
                <div class="checkout__input">
                    <p>Mật khẩu tài khoản<span>*</span></p>
                    <input type="text">
                </div>
                <div class="checkout__input__checkbox">
                    <label for="diff-acc">
                        Lưu ý về đơn đặt hàng của bạn, ví dụ: thông báo đặc biệt về giao hàng
                        <input type="checkbox" id="diff-acc">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="checkout__input">
                    <p>Ghi chú đặt hàng<span></span></p>
                    <input type="text"
                    placeholder="Notes about your order, e.g. special notes for delivery.">
                </div>
            </div>
</template>
