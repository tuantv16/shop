<script>

import { useCartStore } from '../stores/cartStore';
import {dataAction} from '../services/dataActions.js';

import { urlBase } from '../../../../common/config/main.js';

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
        // sizes: {
        //     type: Object,
        //     default: null
        // },
       

    },
    created() {
     

    },
    methods: {

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
        <tr>
            <td class="product__cart__item">
                <div class="product__cart__item__pic">
                    <img src="frontend/img/shopping-cart/cart-1.jpg" alt="">
                </div>
                <div class="product__cart__item__text">
                    <h6>T-shirt Contrast Pocket</h6>
                    <h5>$98.4922</h5>
                </div>
            </td>
            <td class="quantity__item">
                <div class="quantity">
                    <div class="pro-qty-2">
                        <input type="text" value="1">
                    </div>
                </div>
            </td>
            <td class="cart__price">$ 30.00</td>
            <td class="cart__close"><i class="fa fa-close"></i></td>
        </tr>
        <tr>
            <td class="product__cart__item">
                <div class="product__cart__item__pic">
                    <img src="frontend/img/shopping-cart/cart-2.jpg" alt="">
                </div>
                <div class="product__cart__item__text">
                    <h6>Diagonal Textured Cap</h6>
                    <h5>$98.49</h5>
                </div>
            </td>
            <td class="quantity__item">
                <div class="quantity">
                    <div class="pro-qty-2">
                        <input type="text" value="1">
                    </div>
                </div>
            </td>
            <td class="cart__price">$ 32.50</td>
            <td class="cart__close"><i class="fa fa-close"></i></td>
        </tr>
        <tr>
            <td class="product__cart__item">
                <div class="product__cart__item__pic">
                    <img src="frontend/img/shopping-cart/cart-3.jpg" alt="">
                </div>
                <div class="product__cart__item__text">
                    <h6>Basic Flowing Scarf</h6>
                    <h5>$98.49</h5>
                </div>
            </td>
            <td class="quantity__item">
                <div class="quantity">
                    <div class="pro-qty-2">
                        <input type="text" value="1">
                    </div>
                </div>
            </td>
            <td class="cart__price">$ 47.00</td>
            <td class="cart__close"><i class="fa fa-close"></i></td>
        </tr>
        <tr>
            <td class="product__cart__item">
                <div class="product__cart__item__pic">
                    <img src="frontend/img/shopping-cart/cart-4.jpg" alt="">
                </div>
                <div class="product__cart__item__text">
                    <h6>Basic Flowing Scarf</h6>
                    <h5>$98.49</h5>
                </div>
            </td>
            <td class="quantity__item">
                <div class="quantity">
                    <div class="pro-qty-2">
                        <input type="text" value="1">
                    </div>
                </div>
            </td>
            <td class="cart__price">$ 30.00</td>
            <td class="cart__close"><i class="fa fa-close"></i></td>
        </tr>
    </tbody>
</table>
</template>