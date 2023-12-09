
import ProductDetailComponent from './components/ProductDetailComponent.vue';

import { createApp } from 'vue';
import {createPinia} from "pinia";
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

const app = createApp({
  components: {
        'product-detail-component': ProductDetailComponent,
    }
})

app.use(createPinia());
app.use(Toast);
app.mount("#product-detail-page")
