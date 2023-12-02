/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { apiMixin } from './mixins/apiMixin';
import { createPinia } from 'pinia';

const pinia = createPinia();
const app = createApp({});


// Đăng ký global mixin
app.mixin(apiMixin);

// import HomeComponent from './webs/pages/homes/components/HomeComponent.vue';
// app.component('home-component', HomeComponent);

// Nếu bạn có router, store, hoặc các plugin khác, đăng ký chúng ở đây
// Ví dụ:
// app.use(router);
// app.use(store);
app.use(pinia);
app.mount('#app');
