import ListOrderComponent from './components/ListOrderComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'list-order-component': ListOrderComponent,
    }
})

app.mount("#order-list")
