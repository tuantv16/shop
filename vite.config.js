import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/webs/pages/shops/shop.js',
                'resources/js/brands/brand-form.js',
                'resources/js/categories/category.js',
                'resources/js/categories/category-list.js',
                'resources/js/feedbacks/setting.js',
                'resources/js/orders/order-list.js',
                'resources/js/product_details/product_detail-create.js',
                'resources/js/products/product-create.js',
                'resources/js/products/product-update.js',
                'resources/js/products/product-list.js',
                'resources/js/surveys/survey-list.js',
                'resources/js/webs/pages/carts/cart.js',
                'resources/js/webs/pages/checkouts/checkout.js',
                'resources/js/webs/pages/checkouts/checkout-success.js',
                'resources/js/webs/pages/customers/customer_login.js',
                'resources/js/webs/pages/customers/customer_register.js',
                'resources/js/webs/pages/products/product_detail.js',
                'resources/js/webs/pages/shops/shop.js'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
