
import CartComponent from './components/CartComponent.vue';
import { createApp } from 'vue';
import {createPinia} from "pinia";
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
const app = createApp({
  components: {
        'cart-component': CartComponent
    }
})

app.use(createPinia());
app.use(Toast);
app.mount("#cart-page")
