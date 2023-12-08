<script>

import ItemProductComponent from './ItemProductComponent.vue';
import TotalAmountComponent from './TotalAmountComponent.vue';
import { useCartStore } from '../stores/cartStore.js';

export default {
    components: {
        ItemProductComponent,
        TotalAmountComponent
    },
    setup() {
        const storeCart = useCartStore();
       
        return {
            storeCart,
        };

    },
    data() {
        return {
            dataCarts: [],
            subTotal: 0,
            totalAmount: 0 
        }
    },
    props: {
        carts: {
            type: Array,
            default: null
        },
    },
    created() {

        //console.log('storeCart.sub_total',this.storeCart.sub_total);

        if (this.carts == null) {
            let cart = localStorage.getItem('infoCart');
            //call api lấy đầy đủ thông tin
            // this.dataCart = ...
        } else {
            this.dataCarts = this.carts; // nếu thông tin có trong session
        }

        this.subTotal = this.storeCart.getTotalAmountFormat(this.dataCarts);
        //this.totalAmount = this.storeCart.getTotalAmountFormat(this.dataCarts);

        // this.subTotal = 9;
        // this.totalAmount = 9;


        // nếu không có trong session thì lấy ở localstorage
        // xóa hết
        //localStorage.removeItem('infoCart');
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
                        <item-product-component :data-carts = this.dataCarts />
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Cập nhật giỏ hàng</a>
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
