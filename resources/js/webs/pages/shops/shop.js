
import ShopComponent from './components/ShopComponent.vue';
import CategoryComponent from './components/CategoryComponent.vue';
import { createApp } from 'vue';
import {createPinia} from "pinia";

const app = createApp({
  components: {
        'shop-component': ShopComponent,
        'category-component': CategoryComponent,
    }
})

app.use(createPinia());
app.mount("#shop-page")
