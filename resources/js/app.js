    import './bootstrap';
    import { createApp } from 'vue';
    import { apiMixin } from './mixins/apiMixin';
    import { createPinia } from 'pinia';

    const pinia = createPinia();
    const app = createApp({});

    app.mixin(apiMixin);
    app.use(pinia);
    app.mount('#app');
