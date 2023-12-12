<script>

import ItemProductComponent from './ItemProductComponent.vue';
import TotalAmountComponent from './TotalAmountComponent.vue';
import { useCartStore } from '../stores/cartStore.js';
import { urlBase } from '../../../../common/config/main.js';
import {dataAction} from '../services/dataActions.js';
import { useToast } from 'vue-toastification';

export default {
    components: {
        ItemProductComponent,
        TotalAmountComponent
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
            dataCarts: [],
            subTotal: 0,
            totalAmount: 0,
            showLoadingButton: false,
            dataCartsTmp : []
        }
    },
    props: {
        carts: {
            type: Array,
            default: null
        },
        account: {
            type: String,
            default: ''
        }
    },
    created() {
        if (this.account == '') { // trường hợp khách vãng lai (khách chưa login)
            let cart = localStorage.getItem('infoCart');

            let that = this;

            if (cart == null) {
                this.dataCarts = [];
            } else {
                cart = JSON.parse(cart);
                let obj = {};
                obj.local_carts = cart;

                dataAction.getCartByLocalStorage(obj).then(res => {
                    if (res.data.status == 'success') {
                        this.dataCarts = res.data.data; // set kết quả localstore vào data cart
                        this.subTotal = this.storeCart.getTotalAmountFormatTest(this.dataCarts);

                        //localStorage.setItem('infoCart', this.dataCarts);

                    }
                });
            }


            // this.subTotal = 33339;

        } else {
            this.dataCarts = this.carts; // nếu thông tin có trong session (trường hợp khách hàng login)
            this.subTotal = this.storeCart.getTotalAmountFormat(this.dataCarts);
        }

        // this.subTotal = this.storeCart.getTotalAmountFormat(this.dataCarts);


    },
    methods: {
        updateCart() {
            // Trường hợp chưa đăng nhập (khách vãng lai)
            if (this.account == '') {
                let cartString = JSON.stringify(this.dataCarts);

                localStorage.setItem('infoCart', cartString);


                // sử dụng ở màn hình checkout
                localStorage.setItem('infoCartCheckout', cartString);


                this.toast.success('Cập nhật giỏ hàng thành công!');
                // Hiển thị button loading
                this.showLoadingButton = true;
                setTimeout(() => {
                    this.scrollToTop();
                }, 2000);

            } else { // Trường hợp đã đăng nhập
                 // call api update cart to session
                let obj = {};
                obj.carts = this.storeCart.carts;
                dataAction.updateCart(obj).then(res => {
                    if (res.data.status == 'success') {
                        this.toast.success('Cập nhật giỏ hàng thành công!');
                        // Hiển thị button loading
                        this.showLoadingButton = true;
                        setTimeout(() => {
                            this.scrollToTop();
                        }, 2000);
                    }
                });
            }

        },
        removeItemFromLocalStorage(itemToRemove) {
            // Lấy dữ liệu từ localStorage
            const infoCart = JSON.parse(localStorage.getItem('infoCart')) || [];

            // Tìm vị trí của mục cần xóa trong mảng
            const indexToRemove = infoCart.findIndex(item => {
                return (
                    item.product_id === itemToRemove.product_id &&
                    item.size_id === itemToRemove.size_id &&
                    item.color_id === itemToRemove.color_id
                );
            });

            if (indexToRemove !== -1) {
                // Xóa mục đó khỏi mảng
                infoCart.splice(indexToRemove, 1);

                // Cập nhật localStorage với mảng mới
                localStorage.setItem('infoCart', JSON.stringify(infoCart));
            }

        },
        continueBuy() {
            window.location.href = `${urlBase}/shop.html`;
        },
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            this.showLoadingButton = false;
        },

    },
    mounted() {

    },
}
</script>

<template>
    <!--button loading -->
    <button v-if="showLoadingButton" @click="scrollToTop" class="loading-button" style="">
        <span class="loader"></span>
    </button>
     <!-- Shopping Cart Section Begin -->
     <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <item-product-component :data-carts = this.dataCarts :account = this.account />
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#" @click.prevent="continueBuy()">Tiếp tục mua sắm </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#" @click.prevent="updateCart()"><span class="item-update-cart"><i class="fa fa-spinner"></i></span> Cập nhật giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>

                <total-amount-component :data-carts = dataCarts :sub-total = this.subTotal :total-amount = this.totalAmount />
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
</template>
