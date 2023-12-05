
import AccountComponent from './components/AccountComponent.vue';
import { createApp } from 'vue';
import {createPinia} from "pinia";

const app = createApp({
  components: {
        'account-component': AccountComponent
    }
})

app.use(createPinia());
app.mount("#account-header")