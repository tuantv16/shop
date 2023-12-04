
import RegisterCustomerComponent from './components/RegisterCustomerComponent.vue';
import { createApp } from 'vue';
import {createPinia} from "pinia";

const app = createApp({
  components: {
        'register-customer-component': RegisterCustomerComponent
    }
})

app.use(createPinia());
app.mount("#register-customer")
