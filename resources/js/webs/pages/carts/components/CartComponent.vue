<script>

import { useCartStore } from '../stores/cartStore';
import {dataAction} from '../services/dataActions.js';

import { urlBase } from '../../../../common/config/main.js';

import ItemProductComponent from './ItemProductComponent.vue';

export default {
    components: {
        ItemProductComponent
    },
    data() {
        return {
            objData: {

            },
        }
    },
    props: {
        // sizes: {
        //     type: Object,
        //     default: null
        // },
    },
    created() {
        // xóa hết
        //localStorage.removeItem('infoCart');

        let updatedData = localStorage.getItem('infoCart');
        console.log(updatedData);
        debugger;
        // console.log(this.listProducts);
        // debugger;

    },
    methods: {
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

            // sử dụng
            // Sử dụng phương thức để xóa một mục cụ thể
            // const itemToRemove = {
            // product_id: 18,
            // size_id: '5',
            // color_id: '3',
            // quantity: '2',
            // };

            // this.removeItemFromLocalStorage(itemToRemove);
        }
    }
}
</script>

<template>
     <!-- Shopping Cart Section Begin -->
     <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <item-product-component />
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ 169.50</span></li>
                            <li>Total <span>$ 169.50</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
</template>
