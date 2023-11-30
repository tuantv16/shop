
import ShopComponent from './components/ShopComponent.vue';
import { createApp } from 'vue';

const app = createApp({
  components: {
        'shop-component': ShopComponent,
    }
})

app.mount("#shop-page")
