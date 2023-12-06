
import ProductDetailComponent from './components/ProductDetailComponent.vue';

import { createApp } from 'vue';
import {createPinia} from "pinia";

const app = createApp({
  components: {
        'product-detail-component': ProductDetailComponent,
    }
})

app.use(createPinia());
app.mount("#product-detail-page")
