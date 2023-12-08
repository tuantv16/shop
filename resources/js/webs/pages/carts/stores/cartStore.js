
import { defineStore } from 'pinia'

export const useCartStore = defineStore('cartStore', {
    state: () => ({
        sub_total: 0,
        total: 0,
        sub_total_format : '',
        total_format : '',
        carts: [] // lưu thông tin giỏ hàng

    }),
    getters: {
        // getTotal() {
        //     return this.sub_total + 100;
        // },

    },
    actions: {
        formatMoney(value) {
            const formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
                currencyDisplay: 'symbol' // Hiển thị ký hiệu của tiền tệ
            });
            return formatter.format(value);
        },
        setSubTotal(carts) {
            this.sub_total = this.cacTotalAmount(carts);
            this.sub_total_format = this.getTotalAmountFormat(carts);

            //console.log('this.sub_total',this.sub_total);
        },
        // setTotal(val) {
        //     this.total = this.getTotal();
        // },
        cacTotalAmount(carts) {
            let sum = 0;
            let totalAmount = 0;

            if (carts) {
                for (const item of carts) {
                    sum = item.quantity * item.product_details.price;
                    totalAmount += sum;
                }

            }

            return totalAmount;
        },
        getTotalAmountFormat(carts) {
            const money = this.cacTotalAmount(carts)
            return this.formatMoney(money);
        },
        updateCart(val) {
            this.carts = val;
        }
    },
})
