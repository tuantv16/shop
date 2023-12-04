
import CartComponent from './components/CartComponent.vue';
import { createApp } from 'vue';
import {createPinia} from "pinia";

const app = createApp({
  components: {
        'cart-component': CartComponent
    }
})

app.use(createPinia());
app.mount("#cart-page")