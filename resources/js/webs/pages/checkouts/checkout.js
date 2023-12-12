
import CheckoutComponent from './components/CheckoutComponent.vue';

import { createApp } from 'vue';
import {createPinia} from "pinia";
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import 'vue-select/dist/vue-select.css';
const app = createApp({
  components: {
        'checkout-component': CheckoutComponent,
    }
})

app.use(createPinia());
app.use(Toast);
app.mount("#checkout-page")
