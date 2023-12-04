
import LoginCustomerComponent from './components/LoginCustomerComponent.vue';
import { createApp } from 'vue';
import {createPinia} from "pinia";

const app = createApp({
  components: {
        'login-customer-component': LoginCustomerComponent
    }
})

app.use(createPinia());
app.mount("#login-customer")
